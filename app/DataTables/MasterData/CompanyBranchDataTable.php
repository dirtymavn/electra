<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Branch;
use Yajra\DataTables\Services\DataTable;

class CompanyBranchDataTable extends DataTable
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
            ->addColumn('action', function($branch){
                $edit_url = route('branch.edit', $branch->id);
                $delete_url = route('branch.destroy', $branch->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('branch.update') && user_info()->hasAccess('branch.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'branch.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'branch.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($branch){
                return ($branch->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Branch $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Branch $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'company_branchs.company_id')
            ->select(
                'company_branchs.id',
                'company_branchs.branch_name',
                'company_branchs.branch_code',
                'company_branchs.branch_address',
                'company_branchs.branch_phone',
                'company_branchs.is_draft',
                'company_branchs.created_at'
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
            'branch_name',
            'branch_code',
            'branch_address',
            'branch_phone',
        //    'is_draft',
            'created_at' => ['name' => 'company_branchs.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/CompanyBranch_' . date('YmdHis');
    }
}
