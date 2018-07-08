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
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('account.update') && user_info()->hasAccess('account.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'account.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'account.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
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
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_coa.company_id')
            ->select(
                'master_coa.id',
                'master_coa.branch_id',
                'master_coa.acc_no_key',
                'master_coa.acc_no_interface',
                'master_coa.acc_description',
                'master_coa.sub_acc_id',
                'master_coa.acc_type',
                'master_coa.rollup_key_acc_no',
                'master_coa.acc_liquidity',
                'master_coa.rollup_detail',
                'master_coa.analysis_type',
                'master_coa.foregin_currency_only_flag',
                'master_coa.ap_ar_control_flag',
                'master_coa.tour_account_flag',
                'master_coa.fx_adjusment_flag',
                'master_coa.inter_branch_acc_flag',
                'master_coa.internal_payment_flag',
                'master_coa.is_draft'
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
