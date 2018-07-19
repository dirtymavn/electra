<?php

namespace App\DataTables\System;

use App\Models\System\CoreConfig\CoreConfig;
use Yajra\DataTables\Services\DataTable;

class CoreConfigDataTable extends DataTable
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
            ->addColumn('action', function($coreConfig){
                $edit_url = route('core-config.edit', $coreConfig->id);
                $delete_url = route('core-config.destroy', $coreConfig->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('core-config.update') && user_info()->hasAccess('core-config.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'core-config.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'core-config.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($coreConfig){
                return ($coreConfig->is_draft) ? 'Yes' : 'No';
            })
            ->editColumn('allow_backdate', function($coreConfig){
                return ($coreConfig->allow_backdate) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\System\CoreConfig\CoreConfig $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CoreConfig $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'core_configs.company_id')
            ->join('core_config_mains', 'core_config_mains.core_config_id', '=', 'core_configs.id')
            ->select(
                'core_configs.id',
                'core_configs.base_date',
                'core_configs.decimal_number',
                'core_config_mains.allow_backdate',
                'core_config_mains.backdate_interval',
                'core_configs.is_draft',
                'core_configs.created_at'
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
            'base_date',
            'decimal_number',
            'allow_backdate',
            'backdate_interval',
            'is_draft',
            'created_at' => ['name' => 'core_configs.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'System/CoreConfig_' . date('YmdHis');
    }
}
