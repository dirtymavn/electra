<?php

namespace App\DataTables\MasterData\Accounting;

use App\Models\MasterData\Accounting\FxTrans\TrxFxTrans;
use Yajra\DataTables\Services\DataTable;

class TrxFxTransactionDataTable extends DataTable
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
            ->addColumn('action', function($fxTrans){
                $edit_url = route('fx-trans.edit', $fxTrans->id);
                $delete_url = route('fx-trans.destroy', $fxTrans->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('fx-trans.update') && user_info()->hasAccess('fx-trans.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'fx-trans.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'fx-trans.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('invoice_flag', function($fxTrans){
                return ($fxTrans->invoice_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('letter_of_guarantee_flag', function($fxTrans){
                return ($fxTrans->letter_of_guarantee_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('credit_note_flag', function($fxTrans){
                return ($fxTrans->credit_note_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('deposit_overpayment_flag', function($fxTrans){
                return ($fxTrans->deposit_overpayment_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('ap_deposit_flag', function($fxTrans){
                return ($fxTrans->ap_deposit_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('cash_account_flag', function($fxTrans){
                return ($fxTrans->cash_account_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('bank_account_flag', function($fxTrans){
                return ($fxTrans->bank_account_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('other_account_flag', function($fxTrans){
                return ($fxTrans->other_account_flag) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('is_draft', function($fxTrans){
                return ($fxTrans->is_draft) ? 'Yes' : 'No';
            })
            ->rawColumns(['invoice_flag','letter_of_guarantee_flag',
            'credit_note_flag',
            'deposit_overpayment_flag',
            'ap_deposit_flag',
            'cash_account_flag',
            'bank_account_flag',
            'other_account_flag','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Accounting\FxTrans\TrxFxTrans $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TrxFxTrans $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'trx_fx_transactions.company_id')
            ->select(
                'trx_fx_transactions.id',
                'trx_fx_transactions.invoice_flag',
                'trx_fx_transactions.letter_of_guarantee_flag',
                'trx_fx_transactions.credit_note_flag',
                'trx_fx_transactions.deposit_overpayment_flag',
                'trx_fx_transactions.ap_deposit_flag',
                'trx_fx_transactions.cash_account_flag',
                'trx_fx_transactions.bank_account_flag',
                'trx_fx_transactions.other_account_flag',
                'trx_fx_transactions.jv_period',
                'trx_fx_transactions.acc_type',
                'trx_fx_transactions.fx_acc',
                'trx_fx_transactions.is_draft'
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
            'invoice_flag',
            'letter_of_guarantee_flag',
            'credit_note_flag',
            'deposit_overpayment_flag',
            'ap_deposit_flag',
            'cash_account_flag',
            'bank_account_flag',
            'other_account_flag',
            'jv_period',
            'acc_type',
            'fx_acc',
            // 'is_draft'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Accounting/TrxFxTransaction_' . date('YmdHis');
    }
}
