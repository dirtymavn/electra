<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Gst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\GstDataTable;
use App\Http\Requests\MasterData\GstRequest;

class GstController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,gst.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,gst.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,gst.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,gst.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GstDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.gst.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.gst.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\GstRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GstRequest $request)
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
            $insert = Gst::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('gst.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('gst.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('gst.create');
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
     * @param  \App\Models\MasterData\Gst  $gst
     * @return \Illuminate\Http\Response
     */
    public function show(Gst $gst)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Gst  $gst
     * @return \Illuminate\Http\Response
     */
    public function edit(Gst $gst)
    {
        return view('contents.master_datas.gst.edit', compact('gst'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\GstRequest  $request
     * @param  \App\Models\MasterData\Gst  $gst
     * @return \Illuminate\Http\Response
     */
    public function update(GstRequest $request, Gst $gst)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('gst.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('gst.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('gst.edit', $gst->id);
            }

            $update = $gst->update($request->all());

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
     * @param  \App\Models\MasterData\Gst  $gst
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gst $gst)
    {
        $gst->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('gst.index');
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
            Gst::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('gst.index');
    }
}
