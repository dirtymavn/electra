<?php

namespace App\DataTables\System;

use App\Models\System\CoreStatus;
use Yajra\DataTables\Services\DataTable;

class CoreStatusDataTable extends DataTable
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
        ->addColumn('action', function($status){
            $edit_url = route('core-status.edit', $status->id);
            $delete_url = route('core-status.destroy', $status->id);
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('core-status.update') && user_info()->hasAccess('core-status.destroy')) ) {
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'core-status.update'])) {
                return view('partials.action-button')->with(compact('edit_url'));    
            } elseif (user_info()->hasAnyAccess(['admin.company', 'core-status.destroy'])) {
                return view('partials.action-button')->with(compact('delete_url'));
            } else {
                return '-';
            }
        })
        ->editColumn('is_draft', function($status){
            return ($status->is_draft) ? 'Yes' : 'No';
        })
        ->editColumn('status_approval_flag', function($status){
            return ($status->status_approval_flag) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\System\CoreStatus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CoreStatus $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'master_core_status.company_id')
        ->select(
            'master_core_status.status_name',
            'master_core_status.status_code',
            'master_core_status.status_order',
            'master_core_status.status_approval_flag',
            'master_core_status.company_id',
            'master_core_status.is_draft',
            'master_core_status.id',
            'master_core_status.created_at'
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
            'status_name',
            'status_code',
            'status_order',
            'status_approval_flag',
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
        return 'System/CoreStatus_' . date('YmdHis');
    }
}
