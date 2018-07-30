<?php

namespace App\DataTables\MasterData\Outbound;

use App\Models\MasterData\Outbound\Guide\MasterTourGuide;
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
        return datatables($query)
            ->addColumn('action', function($guide){
                $edit_url = route('guide.edit', $guide->id);
                $delete_url = route('guide.destroy', $guide->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('guide.update') && user_info()->hasAccess('guide.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'guide.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'guide.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($guide){
                return ($guide->is_draft) ? 'Yes' : 'No';
            })
            ->editColumn('start_date', function($guide){
                return date('Y, F d', strtotime($guide->start_date));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Outbound\Guide\MasterTourGuide $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterTourGuide $model)
    {
        // $empty = collect();
        // return $empty;
        $return = $model->newQuery()->join('master_tour_guide_mains', 'master_tour_guide_mains.master_tour_guide_id', '=', 'master_tour_guides.id')
            ->leftJoin('companies', 'companies.id', '=', 'master_tour_guides.company_id')
            ->select('master_tour_guides.id', 'master_tour_guides.guide_code', 'master_tour_guides.guide_status', 'master_tour_guides.supplier_no',
                'master_tour_guides.is_draft', 'master_tour_guide_mains.start_date', 'master_tour_guide_mains.remark');

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
            'start_date' => ['name' => 'master_tour_guide_mains.start_date', 'data' => 'start_date', 'title' => trans('Start Date'), 'id' => 'start_date'],
            'guide_code' => ['name' => 'master_tour_guides.guide_code', 'data' => 'guide_code', 'title' => trans('Tour Code'), 'id' => 'guide_code'],
            // 'supplier_no' => ['name' => 'master_tour_guides.supplier_no', 'data' => 'supplier_no', 'title' => trans('Staff ID'), 'id' => 'supplier_ni'],
            'guide_status' => ['name' => 'master_tour_guides.guide_status', 'data' => 'guide_status', 'title' => trans('Status'), 'id' => 'guide_status'],
            // 'is_draft' => ['name' => 'master_tour_guides.is_draft', 'data' => 'is_draft', 'title' => trans('Is Draft'), 'id' => 'is_draft'],
            'remark' => ['name' => 'master_tour_guide_mains.remark', 'data' => 'remark', 'title' => trans('Remark'), 'id' => 'remark'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Outbound/Guide_' . date('YmdHis');
    }
}
