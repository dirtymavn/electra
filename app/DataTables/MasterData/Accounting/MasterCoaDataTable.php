<?php

namespace App\DataTables\MasterData\Accounting;

use App\Models\MasterData\Accounting\MasterCoa;
use Yajra\DataTables\Services\DataTable;

class MasterCoaDataTable extends DataTable
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
        ->addColumn('action', function($account){
            $edit_url = route('account.edit', $account->id);
            $delete_url = route('account.destroy', $account->id);
            return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
        })
        ->editColumn('is_draft', function($account){
            return ($account->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Accounting\MasterCoa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterCoa $model)
    {
        return $model->newQuery()->select(
            'id',
            'branch_id',
            'acc_no_key',
            'acc_no_interface',
            'acc_description',
            'sub_acc_id',
            'acc_type',
            'rollup_key_acc_no',
            'acc_liquidity',
            'rollup_detail',
            'analysis_type',
            'foregin_currency_only_flag',
            'ap_ar_control_flag',
            'tour_account_flag',
            'fx_adjusment_flag',
            'inter_branch_acc_flag',
            'internal_payment_flag',
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
            'branch_id',
            'acc_no_key',
            'acc_no_interface',
            'acc_description',
            'sub_acc_id',
            'acc_type',
            'rollup_key_acc_no',
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
        return 'MasterData/Accounting/MasterCoa_' . date('YmdHis');
    }
}
