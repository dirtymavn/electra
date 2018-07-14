<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Tour;
use Yajra\DataTables\Services\DataTable;

class TourDataTable extends DataTable
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
            ->addColumn('action', function($tour){
                $edit_url = route('tour.edit', $tour->id);
                $delete_url = route('tour.destroy', $tour->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('tour.update') && user_info()->hasAccess('tour.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'tour.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'tour.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($tour){
                return ($tour->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Tour $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tour $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_tours.company_id')
            ->select(
                'master_tours.id',
                'master_tours.tour_name',
                'master_tours.tour_code',
                'master_tours.depart_date',
                'master_tours.return_date',
                'master_tours.is_draft',
                'master_tours.created_at'
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
            'tour_name',
            'tour_code',
            'depart_date',
            'return_date',
            'is_draft' => ['name' => 'master_tours.is_draft', 'data' => 'is_draft'],
            'created_at' => ['name' => 'master_tours.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Tour_' . date('YmdHis');
    }
}
