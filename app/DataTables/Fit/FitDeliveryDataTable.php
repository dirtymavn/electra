<?php

namespace App\DataTables\Fit;

use App\Models\Fit\Delivery\TrxFitDeliveryOrder;
use Yajra\DataTables\Services\DataTable;

class FitDeliveryDataTable extends DataTable
{
    /**
    * Build DataTable class.
    *
    * @param mixed $query Results from query() method.
    * @return \Yajra\DataTables\DataTableAbstract
    */
    public function dataTable($query)
    {
        return datatables()->of($query)
        ->addColumn('action', function($delivery){
            $edit_url = route('fit-delivery.edit', $delivery->id);
            $delete_url = route('fit-delivery.destroy', $delivery->id);
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('fit-delivery.update') && user_info()->hasAccess('fit-delivery.destroy')) ) {
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'fit-delivery.update'])) {
                return view('partials.action-button')->with(compact('edit_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'fit-delivery.destroy'])) {
                return view('partials.action-button')->with(compact('delete_url'));
            } else {
                return '-';
            }
        })
        ->editColumn('is_draft', function($delivery){
            return ($delivery->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
    * Get query source of dataTable.
    *
    * @param \App\Models\Business\Delivery\TrxFitDeliveryOrder $model
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query(TrxFitDeliveryOrder $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'trx_fit_delivery_orders.company_id')
        ->select(
            'do_no',
            'do_type_id',
            'do_date',
            'team_code',
            'sender',
            'tel_no',
            'department_code',
            'is_draft',
            'company_id',
            'trx_fit_delivery_orders.id'
        );

        if (!user_info()->inRole('super-admin')) {

            $return = $return->whereCompanyId(@user_info()->company->id);
        }

        return $return;

    }

    /**
    * Optional method if you want to use html builder.
    *
    * @return \Yajra\DataTables\Html\Builder
    */
    public function html()
    {
        return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->addAction(['width' => '80px', 'class' => 'row-actions'])
        ->addCheckbox(['class' => 'checklist'], 0)
        ->parameters($this->getBuilderParameters());
    }

    /**
    * Get columns.
    *
    * @return array
    */
    protected function getColumns()
    {
        return [
            'do_no',
            'do_type_id',
            'do_date',
            'team_code',
            'sender',
            'tel_no',
            'department_code',
            'is_draft',
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fit/Delivery_' . date('YmdHis');
    }
}
