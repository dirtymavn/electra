<?php

namespace App\DataTables\Business;

use App\Models\Business\Sales\TrxSales as Sales;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
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
        ->addColumn('action', function($sales){
            $edit_url = route('sales.edit', $sales->id);
            $delete_url = route('sales.destroy', $sales->id);
            if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('sales.update') && user_info()->hasAccess('sales.destroy')) ) {
                return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
            } elseif (user_info()->hasAnyAccess(['admin.company', 'sales.update'])) {
                return view('partials.action-button')->with(compact('edit_url'));    
            } elseif (user_info()->hasAnyAccess(['admin.company', 'sales.destroy'])) {
                return view('partials.action-button')->with(compact('delete_url'));
            } else {
                return '-';
            }
        })
        ->editColumn('is_draft', function($sales){
            return ($sales->is_draft) ? 'Yes' : 'No';
        });
    }
    
    /**
    * Get query source of dataTable.
    *
    * @param \App\Models\Business\Sales $model
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query(Sales $model)
    {
        $return = $model->newQuery()
        ->leftJoin('companies', 'companies.id', '=', 'trx_sales.company_id')
        ->select(
            'sales_no',
            'customer_id',
            'trip_date',
            'deadline',
            'your_ref',
            'our_ref',
            'tc_id',
            'invoice_no',
            'sales_date',
            'ticket_amt',
            'rebate',
            'trx_sales.id'
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
            'sales_no',
            'customer_id',
            'trip_date',
            'deadline',
            'your_ref',
            'our_ref',
            'tc_id',
            'invoice_no',
            'sales_date',
            'ticket_amt',
            'rebate',
        ];
        
    }
    
    /**
    * Get filename for export.
    *
    * @return string
    */
    protected function filename()
    {
        return 'Business/Delivery_' . date('YmdHis');
    }
}
