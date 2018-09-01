<?php

namespace App\DataTables\Accounting;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\Models\Accounting\Invoice\TrxInvoice;

class InvoiceDataTable extends DataTable
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
            ->addColumn('action', 'accounting/invoicedatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TrxInvoice $model)
    {
        $return = $model->newQuery()
            ->select('*');

        // if (!user_info()->inRole('super-admin')) {

        //     $return = $return->where('master_lg.company_id', @user_info()->company->id);
        // }

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
            'invoice_no',
            'sales_no',
            'customer',
            'trip_date',
            'invoice_status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Accounting/Invoice_' . date('YmdHis');
    }
}
