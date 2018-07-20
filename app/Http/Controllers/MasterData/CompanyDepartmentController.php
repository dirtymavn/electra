<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\CompanyDepartmentDataTable;
use App\Http\Requests\MasterData\CompanyDepartmentRequest;

class CompanyDepartmentController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,department.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,department.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,department.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,department.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDepartmentDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.company_department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.company_department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CompanyDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyDepartmentRequest $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = Department::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('department.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('department.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('department.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('contents.master_datas.company_department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CompanyDepartmentRequest  $request
     * @param  \App\Models\MasterData\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyDepartmentRequest $request, Department $department)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('department.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('department.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('department.edit', $department->id);
            }

            $update = $department->update($request->all());

            if ($update) {

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if ($department->users->count() > 0) {
            flash()->error(trans('message.have_related'));
        } else {
            $department->delete();
            flash()->success(trans('message.delete.success'));
        }

        return redirect()->route('department.index');
    }

    /**
     * Remove the many resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        if ( count($ids) > 0 ) {
            Department::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->error(trans('message.delete.error'));
        }

        return redirect()->route('department.index');
    }
}
