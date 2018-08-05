<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\RegionDataTable;
use App\Http\Requests\MasterData\RegionRequest;

use Excel;
use PDF;

class RegionController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,region.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,region.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,region.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,region.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RegionDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.region.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\RegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request)
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
            $insert = Region::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('region.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('region.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('region.create');
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
     * @param  \App\Models\MasterData\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('contents.master_datas.region.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\RegionRequest  $request
     * @param  \App\Models\MasterData\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, Region $region)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('region.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('region.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('region.edit', $region->id);
            }

            $update = $region->update($request->all());

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
     * @param  \App\Models\MasterData\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('region.index');
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
            Region::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('region.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $region = Region::select('*')->get();
        Excel::create('testing-'.date('Ymd'), function($excel) use ($region) {
            $excel->sheet('Sheet 1', function($sheet) use ($region) {
                $sheet->fromArray($region);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $regions = Region::all();
        $pdf = PDF::loadView('contents.master_datas.region.pdf', compact('regions'));
        return $pdf->download('region.pdf');
    }
}
