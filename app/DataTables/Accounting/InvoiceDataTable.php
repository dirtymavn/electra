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
            ->addColumn('action', function ($invoice) {
                $edit_url = route('accounting.invoice.edit', $invoice->id);
                $delete_url = route('accounting.invoice.destroy', $invoice->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('delivery.update') && user_info()->hasAccess('accounting.invoice.destroy'))) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'accounting.invoice.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'accounting.invoice.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TrxInvoice $model)
    {
        $return = $model::with('sales.customer');
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('trx_accounting_invoices.company_id', @user_info()->company->id);
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
            'invoice_no'=>['name' => 'invoice_no', 'data' => 'invoice_no', 'title' => 'Invoice No.'],
            'sales_no' => ['name' => 'sales.sales_no', 'data' => 'sales.sales_no', 'title' => 'Sales No.'],
            'customer' => ['name' => 'sales.customer.customer_name', 'data' => 'sales.customer.customer_name', 'title' => 'Customer'],
            'trip_date' => ['name' => 'trip_date', 'data' => 'invoice_date', 'title' => 'Date'],
            // 'invoice_status' => ['name' => 'invoice_status', 'data' => 'invoice_status', 'title' => 'Status']
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
