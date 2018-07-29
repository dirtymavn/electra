<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Airport;
use Yajra\DataTables\Services\DataTable;

class AirportDataTable extends DataTable
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
            ->addColumn('action', function($airport){
                $edit_url = route('airport.edit', $airport->id);
                $delete_url = route('airport.destroy', $airport->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('airport.update') && user_info()->hasAccess('airport.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'airport.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'airport.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('status', function($airport){
                return ($airport->status) ? 'Active' : 'Non Active';
            })
            ->editColumn('is_draft', function($airport){
                return ($airport->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Airport $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Airport $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'airports.company_id')
            ->join('cities', 'cities.id', '=', 'airports.city_id')
            ->select(
                'airports.id',
                'cities.city_name',
                'airports.airport_name',
                'airports.airport_code_icao',
                'airports.airport_code_iata',
                'airports.status',
                'airports.is_draft',
                'airports.created_at'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('airports.company_id', @user_info()->company->id);
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
            'city_name',
            'airport_name',
            'airport_code_icao',
            'airport_code_iata',
            'status' => ['name' => 'airports.status', 'data' => 'status'],
        //    'is_draft' => ['name' => 'airports.is_draft', 'data' => 'is_draft'],
            'created_at' => ['name' => 'airports.created_at', 'data' => 'created_at']
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Airport_' . date('YmdHis');
    }
}
