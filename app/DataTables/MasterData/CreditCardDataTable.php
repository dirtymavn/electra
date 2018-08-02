<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\CreditCard;
use Yajra\DataTables\Services\DataTable;

class CreditCardDataTable extends DataTable
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
                $edit_url = route('credit-card.edit', $type->id);
                $delete_url = route('credit-card.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('credit-card.update') && user_info()->hasAccess('credit-card.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'credit-card.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'credit-card.destroy'])) {
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
     * @param \App\Models\MasterData\CreditCard $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CreditCard $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_credit_card.company_id')
            ->select(
                'master_credit_card.id',
                'master_credit_card.number',
                'master_credit_card.expire_date',
                'master_credit_card.name',
                'master_credit_card.address',
                'master_credit_card.state',
                'master_credit_card.city',
                'master_credit_card.zipcode',
                'master_credit_card.cvv'
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
            'number',
            'expire_date',
        //    'is_draft',
            'name'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/CreditCard_' . date('YmdHis');
    }
}
