<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Voucher\MasterVoucher;
use Yajra\DataTables\Services\DataTable;

class VoucherDataTable extends DataTable
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
            ->addColumn('action', function($voucher){
                $edit_url = route('voucher.edit', $voucher->id);
                $delete_url = route('voucher.destroy', $voucher->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('voucher.update') && user_info()->hasAccess('voucher.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'voucher.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'voucher.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($voucher){
                return ($voucher->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Voucher\MasterVoucher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterVoucher $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_voucher.company_id')
            ->select(
                'master_voucher.id',
                'master_voucher.voucher_no',
                'master_voucher.voucher_status',
                'master_voucher.voucher_date',
                'master_voucher.voucher_currency',
                'master_voucher.voucher_amt',
                'master_voucher.valid_from',
                'master_voucher.valid_to',
                'master_voucher.transferrable_flag',
                'master_voucher.internal_desc',
                'master_voucher.desc',
                'master_voucher.cust_no',
                'master_voucher.cust_name',
                'master_voucher.cust_address',
                'master_voucher.is_draft',
                'master_voucher.created_at',
                'master_voucher.updated_at'
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
            'voucher_no',
            'voucher_date',
            'valid_from',
            'valid_to',
            'cust_no',
            'cust_name',
            'cust_address',
            'is_draft',
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Voucher_' . date('YmdHis');
    }
}
