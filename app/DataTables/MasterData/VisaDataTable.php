<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Visa;
use Yajra\DataTables\Services\DataTable;

class VisaDataTable extends DataTable
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
                $edit_url = route('visa.edit', $type->id);
                $delete_url = route('visa.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('visa.update') && user_info()->hasAccess('visa.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'visa.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'visa.destroy'])) {
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
     * @param \App\Models\MasterData\Visa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Visa $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_visa.company_id')
            ->select(
                'master_visa.id',
                'master_visa.visa_purpose',
                'master_visa.visa_code',
                'master_visa.visa_no'
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
            'visa_purpose',
            'visa_code',
            'visa_no'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/Visa_' . date('YmdHis');
    }
}
