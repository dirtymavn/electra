<?php

namespace App\DataTables\Budget;

use App\Models\Budget\BudgetRate;
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
     * @param \App\Models\Budget\BudgetRate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BudgetRate $model)
    {
        return $model->newQuery()->select(
            'id',
            'acc_period_mo',
            'from_currency',
            'to_currency',
            'exchange_rate',
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
        return 'Budget/BudgetRate_' . date('YmdHis');
    }
}
