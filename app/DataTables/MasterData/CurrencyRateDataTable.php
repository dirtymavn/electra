<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Currency\Currency;
use Yajra\DataTables\Services\DataTable;

class CurrencyRateDataTable extends DataTable
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
            ->addColumn('action', function($currencyrate){
                $edit_url = route('currencyrate.edit', $currencyrate->id);
                $delete_url = route('currencyrate.destroy', $currencyrate->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('is_draft', function($currencyrate){
                return ($currencyrate->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Currency\Currency $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Currency $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'currency.company_id')
            ->select(
                'currency.id',
                'currency.currency_name',
                'currency.currency_code',
                'currency.is_draft',
                'currency.created_at'
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
            'currency_name',
            'currency_code',
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
        return 'MasterData/CurrencyRate_' . date('YmdHis');
    }
}
