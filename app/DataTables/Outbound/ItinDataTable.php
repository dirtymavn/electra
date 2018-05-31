<?php

namespace App\DataTables\Outbound;

use App\Models\Outbound\Itin;
use Yajra\DataTables\Services\DataTable;

class ItinDataTable extends DataTable
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
            // ->addColumn('action', 'outbound/itin.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Outbound\Itin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Itin $model)
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
            'Itinerary Code',
            'Inbound/Outbound',
            'Branch Code',
            'Modified By',
            'Modified Date'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Outbound/Itin_' . date('YmdHis');
    }
}
