<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\City;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
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
            ->addColumn('action', function($city){
                $edit_url = route('city.edit', $city->id);
                $delete_url = route('city.destroy', $city->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('city.update') && user_info()->hasAccess('city.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'city.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'city.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('status', function($city){
                return ($city->status) ? 'Active' : 'Non Active';
            })
            ->editColumn('is_draft', function($city){
                return ($city->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(City $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'cities.company_id')
            ->leftJoin('countries', 'countries.id', '=', 'cities.country_id')
            ->select(
                'cities.id',
                'countries.country_name',
                'cities.city_name',
                'cities.city_code',
                'cities.status',
                'cities.is_draft',
                'cities.created_at'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('cities.company_id', @user_info()->company->id);
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
            'country_name',
            'city_name',
            'city_code',
            'status',
        //    'is_draft' => ['name' => 'cities.is_draft', 'data' => 'is_draft'],
            'created_at' => ['name' => 'cities.created_at', 'data' => 'created_at']
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/City_' . date('YmdHis');
    }
}
