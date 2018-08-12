<?php

namespace App\DataTables\Hotel;

use App\Models\Hotel\HotelBooking;
use Yajra\DataTables\Services\DataTable;

class HotelBookingDataTable extends DataTable
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
                $edit_url = route('hotel-booking.edit', $type->id);
                $delete_url = route('hotel-booking.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('hotel-booking.update') && user_info()->hasAccess('hotel-booking.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'hotel-booking.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'hotel-booking.destroy'])) {
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
     * @param \App\Models\Hotel\HotelBooking $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HotelBooking $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'trx_hotel_booking.company_id')
            ->join('master_hotel', 'master_hotel.id', '=', 'trx_hotel_booking.id_hotel')
            ->join('master_customers', 'master_customers.id', '=', 'trx_hotel_booking.id_customer')
            ->select(
                'trx_hotel_booking.id',
                'trx_hotel_booking.id_customer',
                'master_hotel.name',
                'master_customers.customer_name'
            );
        if (!user_info()->inRole('super-admin')) {

            $return = $return->where('trx_hotel_booking.company_id', @user_info()->company->id);
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
            'name' =>['name' => 'master_hotel.name', 'data' => 'name'],
            'customer_name' =>['name' => 'master_customers.customer_name', 'data' => 'customer_name'],
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Hotel/HotelBooking_' . date('YmdHis');
    }
}
