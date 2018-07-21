<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Department;
use Yajra\DataTables\Services\DataTable;

class CompanyDepartmentDataTable extends DataTable
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
            ->addColumn('action', function($department){
                $edit_url = route('department.edit', $department->id);
                $delete_url = route('department.destroy', $department->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('department.update') && user_info()->hasAccess('department.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'department.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'department.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($department){
                return ($department->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Department $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Department $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'company_departments.company_id')
            ->select(
                'company_departments.id',
                'company_departments.department_name',
                'company_departments.department_code',
                'company_departments.is_draft',
                'company_departments.created_at'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->whereCompanyId(@user_info()->company->id);
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
            'department_name',
            'department_code',
            'is_draft',
            'created_at' => ['name' => 'company_departments.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/CompanyDepartment_' . date('YmdHis');
    }
}
