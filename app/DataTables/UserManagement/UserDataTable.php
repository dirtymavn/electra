<?php

namespace App\DataTables\UserManagement;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
             ->addColumn('action', function($user){
                $edit_url = route('user.edit', $user->id);
                $reset_pass_url = route('user.reset-password', $user->id);
                $delete_url = route('user.destroy', $user->id);
                return view('partials.action-button')->with(compact('edit_url', 'reset_pass_url' ,'delete_url'));
            })
            ->editColumn('company_role', function($user) {
               // return strtoupper(str_replace('-', ' ', $user->company_role));
               return $user->roles[0]->slug;
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->usersUnderCompany()
            ->leftJoin('company_branchs', 'company_branchs.id', '=', 'users.branch_id')
            ->leftJoin('company_departments', 'company_departments.id', '=', 'users.company_department_id')
            ->select('users.id', 'users.first_name','users.last_name','users.email','users.username',
                'users.created_at','companies.name as company_name', 'users.company_role',
                'company_branchs.branch_name', 'company_departments.department_name', 'roles.name as role_name');
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
                    ->addAction(['width' => '100px', 'class' => 'row-actions'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if (user_info()->inRole('super-admin')) {
            $return = [
                'first_name' => ['name' => 'users.first_name', 'data' => 'first_name', 'title' => trans('First Name'), 'id' => 'first_name'],
                'last_name' => ['name' => 'users.last_name', 'data' => 'last_name', 'title' => trans('Last Name'), 'id' => 'last_name'],
                'email' => ['name' => 'users.email', 'data' => 'email', 'title' => trans('Email'), 'id' => 'email'],
                'username' => ['name' => 'users.username', 'data' => 'username', 'title' => trans('Username'), 'id' => 'username'],
                'company_name' => ['name' => 'companies.name', 'data' => 'company_name', 'title' => trans('Company'), 'id' => 'company'],
                'role_name' => ['name' => 'roles.role_name', 'data' => 'role_name', 'title' => trans('Role'), 'id' => 'role_name'],
                'created_at' => ['name' => 'users.created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at']
            ];
        } else {
            $return = [
                'first_name' => ['name' => 'users.first_name', 'data' => 'first_name', 'title' => trans('First Name'), 'id' => 'first_name'],
                'last_name' => ['name' => 'users.last_name', 'data' => 'last_name', 'title' => trans('Last Name'), 'id' => 'last_name'],
                'email' => ['name' => 'users.email', 'data' => 'email', 'title' => trans('Email'), 'id' => 'email'],
                'username' => ['name' => 'users.username', 'data' => 'username', 'title' => trans('Username'), 'id' => 'username'],
                'branch_name' => ['name' => 'company_branchs.branch_name', 'data' => 'branch_name', 'title' => trans('Branch'), 'id' => 'company-branch'],
                'department_name' => ['name' => 'company_departments.department_name', 'data' => 'department_name', 'title' => trans('Department'), 'id' => 'company-department'],
                'role_name' => ['name' => 'roles.role_name', 'data' => 'role_name', 'title' => trans('Role'), 'id' => 'role_name'],
                'created_at' => ['name' => 'users.created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at']
            ];
        }

        return $return;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UserManagement/User_' . date('YmdHis');
    }
}
