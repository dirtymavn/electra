<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\CompanyBranchDataTable;
use App\Http\Requests\MasterData\CompanyBranchRequest;

class CompanyBranchController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,branch.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,branch.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,branch.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,branch.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyBranchDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.company_branch.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.company_branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CompanyBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyBranchRequest $request)
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

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
            $insert = Branch::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('branch.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('branch.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('branch.create');
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
     * @param  \App\Models\MasterData\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('contents.master_datas.company_branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CompanyBranchRequest  $request
     * @param  \App\Models\MasterData\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyBranchRequest $request, Branch $branch)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('branch.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('branch.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('branch.edit', $branch->id);
            }

            $update = $branch->update($request->all());

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
     * @param  \App\Models\MasterData\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        if ($branch->users->count() > 0) {
            flash()->error(trans('message.have_related'));
        } else {
            $branch->delete();
            flash()->success(trans('message.delete.success'));
        }

        return redirect()->route('branch.index');
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
            Branch::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->error(trans('message.delete.error'));
        }

        return redirect()->route('branch.index');
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchData(Request $request)
    {
        $results = Branch::getAvailableData()
            ->select('company_branchs.id', 'company_branchs.branch_name as text')
            ->where('company_branchs.branch_name', 'ilike', '%'.$request->search.'%')
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
    }
}
