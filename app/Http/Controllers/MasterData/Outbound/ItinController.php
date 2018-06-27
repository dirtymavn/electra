<?php

namespace App\Http\Controllers\MasterData\Outbound;

use App\Models\MasterData\Outbound\Itinerary\MasterItinerary;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryDetail;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryOptional;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryService;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryServiceCostInterval;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryServiceFoc;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryServiceOtherPtc;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryServiceRoute;
use App\Models\MasterData\Outbound\Itinerary\MasterItineraryServiceTax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\Outbound\ItinDataTable;
use App\Http\Requests\MasterData\Outbound\ItinRequest;

class ItinController extends Controller
{
    /**
     * @var App\Models\MasterData\Outbound\Itinerary\MasterItinerary
    */
    protected $itin;

    /**
     * Create a new ItinController instance.
     *
     * @param \App\Models\MasterData\Outbound\Itinerary\MasterItinerary  $itin
    */
    public function __construct(MasterItinerary $itin)
    {
        $this->itin = $itin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItinDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.outbounds.itin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();

        return view('contents.master_datas.outbounds.itin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\Outbound\ItinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItinRequest $request)
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

            $insertItin = $this->itin->create($request->all());

            if ($insertItin) {
                $redirect = redirect()->route('itin.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('itin.edit', $insertItin->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('itin.create');
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
     * @param  \App\Outbound\Itinerary\MasterItinerary  $itin
     * @return \Illuminate\Http\Response
     */
    public function show(MasterItinerary $itin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outbound\Itinerary\MasterItinerary  $itin
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterItinerary $itin)
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();

        $details = $itin->details;
        foreach ($details as $detail) {
            $detail->as_remark_flag = ($detail->as_remark_flag) ? 'true' : 'false';
            \DB::table('temporaries')->insert([
                'type' => 'itinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($detail->toArray()),
            ]);
        }
        $optionals = $itin->optionals;
        foreach ($optionals as $optional) {
            $data = [
                'optional_product_description' => $optional->product_description,
                'optional_supplier_no' => $optional->supplier_no,
                'optional_product_code' => $optional->product_code,
                'optional_reference_no' => $optional->reference_no,
                'optional_currency' => $optional->currency,
                'optional_cost' => $optional->cost
            ];

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-optional',
                'user_id' => user_info('id'),
                'data' => json_encode($data),
            ]);
        }

        $services = $itin->services;
        foreach ($services as $service) {
            if ($service->type == 'fixed') {
                $type = 'itinerary-service-fixed';
            } else {
                $type = 'itinerary-service-variable';
            }

            $interval = $service->costIntervals()->first();
            $foc = $service->focs()->first();
            $otherPtc = $service->otherPtcs()->first();
            $route = $service->routes()->first();
            $tax = $service->taxs()->first();

            $data = [
                'product_code' => $service->product_code,
                'service_type' => $service->type,
                'ref_no' => $service->ref_no,
                'charge_method' => $service->charge_method,
                'supplier_no' => $service->supplier_no,
                'currency' => $service->currency,
                'service_remark' => $service->remark,
                'tax_type' => $service->tax_type,
                'tax_currency' => $service->tax_currency,
                'tax_free_foc_flag' => ($service->tax_free_foc_flag) ? 'true' : 'false',
                'foc_discount_type' => $service->foc_discount_type,
                'interval_pax_from' => $interval->pax_from,
                'interval_pax_to' => $interval->pax_to,
                'interval_unit_cost' => $interval->unit_cost,
                'interval_discount_percent' => $interval->discount_percent,
                'interval_discount_amount' => $interval->discount_amount,
                'interval_net_cost' => $interval->net_cost,
                'foc_pax_no' => $foc->pax_no,
                'foc_foc' => $foc->foc,
                'ptc_pax_ptc' => $otherPtc->pax_ptc,
                'ptc_pax_from' => $otherPtc->pax_from,
                'ptc_pax_to' => $otherPtc->pax_to,
                'ptc_unit_cost' => $otherPtc->unit_cost,
                'ptc_discount_percent' => $otherPtc->discount_percent,
                'ptc_discount_amount' => $otherPtc->discount_amount,
                'ptc_net_cost' => $otherPtc->net_cost,
                'route_description' => $route->description,
                'start_date' => $route->start_date,
                'end_date' => $route->end_date,
                'start_description' => $route->start_description,
                'end_description' => $route->end_description,
                'status' => $route->status,
                'tax_ptc' => @$tax->ptc,
                'tax_tax_amount' => @$tax->tax_amount
            ];

            \DB::table('temporaries')->insert([
                'type' => $type,
                'user_id' => user_info('id'),
                'data' => json_encode($data),
            ]);
        }

        return view('contents.master_datas.outbounds.itin.edit', compact('itin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outbound\Itinerary\MasterItinerary  $itin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterItinerary $itin)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('itin.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('itin.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('itin.edit', $itin->id);
            }

            $updateItin = $itin->update($request->all());

            if ($updateItin) {
                // Update childs
                $this->updateChilds($itin);

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

    protected function updateChilds($itin)
    {
        // delete childs
        $details = $itin->details;
        foreach ($details as $value) {
            $value->delete();
        }

        $optionals = $itin->optionals;
        foreach ($optionals as $value) {
            $value->delete();
        }

        $services =  $itin->services;
        foreach ($services as $value) {
            $value->delete();
        }


        $itinDetails = \DB::table('temporaries')->whereType('itinerary-detail')
            ->whereUserId(user_info('id'))
            ->get();
        if (count($itinDetails) > 0) {
            foreach ($itinDetails as $itinDetail) {
                $detail = new MasterItineraryDetail;

                $itinDetail = json_decode($itinDetail->data);

                $detail->master_itinerary_id = $itin->id;
                $detail->day = $itinDetail->day;
                $detail->as_remark_flag = ($itinDetail->as_remark_flag === true || $itinDetail->as_remark_flag == 'true') ? true : false;
                $detail->remark_seq = $itinDetail->remark_seq;
                $detail->itinerary_item_code = $itinDetail->itinerary_item_code;
                $detail->city = $itinDetail->city;
                $detail->brief_description = $itinDetail->brief_description;
                $detail->land_operator = $itinDetail->land_operator;
                $detail->description = $itinDetail->description;
                $detail->highlight = $itinDetail->highlight;
                $detail->breakfast = $itinDetail->breakfast;
                $detail->lunch = $itinDetail->lunch;
                $detail->dinner = $itinDetail->dinner;
                $detail->accomodations = $itinDetail->accomodations;
                $detail->remark = $itinDetail->remark;
                $detail->transport_detail = $itinDetail->transport_detail;

                $detail->save();
            }
        }

        $itinOptionals = \DB::table('temporaries')->whereType('itinerary-optional')
            ->whereUserId(user_info('id'))
            ->get();
        if (count($itinOptionals) > 0) {
            foreach ($itinOptionals as $itinOptional) {
                $itinOptional = json_decode($itinOptional->data);

                $optional = new MasterItineraryOptional;

                $optional->master_itinerary_id = $itin->id;
                $optional->product_description = $itinOptional->optional_product_description;
                $optional->supplier_no = $itinOptional->optional_supplier_no;
                $optional->product_code = $itinOptional->optional_product_code;
                $optional->reference_no = $itinOptional->optional_reference_no;
                $optional->currency = $itinOptional->optional_currency;
                $optional->cost = $itinOptional->optional_cost;

                $optional->save();
            }
        }

        $itinServices = \DB::table('temporaries')->where('type', 'itinerary-service-fixed')
            ->orWhere('type', 'itinerary-service-variable')
            ->whereUserId(user_info('id'))
            ->get();
        if (count($itinServices) > 0) {
            foreach ($itinServices as $itinService) {
                $itinService = json_decode($itinService->data);

                $service = new MasterItineraryService;

                $service->master_itinerary_id = $itin->id;
                $service->product_code = $itinService->product_code;
                $service->type = $itinService->service_type;
                $service->ref_no = $itinService->ref_no;
                $service->charge_method = $itinService->charge_method;
                $service->supplier_no = $itinService->supplier_no;
                $service->currency = $itinService->currency;
                $service->remark = $itinService->service_remark;
                $service->tax_type = $itinService->tax_type;
                $service->tax_currency = $itinService->tax_currency;
                $service->tax_free_foc_flag = ($itinService->tax_free_foc_flag === true || $itinService->tax_free_foc_flag == 'true') ? true : false;
                $service->foc_discount_type = $itinService->foc_discount_type;

                $service->save();

                $interval = new MasterItineraryServiceCostInterval;
                $interval->master_itinerary_service_id = $service->id;
                $interval->pax_from = $itinService->interval_pax_from;
                $interval->pax_to = $itinService->interval_pax_to;
                $interval->unit_cost = $itinService->interval_unit_cost;
                $interval->discount_percent = $itinService->interval_discount_percent;
                $interval->discount_amount = $itinService->interval_discount_amount;
                $interval->net_cost = $itinService->interval_net_cost;
                $interval->save();

                $foc = new MasterItineraryServiceFoc;
                $foc->master_itinerary_service_id = $service->id;
                $foc->pax_no = $itinService->foc_pax_no;
                $foc->foc = $itinService->foc_foc;
                $foc->save();

                $ptc = new MasterItineraryServiceOtherPtc;
                $ptc->master_itinerary_service_id = $service->id;
                $ptc->pax_ptc = $itinService->ptc_pax_ptc;
                $ptc->pax_from = $itinService->ptc_pax_from;
                $ptc->pax_to = $itinService->ptc_pax_to;
                $ptc->unit_cost = $itinService->ptc_unit_cost;
                $ptc->discount_percent = $itinService->ptc_discount_percent;
                $ptc->discount_amount = $itinService->ptc_discount_amount;
                $ptc->net_cost = $itinService->ptc_net_cost;
                $ptc->save();

                $route = new MasterItineraryServiceRoute;
                $route->master_itinerary_service_id = $service->id;
                $route->description = $itinService->route_description;
                $route->start_date = $itinService->start_date;
                $route->end_date = $itinService->end_date;
                $route->start_description = $itinService->start_description;
                $route->end_description = $itinService->end_description;
                $route->status = $itinService->status;
                $route->save();

                $tax = new MasterItineraryServiceTax;
                $tax->master_itinerary_service_id = $service->id;
                $tax->ptc = $itinService->tax_ptc;
                $tax->tax_amount = $itinService->tax_tax_amount;
                $tax->save();

            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outbound\Itinerary\MasterItinerary  $itin
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterItinerary $itin)
    {
        $itin->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('itin.index');

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
            MasterItinerary::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('itin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        if ($request->type == 'itinerary-detail') {
            return datatables()->of($datas)
                ->addColumn('action', function ($itin) {
                    return '<a href="javascript:void(0)" class="editData" title="Edit" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                <a href="javascript:void(0)" class="danger deleteData" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->editColumn('as_remark_flag', function ($itin) {
                    return ($itin['as_remark_flag'] == 'true' || $itin['as_remark_flag'] === true) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';

                })
                ->rawColumns(['as_remark_flag', 'action'])
                ->make(true);
        } elseif ($request->type == 'itinerary-optional') {
            return datatables()->of($datas)
                ->addColumn('action', function ($itin) {
                    return '<a href="javascript:void(0)" class="editDataOptional" title="Edit" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                                        <a href="javascript:void(0)" class="danger deleteDataOptional" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return datatables()->of($datas)
                ->addColumn('action', function ($itin) {
                    return '<a href="javascript:void(0)" class="editDataService" title="Edit" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                            <a href="javascript:void(0)" class="danger deleteDataService" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryDetailStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->itinerary_detail_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->itinerary_detail_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'itinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_detail_id']))
            ]);

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
    public function itineraryDetailDelete(Request $request)
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
    public function itineraryDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryServiceStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->itinerary_service_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->itinerary_service_id)->delete();
            }

            if ($request->service_type == 'fixed') {
                $type = 'itinerary-service-fixed';
            } else {
                $type = 'itinerary-service-variable';
            }

            \DB::table('temporaries')->insert([
                'type' => $type,
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
    
    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryOptionalStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->itinerary_optional_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->itinerary_optional_id)->delete();
            }

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-optional',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_optional_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
