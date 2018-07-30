<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Airline;
use Yajra\DataTables\Services\DataTable;

class AirlineDataTable extends DataTable
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
            ->addColumn('action', function($airline){
                $edit_url = route('airline.edit', $airline->id);
                $delete_url = route('airline.destroy', $airline->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('airline.update') && user_info()->hasAccess('airline.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'airline.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'airline.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($airline){
                return ($airline->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Airline $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Airline $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'airlines.company_id')
            ->select(
                'airlines.id',
                'airlines.airline_name',
                'airlines.airline_code',
                'airlines.airline_class',
                'airlines.is_draft',
                'airlines.created_at'
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
            'airline_name',
            'airline_code',
            'airline_class',
        //    'is_draft',
            'created_at'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Airline_' . date('YmdHis');
    }
}
