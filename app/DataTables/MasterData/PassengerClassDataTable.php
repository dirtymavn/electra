<?php

namespace App\DataTables\MasterData;

use App\Models\MasterData\PassengerClass;
use Yajra\DataTables\Services\DataTable;

class PassengerClassDataTable extends DataTable
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
            ->addColumn('action', function($passenger){
                $edit_url = route('passenger.edit', $passenger->id);
                $delete_url = route('passenger.destroy', $passenger->id);
                if (user_info()->hasAccess('admin.company') || (user_info()->hasAccess('passenger.update') && user_info()->hasAccess('passenger.destroy')) ) {
                    return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
                } elseif (user_info()->hasAnyAccess(['admin.company', 'passenger.update'])) {
                    return view('partials.action-button')->with(compact('edit_url'));    
                } elseif (user_info()->hasAnyAccess(['admin.company', 'passenger.destroy'])) {
                    return view('partials.action-button')->with(compact('delete_url'));
                } else {
                    return '-';
                }
            })
            ->editColumn('passenger_class_type', function($passenger){
                return ucwords(str_replace('_', ' ', $passenger->passenger_class_type));
            })
            ->editColumn('is_draft', function($passenger){
                return ($passenger->is_draft) ? 'Yes' : 'No';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MasterData\PassengerClass $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PassengerClass $model)
    {
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'passenger_class.company_id')
            ->select(
                'passenger_class.id',
                'passenger_class.passenger_class_name',
                'passenger_class.passenger_class_code',
                'passenger_class.passenger_class_type',
                'passenger_class.is_draft',
                'passenger_class.created_at'
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
            'passenger_class_name',
            'passenger_class_code',
            'passenger_class_type',
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
        return 'MasterData/PassengerClass_' . date('YmdHis');
    }
}
