<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\ProductCategory;
use Yajra\DataTables\Services\DataTable;

class ProductCategoryDataTable extends DataTable
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
    ->addColumn('action', function($product){
        $edit_url = route('product-category.edit', $product->id);
        $delete_url = route('product-category.destroy', $product->id);
        if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('product-category.update') && user_info()->hasAccess('product-category.destroy')) ) {
            return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
        } elseif (user_info()->hasAnyAccess(['admin.company', 'product-category.update'])) {
            return view('partials.action-button')->with(compact('edit_url'));    
        } elseif (user_info()->hasAnyAccess(['admin.company', 'product-category.destroy'])) {
            return view('partials.action-button')->with(compact('delete_url'));
        } else {
            return '-';
        }
    })
    ->editColumn('is_draft', function($product){
        return ($product->is_draft) ? 'Yes' : 'No';
    });
}

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\ProductCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductCategory $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'master_product_categories.company_id')
        ->select(
            'master_product_categories.category_name',
            'master_product_categories.category_code',
            'master_product_categories.parent_category_id',
            'master_product_categories.company_id',
            'master_product_categories.is_draft',
            'master_product_categories.created_at',
            'master_product_categories.id'
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
            'category_name',
            'category_code',
            // 'parent_category_id',
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
        return 'MasterData/ProductCategory_' . date('YmdHis');
    }
}
