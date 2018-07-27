<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\AirlineDataTable;

use Excel;
use PDF;

class AirlineController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,airline.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,airline.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,airline.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,airline.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AirlineDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.airline.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.airline.create');
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

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = Airline::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('airline.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('airline.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('airline.create');
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
     * @param  \App\Models\MasterData\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline = Airline::find($id);
        return view('contents.master_datas.airline.edit')->with(['airline' => $airline]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('airline.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('airline.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('airline.edit', $airline->id);
            }

            $update = $airline->update($request->all());

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
     * @param  \App\Models\MasterData\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airline = Airline::find($id);
        if ($airline->orderSellings->count() > 0) {
            flash()->error(trans('message.have_related'));
        } else {
            $airline->delete();
            flash()->success(trans('message.delete.success'));
        }

        return redirect()->route('airline.index');
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
            Airline::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('airline.index');
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchData(Request $request)
    {
        $results = Airline::getAvailableData()
            ->select('airlines.id', 'airlines.airline_name as text')
            ->where('airlines.airline_name', 'ilike', '%'.$request->search.'%')
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
    }

    public function getAirlineById(Request $request)
    {
        $result = Airline::find($request->id);

        return json_encode($result);
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $airline = Airline::select('*')->get();
        Excel::create('testing-'.date('Ymd'), function($excel) use ($airline) {
            $excel->sheet('Sheet 1', function($sheet) use ($airline) {
                $sheet->fromArray($airline);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $airlines = Airline::all();
        $pdf = PDF::loadView('contents.master_datas.airline.pdf', compact('airlines'));
        return $pdf->download('airline.pdf');
    }
}
