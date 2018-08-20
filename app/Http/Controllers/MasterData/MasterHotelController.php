<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Hotel\MasterHotelContact;
use App\Models\MasterData\Hotel\MasterHotelService;

use App\Models\MasterData\Hotel\MasterHotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\MasterHotelDataTable;
use App\Http\Requests\MasterData\MasterHotelRequest;
use App\Models\MasterData\Country;
use App\Models\MasterData\Hotel\HotelChain;
use App\Models\MasterData\Currency\Currency;
use App\Models\Temporary;

class MasterHotelController extends Controller
{
    public function __construct()
    {
        // middleware

        $this->middleware('sentinel_access:admin.company,master-hotel.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,master-hotel.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,master-hotel.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,master-hotel.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MasterHotelDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.master_hotel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();
        $hotelchain = HotelChain::getAvailableData()->pluck('master_hotel_chain.name', 'master_hotel_chain.id')->all();
        $countries = Country::getAvailableData()->pluck('country_name', 'countries.id')->all();
        $cities = ['' => '- Not Available -'];
        return view('contents.master_datas.master_hotel.create', compact('cities', 'countries', 'hotelchain', 'currencys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\MasterHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterHotelRequest $request)
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
            $insert = MasterHotel::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('master-hotel.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('master-hotel.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('master-hotel.create');
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
     * @param  \App\Models\MasterData\MasterHotel  $MasterHotel
     * @return \Illuminate\Http\Response
     */
    public function show(MasterHotel $masterhotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\MasterHotel  $MasterHotel
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterHotel $MasterHotel)
    {
        $parent = $MasterHotel->toArray();
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        foreach ($MasterHotel->hotelContact as $valueHotelContact) {
            $data = [
                'title' => $valueHotelContact->title,
                'name' => $valueHotelContact->name,
                'phone' => $valueHotelContact->phone,
                'fax' => $valueHotelContact->fax,
                'email' => $valueHotelContact->email
            ];

            Temporary::create([
                'type' => 'hotel-contact-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $listhotelproperty = $MasterHotel->hotelProperty;
        
        // $listhotelproperty->room_capacity = $listhotelproperty->room_capacity;
        // $listhotelproperty->address_crpd = $listhotelproperty->address;
        // $listhotelproperty->remark_crpd = $listhotelproperty->remark;
        // $listhotelproperty->swift_crpd = $listhotelproperty->swift;
        $listhotelproperty = $listhotelproperty->toArray();

        foreach ($MasterHotel->hotelService as $valueHotelService) {
            $data = [
                'service_name' => $valueHotelService->service_name,
                'service_desciption' => $valueHotelService->service_desciption,
                'cost' => $valueHotelService->cost,
                'sales' => $valueHotelService->sales,
                'start_date' => $valueHotelService->start_date,
                'end_date' => $valueHotelService->end_date,
                'season' => $valueHotelService->season,
                'is_free' => $valueHotelService->is_free
            ];

            Temporary::create([
                'type' => 'hotel-service-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        unset($listhotelproperty['id']);
        $arrayMerge = array_merge($parent, $listhotelproperty);
        
        $masterhotel = (object) $arrayMerge;
        // dd($masterhotel);

        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();
        $hotelchain = HotelChain::getAvailableData()->pluck('master_hotel_chain.name', 'master_hotel_chain.id')->all();
        $countries = Country::getAvailableData()->pluck('country_name', 'countries.id')->all();
        $cities = ['' => '- Not Available -'];
        return view('contents.master_datas.master_hotel.edit', compact('masterhotel', 'currencys', 'hotelchain', 'countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\MasterHotelRequest  $request
     * @param  \App\Models\MasterData\MasterHotel  $MasterHotel
     * @return \Illuminate\Http\Response
     */
    public function update(MasterHotelRequest $request, MasterHotel $masterhotel)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('master-hotel.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('master-hotel.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('master-hotel.edit', $masterhotel->id);
            }

            $update = $masterhotel->update($request->all());

            if ($update) {
                $input = $request->all();
                $input['id_hotel'] = $masterhotel->id;

                $hotelContact =  $masterhotel->hotelContact;
                foreach ($hotelContact as $value) {
                    $value->delete();
                }

                $hotelcontact = \DB::table('temporaries')->whereType('hotel-contact-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($hotelcontact) > 0) {
                    foreach ($hotelcontact as $hotelcontactvalue) {
                        $hotelcontactData = json_decode($hotelcontactvalue->data);

                        $hc = new MasterHotelContact;

                        $hc->id_hotel = $masterhotel->id;
                        $hc->title = $hotelcontactData->title;
                        $hc->name = $hotelcontactData->name;
                        $hc->phone = $hotelcontactData->phone;
                        $hc->fax = $hotelcontactData->fax;
                        $hc->email = $hotelcontactData->email;

                        $hc->save();
                    }
                }

                $hotelService =  $masterhotel->hotelService;
                foreach ($hotelService as $value) {
                    $value->delete();
                }

                $hotelservice = \DB::table('temporaries')->whereType('hotel-service-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($hotelservice) > 0) {
                    foreach ($hotelservice as $hotelservicevalue) {
                        $hotelserviceData = json_decode($hotelservicevalue->data);

                        $hs = new MasterHotelService;

                        $hs->id_hotel = $masterhotel->id;
                        $hs->service_name = $hotelserviceData->service_name;
                        $hs->service_desciption = $hotelserviceData->service_desciption;
                        $hs->cost = $hotelserviceData->cost;
                        $hs->sales = $hotelserviceData->sales;
                        $hs->start_date = $hotelserviceData->start_date;
                        $hs->end_date = $hotelserviceData->end_date;
                        $hs->season = $hotelserviceData->season;
                        $hs->is_free = $hotelserviceData->is_free;

                        $hs->save();
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
     * @param  \App\Models\MasterData\MasterHotel  $MasterHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterHotel $masterhotel)
    {
        $masterhotel->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('master-hotel.index');
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
            MasterHotel::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('master-hotel.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = MasterHotel::select('*')->get();
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
        $types = MasterHotel::all();
        $pdf = \PDF::loadView('contents.master_datas.master_hotel.pdf', compact('types'));
        return $pdf->download('master-hotel.pdf');
    }

    public function searchData(Request $request)
    {
        $results = MasterHotel::getAvailableData()
            ->select('master_hotel.id', 'master_hotel.name as text')
            ->where('master_hotel.name', 'ilike', '%'.$request->search.'%')
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
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

        if ($request->type == 'hotel-contact-detail') {
            $classEdit = 'editDataHotelContact';
            $classDelete = 'deleteDataHotelContact';
        } else if ($request->type == 'hotel-service-detail') {
            $classEdit = 'editDataHotelService';
            $classDelete = 'deleteDataHotelService';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($inventory) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $inventory['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $inventory['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function masterhotelDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function masterhotelDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function masterhotelDetailHotelContact(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->hotel_contact_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->hotel_contact_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'hotel-contact-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'hotel_contact_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function masterhotelDetailHotelService(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->hotel_service_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->hotel_service_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'hotel-service-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'hotel_service_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
