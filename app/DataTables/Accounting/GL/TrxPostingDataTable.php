<?php

namespace App\DataTables\Accounting\GL;

use App\Models\Accounting\GL\TrxPosting\TrxPosting;
use Yajra\DataTables\Services\DataTable;

class TrxPostingDataTable extends DataTable
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
        ->addColumn('action', function($periodend){
            $edit_url = route('periodend.edit', $periodend->id);
            $delete_url = route('periodend.destroy', $periodend->id);
            return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
        })
        ->editColumn('is_draft', function($periodend){
            return ($periodend->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Accounting\GL\TrxPosting\TrxPosting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TrxPosting $model)
    {
        $return = $model->newQuery()
            ->join('companies', 'companies.id', '=', 'trx_posting.company_id')
            ->select(
                'trx_posting.id',
                'trx_posting.postdate_start',
                'trx_posting.postdate_end',
                'trx_posting.user_id',
                'trx_posting.branch_id',
                'trx_posting.is_draft'
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
         'postdate_start',
         'postdate_end',
         'user_id',
         'branch_id',
         'is_draft'
     ];
 }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Accounting/GL/TrxPosting_' . date('YmdHis');
    }
}
