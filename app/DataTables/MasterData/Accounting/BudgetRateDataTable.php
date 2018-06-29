<?php

namespace App\DataTables\MasterData\Accounting;

use App\Models\MasterData\Accounting\BudgetRate;
use Yajra\DataTables\Services\DataTable;

class BudgetRateDataTable extends DataTable
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
            ->addColumn('action', function($budgetrate){
                $edit_url = route('budget-rate.edit', $budgetrate->id);
                $delete_url = route('budget-rate.destroy', $budgetrate->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('is_draft', function($budgetrate){
                return ($budgetrate->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Accounting\BudgetRate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BudgetRate $model)
    {
        $return = $model->newQuery()
            ->join('companies', 'companies.id', '=', 'budget_rates.company_id')
            ->select(
                'budget_rates.id',
                'budget_rates.acc_period_mo',
                'budget_rates.from_currency',
                'budget_rates.to_currency',
                'budget_rates.exchange_rate',
                'budget_rates.is_draft'
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
            'acc_period_mo',
            'from_currency',
            'to_currency',
            'exchange_rate',
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
        return 'MasterData/Accounting/BudgetRate_' . date('YmdHis');
    }
}
