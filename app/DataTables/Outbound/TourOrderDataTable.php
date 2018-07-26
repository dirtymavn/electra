<?php

namespace App\DataTables\Outbound;

use App\Models\Outbound\TrxTourOrder\TourOrder;
use Yajra\DataTables\Services\DataTable;

class TourOrderDataTable extends DataTable
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
            ->addColumn('action', function($tourorder){
                $edit_url = route('tourorder.edit', $tourorder->id);
                $delete_url = route('tourorder.destroy', $tourorder->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('tourorder.update') && user_info()->hasAccess('tourorder.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'tourorder.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'tourorder.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('depart_date', function($tourorder){
                return date('d F Y', strtotime($tourorder->depart_date));
            })
            ->editColumn('return_date', function($tourorder){
                return date('d F Y', strtotime($tourorder->return_date));
            });
            // ->editColumn('is_draft', function($tourorder){
            //     return ($tourorder->is_draft) ? 'Yes' : 'No';
            // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Outbound\TrxTourOrder\TourOrder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TourOrder $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'trx_tour_orders.company_id')
            ->join('trx_tour_order_tours', 'trx_tour_order_tours.trx_tour_order_id', '=', 'trx_tour_orders.id')
            ->join('master_customers', 'master_customers.id', '=', 'trx_tour_orders.customer_id')
            ->select(
                'trx_tour_orders.id',
                'trx_tour_orders.order_no',
                'master_customers.customer_name',
                'trx_tour_order_tours.tour_name',
                'trx_tour_order_tours.depart_date',
                'trx_tour_order_tours.return_date',
                'trx_tour_orders.is_draft',
                'trx_tour_orders.created_at'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('trx_tour_orders.company_id', @user_info()->company->id);
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
            'order_no' =>['name' => 'trx_tour_orders.order_no', 'data' => 'order_no'],
            'customer_name' =>['name' => 'master_customers.customer_name', 'data' => 'customer_name'],
            'tour_name' =>['name' => 'trx_tour_order_tours.tour_name', 'data' => 'tour_name'],
            'depart_date' =>['name' => 'trx_tour_order_tours.depart_date', 'data' => 'depart_date'],
            'return_date' =>['name' => 'trx_tour_order_tours.return_date', 'data' => 'return_date'],
            // 'is_draft' =>['name' => 'trx_tour_orders.is_draft', 'data' => 'is_draft'],
            'created_at' =>['name' => 'trx_tour_orders.created_at', 'data' => 'created_at']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Outbound/TourOrder_' . date('YmdHis');
    }
}
