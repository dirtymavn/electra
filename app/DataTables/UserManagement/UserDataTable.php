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
                $edit_url = route('user-management.user.edit', $user->id);
                $delete_url = route('user-management.user.destroy', $user->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
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
        return $model->newQuery()->select('first_name','last_name','email','created_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->addIndex(['title' => 'No', 'width' => '10px'])
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
            'first_name' => ['name' => 'first_name', 'data' => 'first_name', 'title' => trans('First Name'), 'id' => 'first_name'],
            'last_name' => ['name' => 'last_name', 'data' => 'last_name', 'title' => trans('Last Name'), 'id' => 'last_name'],
            'email' => ['name' => 'email', 'data' => 'email', 'title' => trans('Email'), 'id' => 'email'],
            'created_at' => ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at']
        ];

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
