<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\AirAllotment;
use Yajra\DataTables\Services\DataTable;

class AirAllotmentDataTable extends DataTable
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
            ->addColumn('action', function($type){
                $edit_url = route('air-allotment.edit', $type->id);
                $delete_url = route('air-allotment.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('air-allotment.update') && user_info()->hasAccess('air-allotment.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'air-allotment.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'air-allotment.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($type){
                return ($type->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\AirAllotment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AirAllotment $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_air_allotment.company_id')
            ->select(
                'master_air_allotment.id',
                'master_air_allotment.pnr',
                'master_air_allotment.id_airport_from',
                'master_air_allotment.id_ariport_to',
                'master_air_allotment.id_airlines',
                'master_air_allotment.flight_number',
                'master_air_allotment.class',
                'master_air_allotment.status',
                'master_air_allotment.departure_date',
                'master_air_allotment.arrival_date',
                'master_air_allotment.allotment',
                'master_air_allotment.reserve',
                'master_air_allotment.sold',
                'master_air_allotment.available',
                'master_air_allotment.reserve_tour'
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
            'pnr'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/AirAllotment_' . date('YmdHis');
    }
}
