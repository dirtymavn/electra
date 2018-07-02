<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Inventory\MasterInventory;
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
     * @param \App\Models\MasterData\Inventory\MasterInventory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterInventory $model)
    {
        $return = $model->newQuery()
            ->join('companies', 'companies.id', '=', 'master_inventory.company_id')
            ->select(
                'master_inventory.id', 
                'master_inventory.trx_sales_id',
                'master_inventory.inventory_type',
                'master_inventory.voucher_no',
                'master_inventory.product_code',
                'master_inventory.recevied_date',
                'master_inventory.booked_qty',
                'master_inventory.sold_qty',
                'master_inventory.status',
                'master_inventory.qty',
                'master_inventory.guest_name',
                'master_inventory.iata_no',
                'master_inventory.tour_code',
                'master_inventory.coupon_no',
                'master_inventory.nights',
                'master_inventory.rooms',
                'master_inventory.is_draft',
                'master_inventory.created_at'
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
        return 'MasterData/Inventory_' . date('YmdHis');
    }
}
