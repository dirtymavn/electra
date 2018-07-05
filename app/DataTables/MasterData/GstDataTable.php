<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Gst;
use Yajra\DataTables\Services\DataTable;

class GstDataTable extends DataTable
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
            ->addColumn('action', function($gst){
                $edit_url = route('gst.edit', $gst->id);
                $delete_url = route('gst.destroy', $gst->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('absorb_ppn', function($gst){
                return ($gst->absorb_ppn) ? 'Yes' : 'No';
            })
            ->editColumn('is_draft', function($gst){
                return ($gst->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Gst $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Gst $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'gsts.company_id')
            ->select(
                'gsts.id',
                'gsts.gst_code',
                'gsts.gst_percent',
                'gsts.absorb_ppn',
                'gsts.is_draft',
                'gsts.created_at'
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
            'gst_code',
            'gst_percent',
            'absorb_ppn',
            'is_draft',
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
        return 'MasterData/Gst_' . date('YmdHis');
    }
}
