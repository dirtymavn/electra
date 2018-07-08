<?php

namespace App\DataTables\Master;

use App\Models\Role;
use App\Models\Master\Company;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->addColumn('action', function($role){
                
                if ($role->slug != 'super-admin' && $role->slug != 'admin') {
                    $edit_url = route('role.edit', $role->id);

                    if ($role->slug != 'subscriber') {
                        $delete_url = route('role.destroy', $role->id);
                    }
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                }

                return '-';
                
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        if (@user_info()->company) {
            $companyId = user_info()->company->id;
        }

        $query = $model->newQuery()->leftJoin('companies', 'companies.id', '=', 'roles.company_id')
            ->select('roles.id', 'roles.name', 'roles.slug', 'roles.created_at', 'roles.updated_at',
                'companies.name as company_name');
        
        if (!user_info()->inRole('super-admin')) {
            $query = $query->whereCompanyId($companyId);
        } else {
            $query->whereNull('company_id');
        }

        return $query;
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
                    ->addAction(['width' => '80px'])
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
            'name' => ['name' => 'roles.name', 'data' => 'name', 'title' => trans('Name'), 'id' => 'name'],
            'company_name' => ['name' => 'companies.name', 'data' => 'company_name', 'title' => trans('Company'), 'id' => 'company_name'],
            'created_at' => ['name' => 'roles.created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Master/Role_' . date('YmdHis');
    }
}
