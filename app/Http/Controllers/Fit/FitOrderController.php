<?php

namespace App\Http\Controllers\Fit;

use App\Models\Fit\TrxFitOrder\FitOrder;
use App\Models\Fit\TrxFitOrder\FitOrderPaxList;
use App\Models\Fit\TrxFitOrder\FitOrderPaxListTour;
use App\Models\Fit\TrxFitOrder\FitOrderPaxListTourAccomodation;
use App\Models\Fit\TrxFitOrder\FitOrderPaxListTourSelling;
use App\Models\Fit\TrxFitOrder\FitOrderPaxListTourFlight;
use App\Models\Fit\TrxFitOrder\FitOrderTour;

use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\MasterData\Airline;
use App\Models\MasterData\Tour;
use App\Models\Temporary;
use App\Models\MasterData\Currency\Currency;
use App\Models\MasterData\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Fit\FitOrderDataTable;
use App\Http\Requests\Outbound\PaxListTourRequest;

class FitOrderController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,fitorder.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,fitorder.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,fitorder.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,fitorder.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FitOrderDataTable $dataTable)
    {
        return $dataTable->render('contents.fits.tour_order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->error) {

            \DB::table('temporaries')
                ->whereUserId(user_info('id'))
                ->delete();
        }

        $customers = MasterCustomer::getAvailableData()->pluck('master_customers.customer_name', 'master_customers.id')
            ->all();
        $tours = Tour::getAvailableData()->pluck('master_tours.tour_name', 'master_tours.id')
            ->all();
        $airlines = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')
            ->all();
        $meals = MasterCustomer::meals();
        $roomTypes = FitOrder::roomTypes();
        $roomCategories = FitOrder::roomCategories();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();
        $cities = City::getAvailableData()
            ->select(\DB::raw("(cities.id ||'/'|| countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as slug"), 
                \DB::raw("(countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as text"))
            ->pluck('text', 'slug')->all();

        $newCode = '';
        // if (count($customers) == 0) {
        //     $customers = ['' => '- Not Available -'];
        // }

        // if (count($tours) == 0) {
        //     $tours = ['' => '- Not Available -'];
        // }

        // if (count($airlines) == 0) {
        //     $airlines = ['' => '- Not Available -'];
        // }

        return view('contents.fits.tour_order.create', compact('customers', 'tours', 'airlines', 'meals', 'roomTypes', 'roomCategories', 'currencys', 'cities', 'newCode'));
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
            $newCode = FitOrder::getAutoNumber();
            $request->merge([ 'company_id' =>  @user_info()->company->id ]);
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'order_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'order_no' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $insert = FitOrder::create($request->all());
            
            if ($insert) {
                $redirect = redirect()->route('fitorder.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('fitorder.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('fitorder.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            \DB::rollback();
            $url = route('fitorder.create').'?error=y';
            return redirect()->to($url)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outbound\TrxTourOrder\FitOrder  $tourOrder
     * @return \Illuminate\Http\Response
     */
    public function show(FitOrder $fitOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outbound\TrxfitOrder\FitOrder  $fitOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(FitOrder $fitOrder, Request $request, $id)
    {
        if (!$request->error) {
            \DB::table('temporaries')
                ->whereUserId(user_info('id'))
                ->delete();
        }

        $customers = MasterCustomer::getAvailableData()->pluck('master_customers.customer_name', 'master_customers.id')
            ->all();
        $tours = Tour::getAvailableData()->pluck('master_tours.tour_name', 'master_tours.id')
            ->all();
        $airlines = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')
            ->all();
        $meals = MasterCustomer::meals();
        $roomTypes = FitOrder::roomTypes();
        $roomCategories = FitOrder::roomCategories();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();
        $cities = City::getAvailableData()
            ->select(\DB::raw("(cities.id ||'/'|| countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as slug"), 
                \DB::raw("(countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as text"))
            ->pluck('text', 'slug')->all();
        // if (count($customers) == 0) {
        //     $customers = ['' => '- Not Available -'];
        // }

        // if (count($tours) == 0) {
        //     $tours = ['' => '- Not Available -'];
        // }

        // if (count($airlines) == 0) {
        //     $airlines = ['' => '- Not Available -'];
        // }

        
        $fitOrder = FitOrder::find($id);
        $fitOrder->master_tour_id = $fitOrder->tour->master_tour_id;
        $fitOrder->days = $fitOrder->tour->days;
        $newCode = $fitOrder->order_no;

        foreach ($fitOrder->paxLists as $key => $value) {
            $data = [
                'customer_id' => $value->customer_id,
                'vip_status_flag' => ($value->vip_status_flag) ? 1 : 0,
                'surname' => $value->surname,
                'given_name' => $value->given_name,
                'ptc' => $value->ptc,
                'title' => $value->title,
                'gender' => $value->gender,
                'id_no' => $value->id_no,
                'dob' => $value->dob,

                'return_date' => $value->paxListTour->return_date,
                'deviation' => $value->paxListTour->deviation,
                'meal' => $value->paxListTour->meal,
                'remark' => $value->paxListTour->remark,
                'special_req' => $value->paxListTour->special_req,

                'room_type' => $value->paxListTour->paxListTourAccomodation->room_type,
                'room_category' => $value->paxListTour->paxListTourAccomodation->room_category,
                'room_share' => $value->paxListTour->paxListTourAccomodation->room_share,
                'room_id' => $value->paxListTour->paxListTourAccomodation->room_id,
                'adjoin_room_id' => $value->paxListTour->paxListTourAccomodation->adjoin_room_id,

                'price_type' => $value->paxListTour->paxListTourSelling->price_type,
                'less_total_disc' => $value->paxListTour->paxListTourSelling->less_total_disc,
                'room_surcharge' => $value->paxListTour->paxListTourSelling->room_surcharge,
                'tax' => $value->paxListTour->paxListTourSelling->tax,
                'rebate' => $value->paxListTour->paxListTourSelling->rebate,
                'comm' => $value->paxListTour->paxListTourSelling->comm,
                'gst' => $value->paxListTour->paxListTourSelling->gst,
                'airline_id' => $value->paxListTour->paxListTourSelling->airline_id,
                'ticket_no' => $value->paxListTour->paxListTourSelling->ticket_no,
                'register_date' => $value->paxListTour->paxListTourSelling->register_date,
                'currency' => $value->paxListTour->paxListTourSelling->currency,
                'selling_special_req' => $value->paxListTour->paxListTourSelling->special_req,
                'selling_remark' => $value->paxListTour->paxListTourSelling->remark,
            ];

            $tempService = Temporary::create([
                    'type' => 'tour-paxlist',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data)
                ]);

            foreach ($value->paxListTour->paxListTourFlights as $flight) {
                $data = [
                    'flight_from' => $flight->flight_from,
                    'flight_from_name' => (@$flight->flight_from) ? $flight->cityFrom->country->country_name.'-'.$flight->cityFrom->city_name.'-'.$flight->cityFrom->city_code : '',
                    'flight_from_ori' => (@$flight->flight_from) ? $flight->flight_from.'/'.$flight->cityFrom->country->country_name.'-'.$flight->cityFrom->city_name.'-'.$flight->cityFrom->city_code : '',
                    'flight_to' => $flight->flight_to,
                    'flight_to_name' => (@$flight->flight_to) ? $flight->cityTo->country->country_name.'-'.$flight->cityTo->city_name.'-'.$flight->cityTo->city_code : '',
                    'flight_to_ori' => (@$flight->flight_to) ? $flight->flight_to.'/'.$flight->cityTo->country->country_name.'-'.$flight->cityTo->city_name.'-'.$flight->cityTo->city_code : '',
                    'flight_airline_id' => $flight->airline_id,
                    'flight_airline_name' => (@$flight->airline_id) ? Airline::find($flight->airline_id)->airline_name : '',
                    'flight_no' => $flight->flight_no,
                    'class' => $flight->class,
                    'farebasis' => $flight->farebasis,
                    'depart_date' => date('Y-m-d', strtotime($flight->depart_date)).'T'.date('H:i', strtotime($flight->depart_date)),
                    'arrived_date' => date('Y-m-d', strtotime($flight->arrived_date)).'T'.date('H:i', strtotime($flight->arrived_date)),
                    'status' => $flight->status,
                ];

                Temporary::create([
                    'type' => 'tour-paxlist-flight',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data),
                    'parent_id' => $tempService->id
                ]);
            }
        }

        return view('contents.fits.tour_order.edit', compact('customers', 'tours', 'airlines', 'meals', 'roomTypes', 'roomCategories', 'currencys', 'cities', 'fitOrder', 'newCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outbound\TrxfitOrder\fitOrder  $fitOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FitOrder $fitOrder, $id)
    {
        $fitOrder = FitOrder::find($id);

        \DB::beginTransaction();
        try {
            $newCode = FitOrder::getAutoNumber();
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false, 'order_no' => $newCode]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('fitorder.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'order_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('fitorder.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('fitorder.edit', $fitOrder->id);
            }

            $update = $fitOrder->update($request->all());

            if ($update) {

                $tour = Tour::find($request->master_tour_id);

                if ($tour) {
                    $fitOrder->tour->delete();
                    $fitOrderTour = new FitOrderTour;
                    $fitOrderTour->master_tour_id = $tour->id;
                    $fitOrderTour->trx_fit_order_id = $fitOrder->id;
                    $fitOrderTour->tour_name = $tour->tour_name;
                    $fitOrderTour->tour_code = $tour->tour_code;
                    $fitOrderTour->depart_date = $tour->depart_date;
                    $fitOrderTour->return_date = $tour->return_date;
                    $fitOrderTour->days = $request->days;
                    $fitOrderTour->source_type = $tour->source_type;
                    $fitOrderTour->tour_category = $tour->tour_category;
                    $fitOrderTour->pax_no = $tour->pax_no;
                    $fitOrderTour->adult = $tour->adult;
                    $fitOrderTour->child = $tour->child;
                    $fitOrderTour->infant = $tour->infant;
                    $fitOrderTour->senior = $tour->senior;
                    $fitOrderTour->ticket_only = $tour->ticket_only;
                    $fitOrderTour->tour_type = $tour->tour_type;
                    $fitOrderTour->save();
                }
                
                $paxLists =  $fitOrder->paxLists;
                foreach ($paxLists as $value) {
                    $value->delete();
                }

                $tourPaxlists = \DB::table('temporaries')->whereType('tour-paxlist')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($tourPaxlists) > 0) {
                    foreach ($tourPaxlists as $tourPaxlist) {
                        $tourPaxlistData = json_decode($tourPaxlist->data);

                        $paxlist = new FitOrderPaxList;
                        $paxlist->trx_fit_order_id = $fitOrder->id;
                        $paxlist->customer_id = $tourPaxlistData->customer_id;
                        $paxlist->vip_status_flag = $tourPaxlistData->vip_status_flag;
                        $paxlist->surname = $tourPaxlistData->surname;
                        $paxlist->given_name = $tourPaxlistData->given_name;
                        $paxlist->ptc = $tourPaxlistData->ptc;
                        $paxlist->title = $tourPaxlistData->title;
                        $paxlist->gender = $tourPaxlistData->gender;
                        $paxlist->id_no = $tourPaxlistData->id_no;
                        $paxlist->dob = $tourPaxlistData->dob;
                        $paxlist->save();

                        $paxlistTour = new FitOrderPaxListTour;
                        $paxlistTour->trx_fit_order_pax_list_id = $paxlist->id;
                        $paxlistTour->return_date = $tourPaxlistData->return_date;
                        $paxlistTour->deviation = $tourPaxlistData->deviation;
                        $paxlistTour->meal = $tourPaxlistData->meal;
                        $paxlistTour->remark = $tourPaxlistData->remark;
                        $paxlistTour->special_req = $tourPaxlistData->special_req;
                        $paxlistTour->save();

                        $accomodation = new FitOrderPaxListTourAccomodation;
                        $accomodation->trx_fit_order_pax_list_tour_id = $paxlistTour->id;
                        $accomodation->room_type = $tourPaxlistData->room_type;
                        $accomodation->room_category = $tourPaxlistData->room_category;
                        $accomodation->room_share = $tourPaxlistData->room_share;
                        $accomodation->room_id = $tourPaxlistData->room_id;
                        $accomodation->adjoin_room_id = $tourPaxlistData->adjoin_room_id;
                        $accomodation->save();

                        $selling = new FitOrderPaxListTourSelling;
                        $selling->trx_fit_order_pax_list_tour_id = $paxlistTour->id;
                        $selling->price_type = $tourPaxlistData->price_type;
                        $selling->less_total_disc = $tourPaxlistData->less_total_disc;
                        $selling->room_surcharge = $tourPaxlistData->room_surcharge;
                        $selling->tax = $tourPaxlistData->tax;
                        $selling->rebate = $tourPaxlistData->rebate;
                        $selling->comm = $tourPaxlistData->comm;
                        $selling->gst = $tourPaxlistData->gst;
                        $selling->airline_id = $tourPaxlistData->airline_id;
                        $selling->ticket_no = $tourPaxlistData->ticket_no;
                        $selling->register_date = $tourPaxlistData->register_date;
                        $selling->currency = $tourPaxlistData->currency;
                        $selling->special_req = $tourPaxlistData->selling_special_req;
                        $selling->remark = $tourPaxlistData->selling_remark;
                        $selling->save();


                        $tourPaxlistTourFlights = \DB::table('temporaries')->whereType('tour-paxlist-flight')
                            ->whereParentId($tourPaxlist->id)
                            ->whereUserId(user_info('id'))
                            ->get();
                        if (count($tourPaxlistTourFlights) > 0) {
                            foreach ($tourPaxlistTourFlights as $tourPaxlistTourFlight) {
                                $tourPaxlistTourFlight = json_decode($tourPaxlistTourFlight->data);
                                $flight = new FitOrderPaxListTourFlight;
                                $flight->trx_fit_order_pax_list_tour_id = $paxlistTour->id;
                                $flight->flight_from = $tourPaxlistTourFlight->flight_from;
                                $flight->flight_to = $tourPaxlistTourFlight->flight_to;
                                $flight->airline_id = $tourPaxlistTourFlight->flight_airline_id;
                                $flight->flight_no = $tourPaxlistTourFlight->flight_no;
                                $flight->class = $tourPaxlistTourFlight->class;
                                $flight->farebasis = $tourPaxlistTourFlight->farebasis;
                                $flight->depart_date = date('Y-m-d H:i:s', strtotime($tourPaxlistTourFlight->depart_date));
                                $flight->arrived_date = date('Y-m-d H:i:s', strtotime($tourPaxlistTourFlight->arrived_date));
                                $flight->status = $tourPaxlistTourFlight->status;
                                $flight->save();
                            }
                        }
                    }
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            $url = route('fitorder.edit', $fitOrder->id).'?error=y';
            return redirect()->to($url)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outbound\TrxTourOrder\TourOrder  $tourOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(FitOrder $fitOrder, $id)
    {
        $fitOrder = FitOrder::find($id);

        if ($fitOrder) {
            $fitOrder->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.not_found'));
        }

        return redirect()->back();
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
            TourOrder::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('fitorder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $datas = [];
        if (!empty(@$request->parent_id)) {
            $results = \DB::table('temporaries')->whereType($request->type)
                ->whereUserId(user_info('id'))
                ->whereParentId($request->parent_id)
                ->select('id','data')
                ->get();   
        
        } else {
            $results = \DB::table('temporaries')->whereType($request->type)
                ->whereUserId(user_info('id'))
                ->select('id','data')
                ->get();
        }
            
        if (count($results) > 0) {
            foreach ($results as $result) {
                $value = collect(json_decode($result->data))->toArray();
                
                $value['id'] = $result->id;

                array_push($datas, $value);
            }
        }

        $datas = collect($datas);

        if ($request->type == 'tour-paxlist') {
            return datatables()->of($datas)
                ->addColumn('action', function ($tourOrder) use($request) {
                    return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="paxlist" data-id="' . $tourOrder['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                            <a href="javascript:void(0)" class="danger deleteData" data-element="paxlist" title="Delete" data-id="' . $tourOrder['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->editColumn('vip_status_flag', function ($tourOrder) use($request) {
                    return ($tourOrder['vip_status_flag']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
                })
                ->rawColumns(['vip_status_flag', 'action'])
                ->make(true);
        } else {
            return datatables()->of($datas)
                ->addColumn('action', function ($tourOrder) use($request) {
                    return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="paxlist-flight" data-id="' . $tourOrder['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                            <a href="javascript:void(0)" class="danger deleteData" data-element="paxlist-flight" title="Delete" data-id="' . $tourOrder['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->editColumn('status', function ($tourOrder) use($request) {
                    return ($tourOrder['status'] == 1) ? 'Yes' : 'No';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \App\Http\Requests\Outbound\PaxListTourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function tourOrderPaxlistStore(PaxListTourRequest $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->tour_paxlist_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->tour_paxlist_id)->delete();
            }
            $temp = Temporary::create([
                'type' => 'tour-paxlist',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'tour_paxlist_id']))
            ]);

            $flights = Temporary::where('type', 'tour-paxlist-flight')
                ->whereParentId($request->tour_paxlist_id)
                ->whereUserId(user_info('id'))
                ->get();
            if (count($flights) > 0) {
                foreach ($flights as $flight) {

                    $flight->update([
                        'parent_id' => $temp->id
                    ]);
                }
            }

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Delete resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete(); 
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    /**
     * Get detail resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    /**
     * Store a newly created tour flight resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tourOrderPaxlistFlightStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            $parent_id = $request->tour_paxlist_flight_id;
            $request->merge(['flight_from_ori' => $request->flight_from, 'flight_to_ori' => $request->flight_to]);
            $flightFrom = explode('/', $request->flight_from);
            $flightTo = explode('/', $request->flight_to);
            $request->merge([
                'flight_from' => @$flightFrom[0],
                'flight_from_name' => @$flightFrom[1],
                'flight_to' => @$flightTo[0],
                'flight_to_name' => @$flightTo[1],
                'flight_airline_name' => (@$request->flight_airline_id) ? Airline::find($request->flight_airline_id)->airline_name : ''
            ]);
            if (@$request->tour_paxlist_flight_id && @$request->tour_paxlist_flight_method == 'edit') {
                // Delete temporaries
                $temporary = Temporary::whereId($request->tour_paxlist_flight_id)->first();
                if ($temporary) {
                    $parent_id = $temporary->parent_id;
                    $temporary->update([
                            'type' => 'tour-paxlist-flight',
                            'user_id' => user_info('id'),
                            'data' => json_encode($request->except(['_token', 'tour_paxlist_flight_id']))
                        ]);

                    \DB::commit();

                    return response()->json(['result' => true],200);
                }
            }

            \DB::table('temporaries')->insert([
                'type' => 'tour-paxlist-flight',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'tour_paxlist_flight_id'])),
                'parent_id' => $parent_id
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Get detail of Tour Order resource in storage <Auto Generate>.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detailTourOrder(Request $request)
    {
        $result = (object) array();
        $code = 404;
        $message = 'Data Not Found';

        // Find Tour Order
        $tourOrder = TourOrder::find($request->id);

        if ($tourOrder) {
            // If Exist
            $code = 200;
            $message = 'Success';
            // Get Data relation of tour
            $tourOrder->tour;

            // Get Data relation of paxlist
            foreach ($tourOrder->paxLists as $key => $value) {
                // Get Data relation of paxlist tour
                $value->paxListTour;

                // Get Data relation of paxlist tour accomodation
                $value->paxListTour->paxListTourAccomodation;
                // Get Data relation of paxlist tour selling
                $value->paxListTour->paxListTourSelling;
                // Get Data relation of paxlist tour flights
                $value->paxListTour->paxListTourFlights;
            }

            $result = $tourOrder->toArray();
        }

        return response()->json(['code' => $code, 'message' => $message, 'data' => $result], 200);
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $delivery = TourOrder::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($delivery) {
            $excel->sheet('Sheet 1', function($sheet) use ($delivery) {
                $sheet->fromArray($delivery);
            });
        })->export('xls');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $tourorders = TourOrder::all();
        $pdf = \PDF::loadView('contents.fits.tour_order.pdf', compact('tourorders'));
        return $pdf->download('tour-orders.pdf');
    }

}
