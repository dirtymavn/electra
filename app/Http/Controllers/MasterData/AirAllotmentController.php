<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\AirAllotment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\AirAllotmentDataTable;
use App\Http\Requests\MasterData\AirAllotmentRequest;
use App\Models\MasterData\Airport;
use App\Models\MasterData\Airline;


class AirAllotmentController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,air-allotment.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,air-allotment.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,air-allotment.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,air-allotment.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AirAllotmentDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.air_allotment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataairport = Airport::getDataAvailable()->pluck('airports.airport_name', 'airports.id')->all();
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')->all();
        return view('contents.master_datas.air_allotment.create', compact('dataairport', 'dataairline'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\AirAllotmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AirAllotmentRequest $request)
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
            $insert = AirAllotment::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('air-allotment.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('air-allotment.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('air-allotment.create');
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
     * @param  \App\Models\MasterData\AirAllotment  $AirAllotment
     * @return \Illuminate\Http\Response
     */
    public function show(AirAllotment $AirAllotment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\AirAllotment  $AirAllotment
     * @return \Illuminate\Http\Response
     */
    public function edit(AirAllotment $AirAllotment)
    {
        $dataairport = Airport::getDataAvailable()->pluck('airports.airport_name', 'airports.id');
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id');
        return view('contents.master_datas.air_allotment.edit')->with([
                                                                        'airallotment' => $AirAllotment,
                                                                        'dataairport' => $dataairport,
                                                                        'dataairline' => $dataairline
                                                                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\AirAllotmentRequest  $request
     * @param  \App\Models\MasterData\AirAllotment  $AirAllotment
     * @return \Illuminate\Http\Response
     */
    public function update(AirAllotmentRequest $request, AirAllotment $AirAllotment)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('air-allotment.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('air-allotment.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('air-allotment.edit', $AirAllotment->id);
            }

            $update = $AirAllotment->update($request->all());

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
     * @param  \App\Models\MasterData\AirAllotment  $AirAllotment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AirAllotment $AirAllotment)
    {
        $AirAllotment->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('air-allotment.index');
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
            AirAllotment::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('air-allotment.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = AirAllotment::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($type) {
            $excel->sheet('Sheet 1', function($sheet) use ($type) {
                $sheet->fromArray($type);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $types = AirAllotment::all();
        $pdf = \PDF::loadView('contents.master_datas.air_allotment.pdf', compact('types'));
        return $pdf->download('air-allotment.pdf');
    }
}
