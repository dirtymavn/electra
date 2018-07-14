<?php

namespace App\Http\Controllers\Outbound;

use App\Models\Outbound\TrxTourOrder\TourOrder;
use App\Models\Outbound\TrxTourOrder\TourOrderPaxList;
use App\Models\Outbound\TrxTourOrder\TourOrderPaxListTour;
use App\Models\Outbound\TrxTourOrder\TourOrderPaxListTourAccomodation;
use App\Models\Outbound\TrxTourOrder\TourOrderPaxListTourSelling;
use App\Models\Outbound\TrxTourOrder\TourOrderPaxListTourFlight;
use App\Models\Outbound\TrxTourOrder\TourOrderTour;
use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\MasterData\Airline;
use App\Models\MasterData\Tour;
use App\Models\Temporary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Outbound\TourOrderDataTable;
use App\Http\Requests\Outbound\PaxListTourRequest;

class TourOrderController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,tourorder.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,tourorder.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,tourorder.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,tourorder.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TourOrderDataTable $dataTable)
    {
        return $dataTable->render('contents.outbounds.tour_order.index');
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

        if (count($customers) == 0) {
            $customers = ['' => '- Not Available -'];
        }

        if (count($tours) == 0) {
            $tours = ['' => '- Not Available -'];
        }

        if (count($airlines) == 0) {
            $airlines = ['' => '- Not Available -'];
        }

        return view('contents.outbounds.tour_order.create', compact('customers', 'tours', 'airlines'));
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
            $request->merge([ 'company_id' =>  @user_info()->company->id ]);
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
            }

            $insert = TourOrder::create($request->all());
            
            if ($insert) {
                $redirect = redirect()->route('tourorder.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('tourorder.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('tourorder.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            \DB::rollback();
            $url = route('tourorder.create').'?error=y';
            return redirect()->to($url)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outbound\TrxTourOrder\TourOrder  $tourOrder
     * @return \Illuminate\Http\Response
     */
    public function show(TourOrder $tourOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outbound\TrxTourOrder\TourOrder  $tourOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(TourOrder $tourOrder, Request $request, $id)
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

        if (count($customers) == 0) {
            $customers = ['' => '- Not Available -'];
        }

        if (count($tours) == 0) {
            $tours = ['' => '- Not Available -'];
        }

        if (count($airlines) == 0) {
            $airlines = ['' => '- Not Available -'];
        }

        
        $tourOrder = TourOrder::find($id);
        $tourOrder->master_tour_id = $tourOrder->tour->id;
        $tourOrder->days = $tourOrder->tour->days;

        foreach ($tourOrder->paxLists as $key => $value) {
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
                    'flight_to' => $flight->flight_to,
                    'flight_airline_is' => $flight->airline_is,
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

        return view('contents.outbounds.tour_order.edit', compact('customers', 'tours', 'airlines', 'tourOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outbound\TrxTourOrder\TourOrder  $tourOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TourOrder $tourOrder, $id)
    {
        $tourOrder = TourOrder::find($id);

        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('tourorder.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('tourorder.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('tourorder.edit', $tourOrder->id);
            }

            $update = $tourOrder->update($request->all());

            if ($update) {

                $tour = Tour::find($request->master_tour_id);

                if ($tour) {
                    $tourOrder->tour->delete();
                    $tourOrderTour = new TourOrderTour;
                    $tourOrderTour->master_tour_id = $tour->id;
                    $tourOrderTour->trx_tour_order_id = $tourOrder->id;
                    $tourOrderTour->tour_name = $tour->tour_name;
                    $tourOrderTour->tour_code = $tour->tour_code;
                    $tourOrderTour->depart_date = $tour->depart_date;
                    $tourOrderTour->return_date = $tour->return_date;
                    $tourOrderTour->days = $request->days;
                    $tourOrderTour->source_type = $tour->source_type;
                    $tourOrderTour->tour_category = $tour->tour_category;
                    $tourOrderTour->pax_no = $tour->pax_no;
                    $tourOrderTour->adult = $tour->adult;
                    $tourOrderTour->child = $tour->child;
                    $tourOrderTour->infant = $tour->infant;
                    $tourOrderTour->senior = $tour->senior;
                    $tourOrderTour->ticket_only = $tour->ticket_only;
                    $tourOrderTour->tour_type = $tour->tour_type;
                    $tourOrderTour->save();
                }
                
                $paxLists =  $tourOrder->paxLists;
                foreach ($paxLists as $value) {
                    $value->delete();
                }

                $tourPaxlists = \DB::table('temporaries')->whereType('tour-paxlist')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($tourPaxlists) > 0) {
                    foreach ($tourPaxlists as $tourPaxlist) {
                        $tourPaxlistData = json_decode($tourPaxlist->data);

                        $paxlist = new TourOrderPaxList;
                        $paxlist->trx_tour_order_id = $tourOrder->id;
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

                        $paxlistTour = new TourOrderPaxListTour;
                        $paxlistTour->trx_tour_order_pax_list_id = $paxlist->id;
                        $paxlistTour->return_date = $tourPaxlistData->return_date;
                        $paxlistTour->deviation = $tourPaxlistData->deviation;
                        $paxlistTour->meal = $tourPaxlistData->meal;
                        $paxlistTour->remark = $tourPaxlistData->remark;
                        $paxlistTour->special_req = $tourPaxlistData->special_req;
                        $paxlistTour->save();

                        $accomodation = new TourOrderPaxListTourAccomodation;
                        $accomodation->trx_tour_order_pax_list_tour_id = $paxlistTour->id;
                        $accomodation->room_type = $tourPaxlistData->room_type;
                        $accomodation->room_category = $tourPaxlistData->room_category;
                        $accomodation->room_share = $tourPaxlistData->room_share;
                        $accomodation->room_id = $tourPaxlistData->room_id;
                        $accomodation->adjoin_room_id = $tourPaxlistData->adjoin_room_id;
                        $accomodation->save();

                        $selling = new TourOrderPaxListTourSelling;
                        $selling->trx_tour_order_pax_list_tour_id = $paxlistTour->id;
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
                                $flight = new TourOrderPaxListTourFlight;
                                $flight->trx_tour_order_pax_list_tour_id = $paxlistTour->id;
                                $flight->flight_from = $tourPaxlistTourFlight->flight_from;
                                $flight->flight_to = $tourPaxlistTourFlight->flight_to;
                                $flight->airline_is = $tourPaxlistTourFlight->flight_airline_is;
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
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outbound\TrxTourOrder\TourOrder  $tourOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourOrder $tourOrder, $id)
    {
        $tourOrder = TourOrder::find($id);

        if ($tourOrder) {
            $tourOrder->delete();
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

        return redirect()->route('tourorder.index');
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
}
