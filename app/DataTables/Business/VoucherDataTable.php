<?php

namespace App\DataTables\Business;

use App\Models\Business\Voucher\MasterVoucher;
use Yajra\DataTables\Services\DataTable;

class VoucherDataTable extends DataTable
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
            ->addColumn('action', function($customer){
                $edit_url = route('customer.edit', $customer->id);
                $delete_url = route('customer.destroy', $customer->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('is_draft', function($customer){
                return ($customer->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Business\Voucher\MasterVoucher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterVoucher $model)
    {
        return $model->newQuery()->select(
            'id',
            'voucher_no',
            'voucher_status',
            'voucher_date',
            'voucher_currency',
            'voucher_amt',
            'valid_from',
            'valid_to',
            'transferrable_flag',
            'internal_desc',
            'desc',
            'cust_no',
            'cust_name',
            'cust_address',
            'is_draft',
            'created_at',
            'updated_at'
        );
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
            'voucher_no',
            'voucher_date',
            'valid_from',
            'valid_to',
            'cust_no',
            'cust_name',
            'cust_address',
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
        return 'Business/Voucher_' . date('YmdHis');
    }
}
