<?php

namespace App\Http\Controllers\Accounting\GL;

use App\Models\Accounting\GL\JvPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Accounting\GL\JvPeriodDataTable;
use App\Http\Requests\Accounting\GL\JvPeriodRequest;

class JvPeriodController extends Controller
{
    /**
     * @var App\Models\Accounting\GL\JvPeriod
    */
    protected $jvPeriod;

    /**
     * Create a new JvPeriodController instance.
     *
     * @param \App\Models\Accounting\GL\JvPeriod  $jvPeriod
    */
    public function __construct(JvPeriod $jvPeriod)
    {
        $this->jvPeriod = $jvPeriod;

        // middleware
        $this->middleware('sentinel_access:admin.company,jvperiod.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,jvperiod.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,jvperiod.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,jvperiod.destroy', ['only' => ['destroy']]);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JvPeriodDataTable $dataTable)
    {
        return $dataTable->render('contents.accountings.gl.jvperiod.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.accountings.gl.jvperiod.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Accounting\GL\JvPeriodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JvPeriodRequest $request)
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
            $insert = $this->jvPeriod->create($request->all());

            if ($insert) {
                $redirect = redirect()->route('jvperiod.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('jvperiod.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('jvperiod.create');
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
     * @param  \App\Models\Accounting\GL\JvPeriod  $jvPeriod
     * @return \Illuminate\Http\Response
     */
    public function show(JvPeriod $jvPeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accounting\GL\JvPeriod  $jvperiod
     * @return \Illuminate\Http\Response
     */
    public function edit(JvPeriod $jvperiod)
    {
        return view('contents.accountings.gl.jvperiod.edit', compact('jvperiod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Accounting\GL\JvPeriodRequest  $request
     * @param  \App\Models\Accounting\GL\JvPeriod  $jvperiod
     * @return \Illuminate\Http\Response
     */
    public function update(JvPeriodRequest $request, JvPeriod $jvperiod)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('jvperiod.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('jvperiod.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('jvperiod.edit', $jvperiod->id);
            }

            $update = $jvperiod->update($request->all());

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
     * @param  \App\Models\Accounting\GL\JvPeriod  $jvperiod
     * @return \Illuminate\Http\Response
     */
    public function destroy(JvPeriod $jvperiod)
    {
        $jvperiod->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('jvperiod.index');

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
            JvPeriod::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('jvperiod.index');
    }
}
