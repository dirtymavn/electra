<?php

namespace App\DataTables\Setting;

use App\Models\Setting\AccountingConfig\AccountingConfig;
use Yajra\DataTables\Services\DataTable;

class AccountingConfigDataTable extends DataTable
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
            ->addColumn('action', function($accountingconfig){
                $edit_url = route('accounting-config.edit', $accountingconfig->id);
                $delete_url = route('accounting-config.destroy', $accountingconfig->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('accounting-config.update') && user_info()->hasAccess('accounting-config.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'accounting-config.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'accounting-config.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($accountingconfig){
                return ($accountingconfig->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting\AccountingConfig $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccountingConfig $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'accounting_configs.company_id')
            ->join('core_forms', 'core_forms.id', '=', 'accounting_configs.core_form_id')
            ->select(
                'accounting_configs.id',
                'core_forms.name as core_form_name',
                'accounting_configs.is_draft',
                'accounting_configs.created_at'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('accounting_configs.company_id', user_info('company_id'));
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
            'core_form_name' => ['name' => 'core_forms.name', 'data' => 'core_form_name', 'title' => 'Core Form'],
            'is_draft',
            'created_at' => ['name' => 'accounting_configs.created_at', 'data' => 'created_at', 'title' => 'Created At']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting/AccountingConfig_' . date('YmdHis');
    }
}
