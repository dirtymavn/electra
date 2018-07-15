<?php

namespace App\DataTables\MasterData;

use App\Models\Business\Delivery\DoType;
use Yajra\DataTables\Services\DataTable;

class DoTypeDataTable extends DataTable
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
        ->addColumn('action', function($dotype){
            $edit_url = route('dotype.edit', $dotype->id);
            $delete_url = route('dotype.destroy', $dotype->id);
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('dotype.update') && user_info()->hasAccess('dotype.destroy')) ) {
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'dotype.update'])) {
                return view('partials.action-button')->with(compact('edit_url'));    
            } elseif (user_info()->hasAnyAccess(['admin.company', 'dotype.destroy'])) {
                return view('partials.action-button')->with(compact('delete_url'));
            } else {
                return '-';
            }
        })
        ->editColumn('is_draft', function($dotype){
            return ($dotype->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\DoType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DoType $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'do_types.company_id')
        ->select(
            'do_types.id',
            'do_type_name',
            'do_type_code',
            'do_type_status',
            'do_types.is_draft',
            'do_types.created_at'
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
            'do_type_name',
            'do_type_code',
            'do_type_status',
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
        return 'MasterData/DoType_' . date('YmdHis');
    }
}
