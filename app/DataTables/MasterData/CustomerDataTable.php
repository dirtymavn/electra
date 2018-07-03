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
        $return = $model->newQuery()
            ->join('companies', 'companies.id', '=', 'master_customers.company_id')
            ->select(
                'master_customers.id',
                'master_customers.customer_no',
                'master_customers.customer_name',
                'master_customers.company_id',
                'master_customers.status',
                'master_customers.salutation',
                'master_customers.sales_id',
                'master_customers.customer_group_id',
                'master_customers.is_draft',
                'master_customers.created_at',
                'master_customers.updated_at',
                'companies.name as company_name'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->whereCompanyId(@user_info()->company->id);
        }

        return $return;
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
        //     'customer_no' => ['name' => 'master_customers.customer_no', 'data' => 'customer_no', 'title' => trans('Customer No'), 'id' => 'customer_no'],
        // ];

        return [
            'customer_no',
            'customer_name',
            'company_name' => ['name' => 'companies.name', 'data' => 'company_name'],
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
