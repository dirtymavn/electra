<?php

namespace App\DataTables\Business;

use App\Models\Business\Transaction;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
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
            ->addColumn('action', function($transaction){
                $edit_url = route('transaction.edit', $transaction->id);
                $delete_url = route('transaction.destroy', $transaction->id);
                $approve_url = route('transaction.approve', $transaction->id);
                $reject_url = route('transaction.reject', $transaction->id);
                if ((user_info('company_role') == 'admin' || user_info('company_role') == 'super-admin') && $transaction->status == 0) {
                    return view('partials.action-button')->with(compact('edit_url', 'approve_url', 'reject_url','delete_url'));
                } else {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                }
            })
            ->editColumn('status', function($transaction) {
                if ($transaction->status == 0) {
                    return 'Pending';
                } elseif ($transaction->status == 1) {
                    return 'Approved';
                } elseif ($transaction->status == 2) {
                    return 'Rejected';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Business\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        return $model->getDataByCompany(@user_info()->company->id)
            ->select('transactions.id', 'transactions.code', 'transactions.status',
                'customers.name as customer_name', 'companies.name as company_name', 'transactions.created_at');
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
                    ->addAction(['width' => '120px', 'class' => 'row-actions'])
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
            'code' => ['name' => 'transactions.code', 'data' => 'code', 'title' => trans('Code'), 'id' => 'code'],
            'customer_name' => ['name' => 'customers.name', 'data' => 'customer_name', 'title' => trans('Customer'), 'id' => 'customer'],
            'company_name' => ['name' => 'companies.name', 'data' => 'company_name', 'title' => trans('Company'), 'id' => 'company'],
            'status' => ['name' => 'transactions.status', 'data' => 'status', 'title' => trans('Status'), 'id' => 'status'],
            'created_at' => ['name' => 'transactions.created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Business/Transaction_' . date('YmdHis');
    }
}
