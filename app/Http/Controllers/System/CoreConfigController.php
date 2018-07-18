<?php

namespace App\Http\Controllers\System;

use App\Models\System\CoreConfig\CoreConfig;
use App\Models\System\CoreConfig\CoreConfigMain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\System\CoreConfigDataTable;
use App\Http\Requests\System\CoreConfigRequest;

class CoreConfigController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,core-config.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,core-config.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,core-config.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,core-config.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoreConfigDataTable $dataTable)
    {
        return $dataTable->render('contents.system.core_config.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.system.core_config.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\System\CoreConfigRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoreConfigRequest $request)
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
            $insert = CoreConfig::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('core-config.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('core-config.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('core-config.create');
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
     * @param  \App\Models\System\CoreConfig\CoreConfig  $coreConfig
     * @return \Illuminate\Http\Response
     */
    public function show(CoreConfig $coreConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System\CoreConfig\CoreConfig  $coreConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(CoreConfig $coreConfig)
    {
        $main = $coreConfig->main->toArray();
        $main['allow_backdate'] = ($main['allow_backdate']) ? 1 : 0;

        $coreConfig = $coreConfig->toArray();
        
        unset($main['id'], $coreConfig['main']);

        $merge = array_merge($coreConfig, $main);

        $coreConfig = (object) $merge;

        return view('contents.system.core_config.edit', compact('coreConfig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\System\CoreConfigRequest  $request
     * @param  \App\Models\System\CoreConfig\CoreConfig  $coreConfig
     * @return \Illuminate\Http\Response
     */
    public function update(CoreConfigRequest $request, CoreConfig $coreConfig)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('core-config.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('core-config.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('core-config.edit', $coreConfig->id);
            }

            $update = $coreConfig->update( $request->all() );
            if ($update) {
                $input = $request->all();
                $input['core_config_id'] = $coreConfig->id;

                $main = $coreConfig->main;
                $main->update($input);

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }

            flash()->error('<strong>Whoops! </strong> Something went wrong');        
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '. $e->getMessage());        
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\CoreConfig\CoreConfig  $coreConfig
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoreConfig $coreConfig)
    {
        $destroy = $coreConfig->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('core-config.index');
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
            CoreConfig::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('core-config.index');
    }
}
