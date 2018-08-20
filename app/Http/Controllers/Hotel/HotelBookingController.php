<?php

namespace App\Http\Controllers\Hotel;

use App\Models\Hotel\HotelBooking;
use App\Models\Hotel\HotelBookingDetail;
use App\Models\Hotel\HotelBookingPax;
use App\Models\Hotel\HotelBookingService;
use App\Models\MasterData\Hotel\MasterHotel;
use App\Models\MasterData\Hotel\MasterHotelService;
use App\Models\MasterData\Country;
use App\Models\Outbound\TrxTourOrder\TourOrder;
use App\Models\MasterData\Customer\MasterCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Hotel\HotelBookingDataTable;
use App\Http\Requests\Hotel\HotelBookingRequest;
use App\Models\Temporary;

class HotelBookingController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,hotel-booking.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,hotel-booking.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,hotel-booking.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,hotel-booking.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HotelBookingDataTable $dataTable)
    {
        return $dataTable->render('contents.hotels.hotel_booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $newCode = '';
        $datahotel = MasterHotel::getAvailableData()->pluck('master_hotel.name', 'master_hotel.id')->all();
        $datacustomer = MasterCustomer::getAvailableData()->pluck('master_customers.customer_name', 'master_customers.id')
            ->all();
        $datahotelservice = MasterHotelService::getAvailableData()->pluck('master_hotel_service.service_name', 'master_hotel_service.id')->all();
        $dataroomtype = TourOrder::roomTypes();
        $dataroomcategory = TourOrder::roomCategories();
        $countries = Country::getDataByCompany()->pluck('country_name', 'id')->all();


        return view('contents.hotels.hotel_booking.create', compact('newCode', 'datahotel', 'datacustomer', 'dataroomtype', 'dataroomcategory', 'countries', 'datahotelservice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Hotel\HotelBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelBookingRequest $request)
    {
        \DB::beginTransaction();
        try {
            $newCode = HotelBooking::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'booking_number' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'booking_number' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
            $insert = HotelBooking::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('hotel-booking.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('hotel-booking.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('hotel-booking.create');
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
     * @param  \App\Models\Hotel\HotelBooking  $HotelBooking
     * @return \Illuminate\Http\Response
     */
    public function show(HotelBooking $HotelBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel\HotelBooking  $HotelBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelBooking $HotelBooking)
    {

        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $parent = $HotelBooking->toArray();
        
        $bookingRemark = $HotelBooking->hotelbookingRemark->toArray();
        unset($bookingRemark['id']);


        foreach ($HotelBooking->hotelbookingDetail as $key => $value) {
            $data = [
                'id_hotel_booking' => $HotelBooking->id,
                'id_room_type' => $value->id_room_type,
                'id_room_category' => $value->id_room_category,
                'room_number' => $value->room_number,
                'night' => $value->night,
                'price_per_night' => $value->price_per_night,
                'include_breakfast' => $value->include_breakfast,
                'non_smooking' => $value->non_smooking,
                'high_floor' => $value->high_floor
            ];
            Temporary::create([
                'type' => 'hotelbookingdetail-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }


        foreach ($HotelBooking->hotelbookingPax as $key => $value) {
            $data = [
                'id_hotel_booking' => $HotelBooking->id,
                'title' => $value->title, 
                'pax_name' => $value->pax_name, 
                'type' => $value->type, 
                'id_nationality' => $value->id_nationality
            ];
            Temporary::create([
                'type' => 'hotelbookingpax-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }


        foreach ($HotelBooking->hotelbookingService as $key => $value) {
            $data = [
                'id_hotel_booking' => $HotelBooking->id,
                'id_hotel_service' => $value->id_hotel_service,
                'service_code' => $value->service_code,
                'service_description' => $value->service_description,
                'quantity' => $value->quantity,
                'quantity_order' => $value->quantity_order,
                'order_date' => $value->order_date,
                'total_sales' => $value->total_sales
            ];
            Temporary::create([
                'type' => 'hotelbookingservice-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
        
        
        $arrayMerge = array_merge($parent,$bookingRemark);
        
        $HotelBooking = (object)$arrayMerge;

        $newCode = '';
        $datahotel = MasterHotel::getAvailableData()->pluck('master_hotel.name', 'master_hotel.id')->all();
        $datacustomer = MasterCustomer::getAvailableData()->pluck('master_customers.customer_name', 'master_customers.id')
            ->all();
        $dataroomtype = TourOrder::roomTypes();
        $dataroomcategory = TourOrder::roomCategories();
        $countries = Country::getDataByCompany()->pluck('country_name', 'id')->all();
        $datahotelservice = MasterHotelService::getAvailableData()->pluck('master_hotel_service.service_name', 'master_hotel_service.id')->all();

        return view('contents.hotels.hotel_booking.edit', compact('HotelBooking', 'newCode', 'datahotel', 'datacustomer', 'dataroomtype', 'dataroomcategory', 'countries', 'datahotelservice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Hotel\HotelBookingRequest  $request
     * @param  \App\Models\Hotel\HotelBooking  $hotelbooking
     * @return \Illuminate\Http\Response
     */
    public function update(HotelBookingRequest $request, HotelBooking $HotelBooking)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('hotel-booking.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('hotel-booking.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('hotel-booking.edit', $HotelBooking->id);
            }

            $update = $HotelBooking->update($request->all());

            if ($update) {

                $input = $request->all();
                $input['id_hotel_booking'] = $HotelBooking->id;

                $databookingremark = $HotelBooking->hotelbookingRemark;
                $databookingremark->update($input);


                $datahotelbooking =  $HotelBooking->hotelbookingDetail;
                foreach ($datahotelbooking as $value) {
                    $value->delete();
                }
                $Hotelbookingdetail = \DB::table('temporaries')->whereType('hotelbookingdetail-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Hotelbookingdetail) > 0) {
                    foreach ($Hotelbookingdetail as $Hotelbookingdetailvalue) {
                        $bookingdetailData = json_decode($Hotelbookingdetailvalue->data);

                        $bookdetail = new HotelBookingDetail;
                        $bookdetail->id_hotel_booking = $HotelBooking->id;
                        $bookdetail->id_room_type = $bookingdetailData->id_room_type;
                        $bookdetail->id_room_category = $bookingdetailData->id_room_category;
                        $bookdetail->room_number = $bookingdetailData->room_number;
                        $bookdetail->night = $bookingdetailData->night;
                        $bookdetail->price_per_night = $bookingdetailData->price_per_night;
                        $bookdetail->include_breakfast = $bookingdetailData->include_breakfast;
                        $bookdetail->non_smooking = $bookingdetailData->non_smooking;
                        $bookdetail->high_floor = $bookingdetailData->high_floor;
                        $bookdetail->company_id = user_info('company_id');
                        $bookdetail->save();
                    }
                }

                $datahotelpax =  $HotelBooking->hotelbookingPax;
                foreach ($datahotelpax as $value) {
                    $value->delete();
                }
                $Hotelbookingpax = \DB::table('temporaries')->whereType('hotelbookingpax-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Hotelbookingpax) > 0) {
                    foreach ($Hotelbookingpax as $Hotelbookingpaxvalue) {
                        $bookingpaxData = json_decode($Hotelbookingpaxvalue->data);

                        $bookpax = new HotelBookingPax;
                        $bookpax->id_hotel_booking = $HotelBooking->id;
                        $bookpax->title = $bookingpaxData->title;
                        $bookpax->pax_name = $bookingpaxData->pax_name;
                        $bookpax->type = $bookingpaxData->type;
                        $bookpax->id_nationality = $bookingpaxData->id_nationality;
                        $bookpax->company_id = user_info('company_id');
                        $bookpax->save();

                    }
                }

                $datahotelservice =  $HotelBooking->hotelbookingService;
                foreach ($datahotelservice as $value) {
                    $value->delete();
                }
                $Hotelbookingservice = \DB::table('temporaries')->whereType('hotelbookingservice-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Hotelbookingservice) > 0) {
                    foreach ($Hotelbookingservice as $Hotelbookingservicevalue) {
                        $bookingserviceData = json_decode($Hotelbookingservicevalue->data);

                        $bookservice = new HotelBookingService;
                        $bookservice->id_hotel_booking = $HotelBooking->id;
                        $bookservice->id_hotel_service = $bookingserviceData->id_hotel_service;
                        $bookservice->service_code = $bookingserviceData->service_code;
                        $bookservice->service_description = $bookingserviceData->service_description;
                        $bookservice->quantity = $bookingserviceData->quantity;
                        $bookservice->quantity_order = $bookingserviceData->quantity_order;
                        $bookservice->order_date = $bookingserviceData->order_date;
                        $bookservice->total_sales = $bookingserviceData->total_sales;
                        $bookservice->company_id = user_info('company_id');
                        $bookservice->save();

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
     * @param  \App\Models\Hotel\HotelBooking  $HotelBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelBooking $HotelBooking)
    {
        $HotelBooking->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('hotel-booking.index');
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
            HotelBooking::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('hotel-booking.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = HotelBooking::select('*')->get();
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
        $types = HotelBooking::all();
        $pdf = \PDF::loadView('contents.hotels.hotel_booking.pdf', compact('types'));
        return $pdf->download('hotel-booking.pdf');
    }

    public function searchData(Request $request)
    {
        $results = HotelBooking::getAvailableData()
            ->select('trx_hotel_booking.id', 'trx_hotel_booking.tour_code as text')
            ->where('trx_hotel_booking.tour_code', 'ilike', '%'.$request->search.'%')
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
        
        if ($request->type == 'hotelbookingdetail-detail') {
            $classEdit = 'editdatahotelbookingdetail';
            $classDelete = 'deletedatahotelbookingdetail';
        }else if($request->type == 'hotelbookingpax-detail'){
            $classEdit = 'editdatahotelbookingpax';
            $classDelete = 'deletedatahotelbookingpax';
        }else if($request->type == 'hotelbookingservice-detail'){
            $classEdit = 'editdatahotelbookingservice';
            $classDelete = 'deletedatahotelbookingservice';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($TourFolder) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $TourFolder['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $TourFolder['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function hotelbookingDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function hotelbookingDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function hotelbookingPopupHotelbookingdetail(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->hotelbookingdetail_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->hotelbookingdetail_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'hotelbookingdetail-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'hotelbookingdetail_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function hotelbookingPopupHotelbookingpax(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->hotelbookingpax_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->hotelbookingpax_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'hotelbookingpax-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'hotelbookingpax_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function hotelbookingPopupHotelbookingservice(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->hotelbookingservice_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->hotelbookingservice_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'hotelbookingservice-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'hotelbookingservice_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
