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
        $return = $model->newQuery()
            ->leftJoin('companies', 'companies.id', '=', 'master_profile.company_id')
            ->select(
                'master_profile.id',
                'master_profile.staff_no',
                'master_profile.staff_fullname',
                'master_profile.status',
                'master_profile.type',
                'master_profile.title',
                'master_profile.home_tel',
                'master_profile.mobile',
                'master_profile.employment_date',
                'master_profile.branch_id',
                'master_profile.office_tel',
                'master_profile.fax_no',
                'master_profile.email',
                'master_profile.office_address',
                'master_profile.home_address',
                'master_profile.remark',
                'master_profile.dr_account',
                'master_profile.is_draft'
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
