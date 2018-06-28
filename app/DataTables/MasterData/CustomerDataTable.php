<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Customer\MasterCustomer;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
     * @param \App\Models\MasterData\Customer\MasterCustomer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterCustomer $model)
    {
        return $model->newQuery()->select(
            'id',
            'customer_no',
            'customer_name',
            'company_id',
            'status',
            'salutation',
            'sales_id',
            'customer_group_id',
            'is_draft',
            'created_at',
            'updated_at'
        );

        // $empty = collect();
        // return $empty;
        // return $model->getDataByCompany(@user_info()->company->id)->select('customers.id',
        //     'customers.name', 'customers.address', 'customers.created_at', 'customers.updated_at',
        //     'companies.name as company_id');
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
        // return [
        //     'name' => ['name' => 'customers.name', 'data' => 'name', 'title' => trans('Name'), 'id' => 'name'],
        //     'address' => ['name' => 'customers.address', 'data' => 'address', 'title' => trans('Address'), 'id' => 'address'],
        //     'company_id' => ['name' => 'companies.name', 'data' => 'company_id', 'title' => trans('Company Name'), 'id' => 'company_id'],
        //     'created_at' => ['name' => 'customers.created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at'],
        // ];

        return [
            'customer_no',
            'customer_name',
            'company_id',
            'status',
            'salutation',
            'sales_id',
            'customer_group_id',
            'is_draft',
            'created_at'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Customer_' . date('YmdHis');
    }
}
