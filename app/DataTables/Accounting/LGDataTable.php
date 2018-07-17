<?php

namespace App\DataTables\Accounting;

use Yajra\DataTables\Services\DataTable;
use App\Models\Accounting\LG\MasterLG;

class LGDataTable extends DataTable
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
            ->addColumn('action', function($lg){
                $edit_url = route('lg.edit', $lg->id);
                $delete_url = route('lg.destroy', $lg->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('lg.update') && user_info()->hasAccess('lg.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'lg.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'lg.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($lg){
                return ($lg->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Accounting\LG\MasterLG $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterLG $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_lg.company_id')
            ->join('master_supplier', 'master_supplier.id', '=', 'master_lg.supplier_id')
            ->select(
                'master_lg.id',
                'master_lg.lg_no',
                'master_lg.lg_type',
                'master_lg.lg_date',
                'master_lg.delivery_status',
                'master_lg.supplier_ref_no',
                'master_lg.supplier_id',
                'master_lg.credit_term_id',
                'master_lg.remark',
                'master_lg.footer',
                'master_lg.tour_voucher',
                'master_lg.paid_amt',
                'master_lg.base_currency_id',
                'master_lg.base_amt',
                'master_lg.bill_currency_id',
                'master_lg.bill_amt',
                'master_lg.lg_status',
                'master_lg.company_id',
                'master_lg.branch_id',
                'master_lg.is_draft',
                'master_supplier.name as supplier_name'
            );
        
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('master_lg.company_id', @user_info()->company->id);
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
            'lg_no',
            'lg_type' => ['name' => 'master_lg.lg_type', 'data' => 'lg_type', 'title' => 'Type'],
            'supplier_name' => ['name' => 'master_supplier.name', 'data' => 'supplier_name', 'title' => 'Supplier Name'],
            'delivery_status' => ['name' => 'master_lg.delivery_status', 'data' => 'delivery_status', 'title' => 'Delivery Status'],
            'is_draft' => ['name' => 'master_lg.is_draft', 'data' => 'is_draft', 'title' => 'Is Draft'],
            'lg_status' => ['name' => 'master_lg.lg_status', 'data' => 'lg_status', 'title' => 'LG Status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Accounting/LG_' . date('YmdHis');
    }
}
