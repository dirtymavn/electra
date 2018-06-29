<?php

namespace App\DataTables\Accounting\GL;

use App\Models\Accounting\GL\JvPeriod;
use Yajra\DataTables\Services\DataTable;

class JvPeriodDataTable extends DataTable
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
            ->addColumn('action', function($jvperiod){
                $edit_url = route('jvperiod.edit', $jvperiod->id);
                $delete_url = route('jvperiod.destroy', $jvperiod->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('is_draft', function($jvperiod){
                return ($jvperiod->is_draft) ? 'Yes' : 'No';
            })
            ->editColumn('period_status', function($jvperiod){
                return ($jvperiod->period_status) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Accounting\GL\JvPeriod $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JvPeriod $model)
    {
        $return = $model->newQuery()
            ->join('companies', 'companies.id', '=', 'master_jv_periods.company_id')
            ->select(
                'master_jv_periods.id',
                'master_jv_periods.fiscal_year',
                'master_jv_periods.period_month',
                'master_jv_periods.period_status',
                'master_jv_periods.start_date',
                'master_jv_periods.end_date',
                'master_jv_periods.report_date',
                'master_jv_periods.is_draft'
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
            'fiscal_year',
            'period_month',
            'period_status',
            'start_date',
            'end_date',
            'report_date',
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
        return 'Accounting/GL/JvPeriod_' . date('YmdHis');
    }
}
