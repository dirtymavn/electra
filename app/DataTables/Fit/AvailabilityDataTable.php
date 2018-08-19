<?php

namespace App\DataTables\Fit;

use App\Models\Outbound\TrxTourFolder\TourFolder;
use Yajra\DataTables\Services\DataTable;

class AvailabilityDataTable extends DataTable
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
                $edit_url = route('tourfolder.edit', $type->id);
                $delete_url = route('tourfolder.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('tourfolder.update') && user_info()->hasAccess('tourfolder.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'tourfolder.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'tourfolder.destroy'])) {
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
     * @param \App\Models\Outbound\Trxtourfolder\tourfolder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(tourfolder $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'trx_tour_folder.company_id')
            ->select(
                'trx_tour_folder.id',
                'trx_tour_folder.tour_code',
                'trx_tour_folder.tour_name',
                'trx_tour_folder.departure_date'
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
            'tour_code',
            'tour_name',
            'departure_date'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Outbound/tourfolder_' . date('YmdHis');
    }
}
