<?php

namespace App\DataTables\Internals;

use App\Models\Internals\MasterProfile;
use Yajra\DataTables\Services\DataTable;

class MasterProfileDataTable extends DataTable
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
        ->addColumn('action', function($profile){
            $edit_url = route('profile.edit', $profile->id);
            $delete_url = route('profile.destroy', $profile->id);
            return view('partials.action-button')->with(compact('edit_url', 'delete_url'));
        })
        ->editColumn('is_draft', function($profile){
            return ($profile->is_draft) ? 'Yes' : 'No';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Internals\MasterProfile $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MasterProfile $model)
    {
        return $model->newQuery()->select(
            'id',
            'staff_no',
            'staff_fullname',
            'status',
            'type',
            'title',
            'home_tel',
            'mobile',
            'employment_date',
            'branch_id',
            'office_tel',
            'fax_no',
            'email',
            'office_address',
            'home_address',
            'remark',
            'dr_account',
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
         'staff_no',
         'staff_fullname',
         'status',
         'type',
         'title',
         'home_tel',
         'mobile',
         'employment_date',
         'is_draft',
     ];

 }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Internals/MasterProfile_' . date('YmdHis');
    }
}
