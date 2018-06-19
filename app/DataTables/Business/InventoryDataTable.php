<?php

namespace App\DataTables\Business;

use App\Models\Business\Inventory\MasterInventory;
use Yajra\DataTables\Services\DataTable;

class InventoryDataTable extends DataTable
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
        ->addColumn('action', function($inventory){
            $edit_url = route('inventory.edit', $inventory->id);
            $delete_url = route('inventory.destroy', $inventory->id);
            return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
        })
        ->editColumn('is_draft', function($inventory){
            return ($inventory->is_draft) ? 'Yes' : 'No';
        })
        ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Business\Inventory\MasterInventory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterInventory $model)
    {
        return $model->newQuery()->select('id', 
         'trx_sales_id',
         'inventory_type',
         'voucher_no',
         'product_code',
         'recevied_date',
         'booked_qty',
         'sold_qty',
         'status',
         'qty',
         'guest_name',
         'iata_no',
         'tour_code',
         'coupon_no',
         'nights',
         'rooms',
         'is_draft'
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
            'voucher_no' => ['title' => 'Voucher No'],
            'product_code' => ['title' => 'Product Code'],
            'recevied_date' => ['title' => 'Recevied Date'],
            'booked_qty' => ['title' => 'Booked'],
            'sold_qty' => ['title' => 'Sold'],
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
        return 'Business/Inventory_' . date('YmdHis');
    }
}
