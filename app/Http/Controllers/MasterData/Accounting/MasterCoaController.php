<?php

namespace App\Http\Controllers\MasterData\Outbound;

use App\Models\GL\MasterCoa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\GL\MasterCoaDataTable;

class MasterCoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MasterCoaDataTable $dataTable)
    {
        return $dataTable->render('contents.gl.account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.gl.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

            $insert = MasterCoa::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('account.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('account.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('account.create');
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
     * @param  \App\Models\GL\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCoa $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GL\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCoa $account)
    {
        return view('contents.gl.account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GL\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterCoa $account)
    {
         \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('account.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('account.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('account.edit', $account->id);
            }

            $update = $account->update($request->all());

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
     * @param  \App\Models\GL\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCoa $account)
    {
        $account->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('account.index');
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
            MasterCoa::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('account.index');
    }
}
