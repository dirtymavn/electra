<?php

namespace App\DataTables\MasterData\Outbound;

use App\Models\MasterData\Outbound\Itinerary\MasterItinerary;
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
        return datatables($query)
            ->addColumn('action', function($itin){
                $edit_url = route('itin.edit', $itin->id);
                $delete_url = route('itin.destroy', $itin->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('is_draft', function($itin){
                return ($itin->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Outbound\Itinerary\MasterItinerary $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterItinerary $model)
    {
        return $model->newQuery()->select(
            'id',
            'itinerary_code',
            'itinerary_direction',
            'branch_id',
            'itinerary_name',
            'airline',
            'category',
            'city_code',
            'type',
            'nationality',
            'description',
            'min_cap',
            'max_cap',
            'validity_start',
            'validity_end',
            'departure',
            'days_duration',
            'cutoff_days',
            'remark',
            'is_draft'
        );
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
            'itinerary_code' => ['name' => 'master_itineraries.itinerary_code', 'data' => 'itinerary_code', 'title' => trans('Itinerary Code'), 'id' => 'itinerary_code'],
            'itinerary_name' => ['name' => 'master_itineraries.itinerary_name', 'data' => 'itinerary_name', 'title' => trans('Itinerary Name'), 'id' => 'itinerary_name'],
            'branch_id' => ['name' => 'master_itineraries.branch_id', 'data' => 'branch_id', 'title' => trans('Branch ID'), 'id' => 'branch_id'],
            'is_draft' => ['name' => 'master_itineraries.is_draft', 'data' => 'is_draft', 'title' => trans('Is Draft'), 'id' => 'is_draft'],
            'remark' => ['name' => 'master_itineraries.remark', 'data' => 'remark', 'title' => trans('Remark'), 'id' => 'remark'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Outbound/Itin_' . date('YmdHis');
    }
}
