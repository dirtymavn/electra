<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\Hotel\HotelAllotment;
use Yajra\DataTables\Services\DataTable;

class HotelAllotmentDataTable extends DataTable
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
                $edit_url = route('hotel-allotment.edit', $type->id);
                $delete_url = route('hotel-allotment.destroy', $type->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('hotel-allotment.update') && user_info()->hasAccess('hotel-allotment.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'hotel-allotment.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'hotel-allotment.destroy'])) {
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
     * @param \App\Models\MasterData\Hotel\HotelAllotment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HotelAllotment $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_hotel_allotment.company_id')
            ->select(
                'master_hotel_allotment.id',
                'master_hotel_allotment.address_info',
                'master_hotel_allotment.name_info',
                'master_hotel_allotment.all_contact_person_info'
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
            'address_info',
            'name_info',
            'all_contact_person_info'
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterData/HotelAllotment_' . date('YmdHis');
    }
}
