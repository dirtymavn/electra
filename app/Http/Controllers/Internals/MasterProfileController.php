<?php

namespace App\Http\Controllers\Internals;

use App\Models\Internals\MasterProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Internals\MasterProfileDataTable;

use DB;

class MasterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MasterProfileDataTable $dataTable)
    {
        return $dataTable->render('contents.internals.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.internals.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
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

            $insert = MasterProfile::create( $request->all() );

            if ($insert) {
                $redirect = redirect()->route('profile.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('profile.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('profile.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong');
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Internals\MasterProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(MasterProfile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Internals\MasterProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterProfile $profile)
    {
        return view('contents.internals.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Internals\MasterProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterProfile $profile)
    {
        DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('profile.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('profile.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('profile.index');
            }

            $insert = $profile->update( $request->all() );
            
            if ($insert) {
                \DB::commit();
                flash()->success($msgSuccess);
                return $redirect;
            } else {
                flash()->error('Data is failed to updated');
                return redirect()->back()->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {
            
            DB::rollback();
            flash()->error('Data is failed to updated');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Internals\MasterProfile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterProfile $profile)
    {
        $destroy = $profile->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('profile.index');
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
            MasterProfile::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('profile.index');
    }
}
