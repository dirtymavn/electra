<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Hotel\MasterHotelAllotmentDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\HotelAllotmentDataTable;
use App\Http\Requests\MasterData\HotelAllotmentRequest;
use App\Models\MasterData\Country;
use App\Models\MasterData\Hotel\HotelChain;
use App\Models\MasterData\Hotel\MasterHotel;
use App\Models\MasterData\Hotel\HotelAllotment;
use App\Models\Temporary;

use DB;
use Excel;
use PDF;

class HotelAllotmentController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,hotel-allotment.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,hotel-allotment.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,hotel-allotment.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,hotel-allotment.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HotelAllotmentDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.hotel_allotment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $listmasterhotel = MasterHotel::getAvailableData()->pluck('master_hotel.name', 'master_hotel.id')->all();
        return view('contents.master_datas.hotel_allotment.create', compact('listmasterhotel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\HotelAllotmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelAllotmentRequest $request)
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
            $insert = HotelAllotment::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('hotel-allotment.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('hotel-allotment.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('hotel-allotment.create');
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
     * @param  \App\Models\MasterData\HotelAllotment  $HotelAllotment
     * @return \Illuminate\Http\Response
     */
    public function show(HotelAllotment $hotelallotment)
    {
        //
    }

    
    public function edit(HotelAllotment $HotelAllotment)
    {
        
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $parent = $HotelAllotment->toArray();

        foreach ($HotelAllotment->hotelAllotmentDetail as $valueHotelAllotmentDetail) {
            $data = [
                'date' => $valueHotelAllotmentDetail->date,
                'available_room_smooking' => $valueHotelAllotmentDetail->available_room_smooking,
                'available_room_non_smooking' => $valueHotelAllotmentDetail->available_room_non_smooking
            ];

            Temporary::create([
                'type' => 'hotel-allotmentdetail-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
        
        $arrayMerge = array_merge($parent);
        
        $hotelallotment = (object) $arrayMerge;
        
        $listmasterhotel = MasterHotel::getAvailableData()->pluck('master_hotel.name', 'master_hotel.id')->all();
        return view('contents.master_datas.hotel_allotment.edit', with(['hotelallotment' => $HotelAllotment, 'listmasterhotel' => $listmasterhotel]));

        // return view('contents.master_datas.hotel_allotment.edit', compact('hotelallotment', 'listmasterhotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\HotelAllotmentRequest  $request
     * @param  \App\Models\MasterData\HotelAllotment  $HotelAllotment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelAllotment $HotelAllotment)
    {
        
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('hotel-allotment.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('hotel-allotment.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('hotel-allotment.edit', $HotelAllotment->id);
            }

            $update = $HotelAllotment->update($request->all());

            if ($update) {
                $input = $request->all();
                $input['id_hotel_allotment'] = $HotelAllotment->id;

                $routeallotdetail =  $HotelAllotment->hotelAllotmentDetail;
                foreach ($routeallotdetail as $value) {
                    $value->delete();
                }

                $hotelallotmentdetail = \DB::table('temporaries')->whereType('hotel-allotmentdetail-detail')
                ->whereUserId(user_info('id'))
                    ->get();
                if (count($hotelallotmentdetail) > 0) {
                    foreach ($hotelallotmentdetail as $hotelallotmentdetailvalue) {
                        $hotelallotmentdetailData = json_decode($hotelallotmentdetailvalue->data);

                        $had = new MasterHotelAllotmentDetail;
                        $had->id_hotel_allotment = $HotelAllotment->id;
                        $had->date = $hotelallotmentdetailData->date;
                        $had->available_room_smooking = $hotelallotmentdetailData->available_room_smooking;
                        $had->available_room_non_smooking = $hotelallotmentdetailData->available_room_non_smooking;
                        $had->company_id = user_info('company_id');
                        
                        $had->save();
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
     * @param  \App\Models\MasterData\HotelAllotment  $HotelAllotment
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelAllotment $HotelAllotment)
    {
        $HotelAllotment->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('hotel-allotment.index');
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
            HotelAllotment::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('hotel-allotment.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = HotelAllotment::select('*')->get();
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
        $types = HotelAllotment::all();
        $pdf = \PDF::loadView('contents.master_datas.hotel_allotment.pdf', compact('types'));
        return $pdf->download('hotel-allotment.pdf');
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

        if ($request->type == 'hotel-allotmentdetail-detail') {
            $classEdit = 'editDataHotelAllotmentDetail';
            $classDelete = 'deleteDataHotelAllotmentDetail';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($inventory) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $inventory['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $inventory['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function hotelallotmentDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function hotelallotmentDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function hotelallotmantDetailHotelAllotmentdetail(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->hotel_allotmentdetail_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->hotel_allotmentdetail_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'hotel-allotmentdetail-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'hotel_allotmentdetail_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
