<?php

namespace App\DataTables\Outbound;

use App\Models\Outbound\Guide;
use Yajra\DataTables\Services\DataTable;

class GuideDataTable extends DataTable
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
            // ->addColumn('action', 'outbound/guide.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Outbound\Guide $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Guide $model)
    {
        $empty = collect();
        return $empty;
        // return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
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
            'From Date',
            'Start Time',
            'To Date',
            'End Time',
            'Tour Code',
            'Staff ID',
            'Status',
            'Remark',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Outbound/Guide_' . date('YmdHis');
    }
}
