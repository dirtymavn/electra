<?php

namespace App\DataTables\Fit;

use App\Models\Fit\TrxFitOrder\FitOrder;
use Yajra\DataTables\Services\DataTable;

class FitOrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function($fitorder){
                $edit_url = route('fitorder.edit', $fitorder->id);
                $delete_url = route('fitorder.destroy', $fitorder->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('fitorder.update') && user_info()->hasAccess('fitorder.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'fitorder.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'fitorder.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('depart_date', function($fitorder){
                return date('d F Y', strtotime($fitorder->depart_date));
            })
            ->editColumn('return_date', function($fitorder){
                return date('d F Y', strtotime($fitorder->return_date));
            });
            // ->editColumn('is_draft', function($fitorder){
            //     return ($fitorder->is_draft) ? 'Yes' : 'No';
            // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Outbound\TrxFitOrder\FitOrder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FitOrder $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'trx_fit_orders.company_id')
            ->join('trx_fit_order_tours', 'trx_fit_order_tours.trx_fit_order_id', '=', 'trx_fit_orders.id')
            ->join('master_customers', 'master_customers.id', '=', 'trx_fit_orders.customer_id')
            ->select(
                'trx_fit_orders.id',
                'trx_fit_orders.order_no',
                'master_customers.customer_name',
                'trx_fit_order_tours.tour_name',
                'trx_fit_order_tours.depart_date',
                'trx_fit_order_tours.return_date',
                'trx_fit_orders.is_draft',
                'trx_fit_orders.created_at'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('trx_fit_orders.company_id', @user_info()->company->id);
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
            'order_no' =>['name' => 'trx_fit_orders.order_no', 'data' => 'order_no'],
            'customer_name' =>['name' => 'master_customers.customer_name', 'data' => 'customer_name'],
            'tour_name' =>['name' => 'trx_fit_order_tours.tour_name', 'data' => 'tour_name'],
            'depart_date' =>['name' => 'trx_fit_order_tours.depart_date', 'data' => 'depart_date'],
            'return_date' =>['name' => 'trx_fit_order_tours.return_date', 'data' => 'return_date'],
            // 'is_draft' =>['name' => 'trx_fit_orders.is_draft', 'data' => 'is_draft'],
            'created_at' =>['name' => 'trx_fit_orders.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fit/FitOrder_' . date('YmdHis');
    }
}
