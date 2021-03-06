<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\System\CoreStatusDataTable;
use App\Http\Requests\System\CoreStatusRequest;
use App\Models\System\CoreStatus;

class CoreStatusController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,core-status.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,core-status.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,core-status.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,core-status.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoreStatusDataTable $dataTable)
    {
        return $dataTable->render('contents.system.core_status.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.system.core_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\System\CoreStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $insert = CoreStatus::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('core-status.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('core-status.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('core-status.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System\CoreStatus $status
     * @return \Illuminate\Http\Response
     */
    public function show(CoreStatus $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$status = CoreStatus::find($id);
        return view('contents.system.core_status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\System\CoreStatusRequest  $request
     * @param  \App\Models\System\CoreStatus $status
     * @return \Illuminate\Http\Response
     */
    public function update(CoreStatusRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('core-status.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('core-status.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('core-status.edit', $id);
            }

            $update = CoreStatus::find($id)->update($request->all());

            if ($update) {

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\CoreStatus $status
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CoreStatus::find($id)->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('core-status.index');
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
            CoreStatus::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('core-status.index');
    }
}
