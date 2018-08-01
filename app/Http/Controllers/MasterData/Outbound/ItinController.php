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
use App\Models\Temporary;
use App\Models\MasterData\Branch;
use App\Models\MasterData\City;
use App\Models\MasterData\Airline;
use App\Models\MasterData\Country;
use App\Models\MasterData\Supplier\MasterSupplier;
use App\Models\MasterData\Currency\Currency;
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

        // middleware
        $this->middleware('sentinel_access:admin.company,itin.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,itin.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,itin.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,itin.destroy', ['only' => ['destroy']]);

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
    public function create(Request $request)
    {
        // clear temporary data
        if (!$request->error) {
            \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        }

        $newCode = '';
        $branchs = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $cities = City::getAvailableData()
            ->select("cities.city_code as slug", \DB::raw("(cities.city_name || '-' || cities.city_code) as text"))
            ->pluck('text', 'slug')->all();
        $airlines = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')
            ->all();
        $departures = City::getAvailableData()
            ->select(\DB::raw("(cities.id ||'/'|| countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as slug"), 
                \DB::raw("(countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as text"))
            ->pluck('text', 'slug')->all();
        $nationalities = Country::getDataByCompany()
            ->select(\DB::raw("(countries.country_name || '-' || countries.nationality) as text"), 'countries.id')
            ->pluck('text', 'countries.id')->all();
        $suppliers = MasterSupplier::getAvailableData()
            ->select('master_supplier.id', \DB::raw("(master_supplier.supplier_no||'-'||master_supplier.name) as text"), 'master_supplier.supplier_no as slug')
            ->pluck('text', 'slug')
            ->all();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();

        return view('contents.master_datas.outbounds.itin.create', compact('newCode', 'branchs', 'cities', 'airlines', 'departures', 'nationalities', 'suppliers', 'currencys'));
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
            $newCode = MasterItinerary::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'itinerary_code' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'itinerary_code' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
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
            $url = route('itin.create').'?error=y';
            return redirect()->to($url)->withInput();
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
    public function edit(MasterItinerary $itin, Request $request)
    {
        // clear temporary data
        if (!$request->error) {
            \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        }

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
                'foc_discount_type' => $service->foc_discount_type
            ];

            $tempService = Temporary::create([
                'type' => $type,
                'user_id' => user_info('id'),
                'data' => json_encode($data),
            ]);

            foreach ($service->costIntervals as $interval) {
                $data = [
                    'interval_pax_from' => $interval->pax_from,
                    'interval_pax_to' => $interval->pax_to,
                    'interval_unit_cost' => $interval->unit_cost,
                    'interval_discount_percent' => $interval->discount_percent,
                    'interval_discount_amount' => $interval->discount_amount,
                    'interval_net_cost' => $interval->net_cost
                ];

                Temporary::create([
                    'type' => 'itinerary-service-interval',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data),
                    'parent_id' => $tempService->id
                ]);
            }

            foreach ($service->focs as $foc) {
                $data = [
                    'foc_pax_no' => $foc->pax_no,
                    'foc_foc' => $foc->foc
                ];

                Temporary::create([
                    'type' => 'itinerary-service-foc',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data),
                    'parent_id' => $tempService->id
                ]);
            }

            foreach ($service->otherPtcs as $ptc) {
                $data = [
                    'ptc_pax_ptc' => $ptc->pax_ptc,
                    'ptc_pax_from' => $ptc->pax_from,
                    'ptc_pax_to' => $ptc->pax_to,
                    'ptc_unit_cost' => $ptc->unit_cost,
                    'ptc_discount_percent' => $ptc->discount_percent,
                    'ptc_discount_amount' => $ptc->discount_amount,
                    'ptc_net_cost' => $ptc->net_cost
                ];

                Temporary::create([
                    'type' => 'itinerary-service-ptc',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data),
                    'parent_id' => $tempService->id
                ]);
            }
            
            foreach ($service->routes as $route) {
                $data = [
                    'route_description' => $route->description,
                    'start_date' => $route->start_date,
                    'end_date' => $route->end_date,
                    'start_description' => $route->start_description,
                    'end_description' => $route->end_description,
                    'status' => $route->status
                ];

                Temporary::create([
                    'type' => 'itinerary-service-route',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data),
                    'parent_id' => $tempService->id
                ]);
            }

            foreach ($service->taxs as $tax) {
                $data = [
                    'tax_ptc' => @$tax->ptc,
                    'tax_tax_amount' => @$tax->tax_amount
                ];

                Temporary::create([
                    'type' => 'itinerary-service-tax',
                    'user_id' => user_info('id'),
                    'data' => json_encode($data),
                    'parent_id' => $tempService->id
                ]);
            }
        }

        $newCode = $itin->itinerary_code;
        $branchs = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $cities = City::getAvailableData()
            ->select("cities.city_code as slug", \DB::raw("(cities.city_name || '-' || cities.city_code) as text"))
            ->pluck('text', 'slug')->all();
        $airlines = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')
            ->all();
        $departures = City::getAvailableData()
            ->select(\DB::raw("(cities.id ||'/'|| countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as slug"), 
                \DB::raw("(countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as text"))
            ->pluck('text', 'slug')->all();
        $nationalities = Country::getDataByCompany()
            ->select(\DB::raw("(countries.country_name || '-' || countries.nationality) as text"), 'countries.id')
            ->pluck('text', 'countries.id')->all();
        $suppliers = MasterSupplier::getAvailableData()
            ->select('master_supplier.id', \DB::raw("(master_supplier.supplier_no||'-'||master_supplier.name) as text"), 'master_supplier.supplier_no as slug')
            ->pluck('text', 'slug')
            ->all();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();

        return view('contents.master_datas.outbounds.itin.edit', compact('itin', 'newCode', 'branchs', 'cities', 'airlines', 'departures', 'nationalities', 'suppliers', 'currencys'));
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
            $newCode = MasterItinerary::getAutoNumber();
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false, 'itinerary_code' => $newCode]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('itin.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'itinerary_code' => $newCode]);
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
            $url = route('itin.edit', $itin->id).'?error=y';
            return redirect()->to($url)->withInput();
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

        $itinServices = \DB::table('temporaries')
            ->where(function($query) {
                return $query->where('type', 'itinerary-service-fixed')
                    ->orWhere('type', 'itinerary-service-variable');
            })
            ->whereUserId(user_info('id'))
            ->get();
        if (count($itinServices) > 0) {
            foreach ($itinServices as $itinService) {
                $itinServiceData = json_decode($itinService->data);

                $service = new MasterItineraryService;

                $service->master_itinerary_id = $itin->id;
                $service->product_code = $itinServiceData->product_code;
                $service->type = $itinServiceData->service_type;
                $service->ref_no = $itinServiceData->ref_no;
                $service->charge_method = $itinServiceData->charge_method;
                $service->supplier_no = $itinServiceData->supplier_no;
                $service->currency = $itinServiceData->currency;
                $service->remark = $itinServiceData->service_remark;
                $service->tax_type = $itinServiceData->tax_type;
                $service->tax_currency = $itinServiceData->tax_currency;
                $service->tax_free_foc_flag = ($itinServiceData->tax_free_foc_flag === true || $itinServiceData->tax_free_foc_flag == 'true') ? true : false;
                $service->foc_discount_type = $itinServiceData->foc_discount_type;

                $service->save();

                $itinServiceIntervals = \DB::table('temporaries')->where('type', 'itinerary-service-interval')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($itinService->id)
                    ->get();
                if (count($itinServiceIntervals) > 0) {
                    foreach ($itinServiceIntervals as $itinServiceInterval) {
                        $itinServiceInterval = json_decode($itinServiceInterval->data);
                        $interval = new MasterItineraryServiceCostInterval;
                        $interval->master_itinerary_service_id = $service->id;
                        $interval->pax_from = $itinServiceInterval->interval_pax_from;
                        $interval->pax_to = $itinServiceInterval->interval_pax_to;
                        $interval->unit_cost = $itinServiceInterval->interval_unit_cost;
                        $interval->discount_percent = $itinServiceInterval->interval_discount_percent;
                        $interval->discount_amount = $itinServiceInterval->interval_discount_amount;
                        $interval->net_cost = $itinServiceInterval->interval_net_cost;
                        $interval->save();
                    }
                }

                $itinServiceFocs = \DB::table('temporaries')->where('type', 'itinerary-service-foc')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($itinService->id)
                    ->get();
                if (count($itinServiceFocs) > 0) {
                    foreach ($itinServiceFocs as $itinServiceFoc) {
                        $itinServiceFoc = json_decode($itinServiceFoc->data);
                        $foc = new MasterItineraryServiceFoc;
                        $foc->master_itinerary_service_id = $service->id;
                        $foc->pax_no = $itinServiceFoc->foc_pax_no;
                        $foc->foc = $itinServiceFoc->foc_foc;
                        $foc->save();
                    }
                }

                $itinServicePtcs = \DB::table('temporaries')->where('type', 'itinerary-service-ptc')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($itinService->id)
                    ->get();
                if (count($itinServicePtcs) > 0) {
                    foreach ($itinServicePtcs as $itinServicePtc) {
                        $itinServicePtc = json_decode($itinServicePtc->data);
                        $ptc = new MasterItineraryServiceOtherPtc;
                        $ptc->master_itinerary_service_id = $service->id;
                        $ptc->pax_ptc = $itinServicePtc->ptc_pax_ptc;
                        $ptc->pax_from = $itinServicePtc->ptc_pax_from;
                        $ptc->pax_to = $itinServicePtc->ptc_pax_to;
                        $ptc->unit_cost = $itinServicePtc->ptc_unit_cost;
                        $ptc->discount_percent = $itinServicePtc->ptc_discount_percent;
                        $ptc->discount_amount = $itinServicePtc->ptc_discount_amount;
                        $ptc->net_cost = $itinServicePtc->ptc_net_cost;
                        $ptc->save();
                    }
                }

                $itinServiceRoutes = \DB::table('temporaries')->where('type', 'itinerary-service-route')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($itinService->id)
                    ->get();
                if (count($itinServiceRoutes) > 0) {
                    foreach ($itinServiceRoutes as $itinServiceRoute) {
                        $itinServiceRoute = json_decode($itinServiceRoute->data);
                        $route = new MasterItineraryServiceRoute;
                        $route->master_itinerary_service_id = $service->id;
                        $route->description = $itinServiceRoute->route_description;
                        $route->start_date = $itinServiceRoute->start_date;
                        $route->end_date = $itinServiceRoute->end_date;
                        $route->start_description = $itinServiceRoute->start_description;
                        $route->end_description = $itinServiceRoute->end_description;
                        $route->status = $itinServiceRoute->status;
                        $route->save();
                    }
                }

                $itinServiceTaxs = \DB::table('temporaries')->where('type', 'itinerary-service-tax')
                    ->whereUserId(user_info('id'))
                    ->whereParentId($itinService->id)
                    ->get();
                if (count($itinServiceTaxs) > 0) {
                    foreach ($itinServiceTaxs as $itinServiceTax) {
                        $itinServiceTax = json_decode($itinServiceTax->data);
                        $tax = new MasterItineraryServiceTax;
                        $tax->master_itinerary_service_id = $service->id;
                        $tax->ptc = $itinServiceTax->tax_ptc;
                        $tax->tax_amount = $itinServiceTax->tax_tax_amount;
                        $tax->save();
                    }
                }

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
                ->addColumn('action', function ($itin) use($request) {
                    return '<a href="javascript:void(0)" class="editDataService" title="Edit" data-element="'.$request->type.'" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                            <a href="javascript:void(0)" class="danger deleteDataService" data-element="'.$request->type.'" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
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
        if (@$request->type && $request->id == 0) {
            $findTemp = \DB::table('temporaries')->whereType($request->type)->delete();
        } else {
            $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        } 
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

            $temp = Temporary::create([
                'type' => $type,
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_id']))
            ]);

            $itinServiceRoutes = Temporary::where('type', 'itinerary-service-route')
                ->whereParentId($request->itinerary_service_id)
                ->whereUserId(user_info('id'))
                ->get();
            if (count($itinServiceRoutes) > 0) {
                foreach ($itinServiceRoutes as $itinServiceRoute) {

                    $itinServiceRoute->update([
                        'parent_id' => $temp->id
                    ]);
                }
            }

            $itinServiceIntervals = Temporary::where('type', 'itinerary-service-interval')
                ->whereParentId($request->itinerary_service_id)
                ->whereUserId(user_info('id'))
                ->get();
            if (count($itinServiceIntervals) > 0) {
                foreach ($itinServiceIntervals as $itinServiceInterval) {

                    $itinServiceInterval->update([
                        'parent_id' => $temp->id
                    ]);
                }
            }

            $itinServicePtcs = Temporary::where('type', 'itinerary-service-ptc')
                ->whereParentId($request->itinerary_service_id)
                ->whereUserId(user_info('id'))
                ->get();
            if (count($itinServicePtcs) > 0) {
                foreach ($itinServicePtcs as $itinServicePtc) {

                    $itinServicePtc->update([
                        'parent_id' => $temp->id
                    ]);
                }
            }

            $itinServiceFocs = Temporary::where('type', 'itinerary-service-foc')
                ->whereParentId($request->itinerary_service_id)
                ->whereUserId(user_info('id'))
                ->get();
            if (count($itinServiceFocs) > 0) {
                foreach ($itinServiceFocs as $itinServiceFoc) {

                    $itinServiceFoc->update([
                        'parent_id' => $temp->id
                    ]);
                }
            }

            $itinServiceTaxs = Temporary::where('type', 'itinerary-service-tax')
                ->whereParentId($request->itinerary_service_id)
                ->whereUserId(user_info('id'))
                ->get();
            if (count($itinServiceTaxs) > 0) {
                foreach ($itinServiceTaxs as $itinServiceTax) {

                    $itinServiceTax->update([
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

    /**
     * Store a newly created service route resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryServiceRouteStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            $parent_id = $request->itinerary_service_route_id;
            if (@$request->itinerary_service_route_id && @$request->itinerary_service_route_method == 'edit') {
                // Delete temporaries
                $temporary = Temporary::whereId($request->itinerary_service_route_id)->first();
                if ($temporary) {
                    $parent_id = $temporary->parent_id;
                    $temporary->update([
                            'type' => 'itinerary-service-route',
                            'user_id' => user_info('id'),
                            'data' => json_encode($request->except(['_token', 'itinerary_service_route_id']))
                        ]);

                    \DB::commit();

                    return response()->json(['result' => true],200);
                }
            }

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-service-route',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_route_id'])),
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
     * Store a newly created service interval resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryServiceIntervalStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            $parent_id = $request->itinerary_service_interval_id;
            if (@$request->itinerary_service_interval_id && @$request->itinerary_service_interval_method == 'edit') {
                // Delete temporaries
                $temporary = Temporary::whereId($request->itinerary_service_interval_id)->first();
                if ($temporary) {
                    $parent_id = $temporary->parent_id;
                    $temporary->update([
                            'type' => 'itinerary-service-interval',
                            'user_id' => user_info('id'),
                            'data' => json_encode($request->except(['_token', 'itinerary_service_interval_id']))
                        ]);

                    \DB::commit();

                    return response()->json(['result' => true],200);
                }
            }

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-service-interval',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_interval_id'])),
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
     * Store a newly created service ptc resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryServicePtcStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            $parent_id = $request->itinerary_service_ptc_id;
            if (@$request->itinerary_service_ptc_id && @$request->itinerary_service_ptc_method == 'edit') {
                // Delete temporaries
                $temporary = Temporary::whereId($request->itinerary_service_ptc_id)->first();
                if ($temporary) {
                    $parent_id = $temporary->parent_id;
                    $temporary->update([
                            'type' => 'itinerary-service-ptc',
                            'user_id' => user_info('id'),
                            'data' => json_encode($request->except(['_token', 'itinerary_service_ptc_id']))
                        ]);

                    \DB::commit();

                    return response()->json(['result' => true],200);
                }
            }

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-service-ptc',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_ptc_id'])),
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
     * Store a newly created service foc resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryServiceFocStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            $parent_id = $request->itinerary_service_foc_id;
            if (@$request->itinerary_service_foc_id && @$request->itinerary_service_foc_method == 'edit') {
                // Delete temporaries
                $temporary = Temporary::whereId($request->itinerary_service_foc_id)->first();
                if ($temporary) {
                    $parent_id = $temporary->parent_id;
                    $temporary->update([
                            'type' => 'itinerary-service-foc',
                            'user_id' => user_info('id'),
                            'data' => json_encode($request->except(['_token', 'itinerary_service_foc_id']))
                        ]);

                    \DB::commit();

                    return response()->json(['result' => true],200);
                }
            }

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-service-foc',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_foc_id'])),
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
     * Store a newly created service tax resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryServiceTaxStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            $parent_id = $request->itinerary_service_tax_id;
            if (@$request->itinerary_service_tax_id && @$request->itinerary_service_tax_method == 'edit') {
                // Delete temporaries
                $temporary = Temporary::whereId($request->itinerary_service_tax_id)->first();
                if ($temporary) {
                    $parent_id = $temporary->parent_id;
                    $temporary->update([
                            'type' => 'itinerary-service-tax',
                            'user_id' => user_info('id'),
                            'data' => json_encode($request->except(['_token', 'itinerary_service_tax_id']))
                        ]);

                    \DB::commit();

                    return response()->json(['result' => true],200);
                }
            }

            \DB::table('temporaries')->insert([
                'type' => 'itinerary-service-tax',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_service_tax_id'])),
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
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $guide = MasterItinerary::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($guide) {
            $excel->sheet('Sheet 1', function($sheet) use ($guide) {
                $sheet->fromArray($guide);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $itins = MasterItinerary::all();
        $pdf = \PDF::loadView('contents.master_datas.outbounds.itin.pdf', compact('itins'));
        return $pdf->download('outbound-itin.pdf');
    }
}
