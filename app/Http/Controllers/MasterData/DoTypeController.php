<?php

namespace App\Http\Controllers\MasterData;


use App\Models\MasterData\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\DoTypeDataTable;
use App\Http\Requests\MasterData\DoTypeRequest;

use App\Models\Business\Delivery\DoType;

class DoTypeController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,dotype.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,dotype.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,dotype.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,dotype.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoTypeDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.dotype.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.dotype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\DoTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoTypeRequest $request)
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
            $insert = DoType::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('dotype.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('dotype.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('dotype.create');
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
     * @param  \App\Models\MasterData\DoType  $dotype
     * @return \Illuminate\Http\Response
     */
    public function show(DoType $dotype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\DoType  $dotype
     * @return \Illuminate\Http\Response
     */
    public function edit(DoType $dotype)
    {
        return view('contents.master_datas.dotype.edit', compact('dotype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\DoTypeRequest  $request
     * @param  \App\Models\MasterData\DoType  $dotype
     * @return \Illuminate\Http\Response
     */
    public function update(DoTypeRequest $request, DoType $dotype)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('dotype.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('dotype.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('dotype.edit', $dotype->id);
            }

            $update = $dotype->update($request->all());

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
     * @param  \App\Models\MasterData\DoType  $dotype
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoType $dotype)
    {
        $dotype->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('dotype.index');
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
            DoType::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('dotype.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $dotype = DoType::select('*')->get();
        Excel::create('testing-'.date('Ymd'), function($excel) use ($dotype) {
            $excel->sheet('Sheet 1', function($sheet) use ($dotype) {
                $sheet->fromArray($dotype);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $dotype = DoType::all();
        $pdf = PDF::loadView('contents.master_datas.dotype.pdf', compact('dotypes'));
        return $pdf->download('dotype.pdf');
    }

    public function searchData(Request $request)
    {
        $results = DoType::getAvailableData()
            ->select('do_types.id', 'do_types.do_type_name as text')
            ->where('do_types.do_type_name', 'ilike', '%'.$request->search.'%')
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
    }
}
