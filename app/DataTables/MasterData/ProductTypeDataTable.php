<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\ProductType;
use Yajra\DataTables\Services\DataTable;

class ProductTypeDataTable extends DataTable
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
            ->addColumn('action', function($productype){
                $edit_url = route('product-type.edit', $productype->id);
                $delete_url = route('product-type.destroy', $productype->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('product-type.update') && user_info()->hasAccess('product-type.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'product-type.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'product-type.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($productype){
                return ($productype->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\ProductType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductType $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'product_types.company_id')
            ->select(
                'product_types.id',
                'product_types.product_type_name',
                'product_types.product_type_code',
                'product_types.is_draft',
                'product_types.created_at'
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
            'product_type_name',
            'product_type_code',
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
        return 'MasterData/ProductType_' . date('YmdHis');
    }
}
