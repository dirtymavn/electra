<?php

namespace App\DataTables\Business;

use App\Models\Business\Supplier\MasterSupplier;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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
            ->addColumn('action', function($supplier){
                $edit_url = route('supplier.edit', $supplier->id);
                $delete_url = route('supplier.destroy', $supplier->id);
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            })
            ->editColumn('is_draft', function($customer){
                return ($customer->is_draft) ? 'Yes' : 'No';
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Business\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterSupplier $model)
    {
        return $model->newQuery()->select('id', 
            'supplier_no',
            'supplier_type',
            'name',
            'status', 
            'is_draft',
            'created_at'
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
            'supplier_no' => ['title' => 'Supplier No'],
            'supplier_type' => ['title' => 'Supplier Type'],
            'name' => ['title' => 'Name'],
            'status' => ['title' => 'Status'],
            'is_draft' => ['title' => 'Is Draft'],
            'created_at' => ['title' => 'Created At'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Business/Supplier_' . date('YmdHis');
    }
}
