<?php

namespace App\DataTables\Master;

use App\Models\Master\Company;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
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
            ->addColumn('action', function($company){
                $edit_url = route('company.edit', $company->id);
                $delete_url = route('company.destroy', $company->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Master\Company $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
    {
        return $model->newQuery()->select('id', 'name', 'address', 'phone', 'created_at');
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
            'name' => ['name' => 'name', 'data' => 'name', 'title' => trans('Name'), 'id' => 'name'],
            'address' => ['name' => 'address', 'data' => 'address', 'title' => trans('Address'), 'id' => 'address'],
            'phone' => ['name' => 'phone', 'data' => 'phone', 'title' => trans('Phone'), 'id' => 'phone'],
            'created_at' => ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('Created At'), 'id' => 'created_at'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Master/Company_' . date('YmdHis');
    }
}
