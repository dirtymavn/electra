<?php

namespace App\DataTables\AuditTrail;

use DB;
use Yajra\DataTables\Services\DataTable;

class AuditTrailDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $return = DB::table('audits')->join('users', 'users.id', 'audits.user_id')
            ->select('users.first_name', 'users.last_name', 'users.email', 'users.username',
                'audits.*');
            
        if (user_info()->inRole('admin')) {

            $return = $return->where('users.company_id',@user_info()->company->id);
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
        $parameters = array_merge($this->getBuilderParameters(), ['pageLength' => 20, 'responsive' => true,
            'order' => [[4, 'desc']]]);

        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($parameters);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'username' => ['name' => 'users.username', 'data' => 'username', 'title' => trans('UserName')],
            // 'email' => ['name' => 'users.email', 'data' => 'email', 'title' => trans('Email')],
            'event' => ['name' => 'audits.event', 'data' => 'event', 'title' => trans('Event')],
            'auditable_type' => ['name' => 'audits.auditable_type', 'data' => 'auditable_type', 'title' => trans('Type')],
            'ip_address' => ['name' => 'audits.ip_address', 'data' => 'ip_address', 'title' => trans('IP Address')],
            'created_at' => ['name' => 'audits.created_at', 'data' => 'created_at', 'title' => trans('Created_at')],
            'user_agent' => ['name' => 'audits.user_agent', 'data' => 'user_agent', 'title' => trans('User Agent'), 'class' => 'none'],
            'old_values' => ['name' => 'audits.old_values', 'data' => 'old_values', 'title' => trans('Old Value'), 'class' => 'none'],
            'new_values' => ['name' => 'audits.new_values', 'data' => 'new_values', 'title' => trans('New Value'), 'class' => 'none'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AuditTrail/AuditTrail_' . date('YmdHis');
    }
}
