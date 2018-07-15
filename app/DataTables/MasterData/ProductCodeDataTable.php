<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\ProductCode\ProductCode;
use Yajra\DataTables\Services\DataTable;

class ProductCodeDataTable extends DataTable
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
            ->addColumn('action', function($productcode){
                $edit_url = route('productcode.edit', $productcode->id);
                $delete_url = route('productcode.destroy', $productcode->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('productcode.update') && user_info()->hasAccess('productcode.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'productcode.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'productcode.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('is_draft', function($productcode){
                return ($productcode->is_draft) ? 'Yes' : 'No';
            })
            ->editColumn('status', function($productcode){
                return ($productcode->status) ? 'Active' : 'Inactive';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\ProductCode\ProductCode $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductCode $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'product_codes.company_id')
            ->select(
                'product_codes.id',
                'product_codes.product_code',
                'product_codes.product_name',
                'product_codes.status',
                'product_codes.is_draft',
                'product_codes.created_at'
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
            'product_code',
            'product_name',
            'status',
            'is_draft',
            'created_at' => ['name' => 'product_codes.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/ProductCode_' . date('YmdHis');
    }
}
