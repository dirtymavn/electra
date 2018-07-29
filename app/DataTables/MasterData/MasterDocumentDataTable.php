<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Document\MasterDocument;
use Yajra\DataTables\Services\DataTable;

class MasterDocumentDataTable extends DataTable
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
        ->addColumn('action', function($document){
            $edit_url = route('document.edit', $document->id);
            $delete_url = route('document.destroy', $document->id);
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('document.update') && user_info()->hasAccess('document.destroy')) ) {
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'document.update'])) {
                return view('partials.action-button')->with(compact('edit_url'));    
            } elseif (user_info()->hasAnyAccess(['admin.company', 'document.destroy'])) {
                return view('partials.action-button')->with(compact('delete_url'));
            } else {
                return '-';
            }
        })
        ->editColumn('is_draft', function($document){
            return ($document->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\Document\MasterDocument $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterDocument $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'master_documents.company_id')
        ->select(
            'master_documents.id',
            'document_type',
            'document_uri',
            'master_documents.is_draft',
            'master_documents.created_at'
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
            'document_type',
            'document_uri',
        //    'is_draft',
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
        return 'MasterData/MasterDocument_' . date('YmdHis');
    }
}
