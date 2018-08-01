<?php

namespace App\DataTables\Setting;

use App\Models\Setting\CoreForm;
use Yajra\DataTables\Services\DataTable;

class CoreFormDataTable extends DataTable
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
     * @param \App\Models\Setting\CoreForm $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CoreForm $model)
    {
        return $model->newQuery()->select(
            'id',
            'name',
            'slug',
            'label',
            'model',
            'code',
            'type',
            'created_at',
            'updated_at'
        );
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $parameters = array_merge($this->getBuilderParameters(), ['pageLength' => 20]);
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
            'name',
            'slug',
            'label',
            'code',
            'type',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting/CoreForm_' . date('YmdHis');
    }
}
