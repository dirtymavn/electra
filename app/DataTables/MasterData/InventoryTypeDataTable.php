<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\InventoryType;
use Yajra\DataTables\Services\DataTable;

class InventoryTypeDataTable extends DataTable
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
                $edit_url = route('inventory-type.edit', $type->id);
                $delete_url = route('inventory-type.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('inventory-type.update') && user_info()->hasAccess('inventory-type.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'inventory-type.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'inventory-type.destroy'])) {
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
     * @param \App\Models\MasterData\InventoryType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(InventoryType $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_inventory_type.company_id')
            ->select(
                'master_inventory_type.id',
                'master_inventory_type.inventory_type_name',
                'master_inventory_type.inventory_type_code',
                'master_inventory_type.is_draft',
                'master_inventory_type.created_at'
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
            'inventory_type_name',
            'inventory_type_code',
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
        return 'MasterData/InventoryType_' . date('YmdHis');
    }
}
