<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Visa;
use App\Models\MasterData\VisaDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\VisaDataTable;
use App\Http\Requests\MasterData\VisaRequest;
use App\Models\MasterData\Airport;
use App\Models\MasterData\Airline;
use App\Models\Temporary;


class VisaController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,visa.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,visa.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,visa.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,visa.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VisaDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.visa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $dataairport = Airport::getDataAvailable()->pluck('airports.airport_name', 'airports.id')->all();
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')->all();
        return view('contents.master_datas.visa.create', compact('dataairport', 'dataairline'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\VisaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisaRequest $request)
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
            $insert = Visa::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('visa.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('visa.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('visa.create');
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
     * @param  \App\Models\MasterData\Visa  $Visa
     * @return \Illuminate\Http\Response
     */
    public function show(Visa $Visa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Visa  $Visa
     * @return \Illuminate\Http\Response
     */
    public function edit(Visa $Visa)
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $parent = $Visa->toArray();

        foreach ($Visa->visaDocument as $key => $value) {
            $data = [
                'master_visa_id' => $Visa->id,
                'document_type' => $value->document_type,
                'document_uri' => $value->document_uri
            ];
            Temporary::create([
                'type' => 'visadocument-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $arrayMerge = array_merge($parent);
        
        $Visa = (object)$arrayMerge;

        $dataairport = Airport::getDataAvailable()->pluck('airports.airport_name', 'airports.id');
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id');
        return view('contents.master_datas.visa.edit')->with([
                                                                        'Visa' => $Visa,
                                                                        'dataairport' => $dataairport,
                                                                        'dataairline' => $dataairline
                                                                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\VisaRequest  $request
     * @param  \App\Models\MasterData\Visa  $Visa
     * @return \Illuminate\Http\Response
     */
    public function update(VisaRequest $request, Visa $Visa)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('visa.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('visa.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('visa.edit', $Visa->id);
            }

            $update = $Visa->update($request->all());

            if ($update) {

                $input = $request->all();
                $input['master_visa_id'] = $Visa->id;

                $datavisadocument =  $Visa->visaDocument;
                foreach ($datavisadocument as $value) {
                    $value->delete();
                }
                $Visadocument = \DB::table('temporaries')->whereType('visadocument-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Visadocument) > 0) {
                    foreach ($Visadocument as $Visadocumentvalue) {
                        $visdocData = json_decode($Visadocumentvalue->data);

                        $visdoc = new VisaDocument;
                        $visdoc->master_visa_id = $Visa->id;
                        $visdoc->document_type = $visdocData->document_type;
                        $visdoc->document_uri = $visdocData->document_uri;
                        $visdoc->company_id = user_info('company_id');
                        $visdoc->save();
                    }
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Visa  $Visa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visa $Visa)
    {
        $Visa->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('visa.index');
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
            Visa::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('visa.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = Visa::select('*')->get();
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
        $types = Visa::all();
        $pdf = \PDF::loadView('contents.master_datas.visa.pdf', compact('types'));
        return $pdf->download('visa.pdf');
    }

    public function detailData(Request $request)
    {
        $datas = [];
        $results = \DB::table('temporaries')->whereType($request->type)
            ->whereUserId(user_info('id'))
            ->select('id','data')
            ->get();

        if (count($results) > 0) {
            foreach ($results as $result) {
                $value = collect(json_decode($result->data))->toArray();
                
                $value['id'] = $result->id;

                array_push($datas, $value);
            }
        }

        $datas = collect($datas);
        
        if ($request->type == 'visadocument-detail') {
            $classEdit = 'editdatavisadocument';
            $classDelete = 'deletedatavisadocument';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($TourFolder) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $TourFolder['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $TourFolder['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function visaDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function visaDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function visaPopupVisadocument(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->visadocument_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->visadocument_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'visadocument-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'visadocument_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
