<?php

namespace App\DataTables\System;

use App\Models\System\Core\CoreModule;
use Yajra\DataTables\Services\DataTable;

class CoreDataTable extends DataTable
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
        ->addColumn('action', function($core){
            $edit_url = route('core.edit', $core->id);
            $delete_url = route('core.destroy', $core->id);
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('core.update') && user_info()->hasAccess('core.destroy')) ) {
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'core.update'])) {
                return view('partials.action-button')->with(compact('edit_url'));    
            } elseif (user_info()->hasAnyAccess(['admin.company', 'core.destroy'])) {
                return view('partials.action-button')->with(compact('delete_url'));
            } else {
                return '-';
            }
        })
        ->editColumn('is_draft', function($core){
            return ($core->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\System\CoreModule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CoreModule $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'core_module.company_id')
        ->select(
            'core_module.module_name',
            'core_module.module_label',
            'core_module.module_code',
            'core_module.company_id',
            'core_module.is_draft',
            'core_module.id',
            'core_module.created_at'
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
            'module_name',
            'module_label',
            'module_code',
            'is_draft'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'System/Core_' . date('YmdHis');
    }
}
