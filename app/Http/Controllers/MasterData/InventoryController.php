<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Inventory\MasterInventory;
use App\Models\MasterData\Inventory\MasterInventoryRouteCar;
use App\Models\MasterData\Inventory\MasterInventoryRouteCarTransfer;
use App\Models\MasterData\Inventory\MasterInventoryRouteMisc;
use App\Models\MasterData\Inventory\MasterInventoryRouteAir;
use App\Models\MasterData\Inventory\MasterInventoryRoutePkg;
use App\Models\MasterData\Inventory\MasterInventoryRouteHotel;

use App\DataTables\MasterData\InventoryDataTable;
use App\Models\MasterData\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Inventory\MasterInventory as Inventory;
use App\Models\MasterData\Inventory\TrxSales as Trx;
use App\Models\Business\Sales;
use App\Models\Temporary;

use DB;
use Excel;
use PDF;

class InventoryController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,inventory.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,inventory.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,inventory.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,inventory.destroy', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InventoryDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.inventory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $sales = Sales::where('is_draft', false)->pluck('sales_no', 'id')->all();
        $airlines = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')
            ->all();

        if (count($airlines) == 0) {
            $airlines = ['' => '- Not Available -'];
        }
        if (count($sales) == 0) {
            $sales = ['' => '- Not Available -'];
        }
        return view('contents.master_datas.inventory.create', compact('sales', 'airlines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
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

            // $trx = Trx::create( $request->all() );
            $request->merge(['company_id' => @user_info()->company->id ]);

            $insert = Inventory::create( $request->all() );

            if ($insert) {
                $redirect = redirect()->route('inventory.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('inventory.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('inventory.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '.$e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Inventory\MasterInventory  $masterInventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $sales = Sales::where('is_draft', false)->pluck('sales_no', 'id')->all();
        $airlines = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')
            ->all();

        if (count($airlines) == 0) {
            $airlines = ['' => '- Not Available -'];
        }
        if (count($sales) == 0) {
            $sales = ['' => '- Not Available -'];
        }

        foreach ($inventory->routeMiscs as $miscVal) {
            $data = [
                'description' => $miscVal->description,
                'start_date' => date('Y-m-d', strtotime($miscVal->start_date)),
                'end_date' => date('Y-m-d', strtotime($miscVal->end_date)),
                'start_desc' => $miscVal->start_desc,
                'end_desc' => $miscVal->end_desc,
                'misc_status' => $miscVal->status,
            ];

            Temporary::create([
                'type' => 'misc-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
    
        foreach ($inventory->routeCars as $carVal) {
            $data = [
                'from' => $carVal->from,
                'to' => $carVal->to,
                'company' => $carVal->company,
                'class' => $carVal->class,
                'departure' => date('Y-m-d', strtotime($carVal->departure)),
                'arrival' => date('Y-m-d', strtotime($carVal->arrival)),
                'car_status' => $carVal->status,
            ];

            Temporary::create([
                'type' => 'car-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
    

        foreach ($inventory->routeCarTransfers as $carTransferVal) {
            $data = [
                'city' => $carTransferVal->city,
                'company_code' => $carTransferVal->company_code,
                'vehicle' => $carTransferVal->vehicle,
                'days_hired' => $carTransferVal->days_hired,
                'pickup_date' => date('Y-m-d', strtotime($carTransferVal->pickup_date)),
                'pickup_location' => $carTransferVal->pickup_location,
                'dropoff_date' => date('Y-m-d', strtotime($carTransferVal->dropoff_date)),
                'dropoff_location' => $carTransferVal->dropoff_location,
                'trans_status' => $carTransferVal->status,
                'rate_type' => $carTransferVal->rate_type,
            ];

            Temporary::create([
                'type' => 'car-transfer-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
    

        foreach ($inventory->routePkgs as $pkgVal) {
            $data = [
                'package_name' => $pkgVal->package_name,
                'pkg_start_date' => date('Y-m-d', strtotime($pkgVal->start_date)),
                'pkg_end_date' => date('Y-m-d', strtotime($pkgVal->end_date)),
                'pkg_status' => $pkgVal->status,
            ];

            Temporary::create([
                'type' => 'pkg-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
    

        foreach ($inventory->routeAirs as $routeAirVal) {
            $data = [
                'route_from' => $routeAirVal->route_from,
                'route_to' => $routeAirVal->route_to,
                'airline_code' => $routeAirVal->airline_code,
                'flight_no' => $routeAirVal->flight_no,
                'class' => $routeAirVal->class,
                'farebasis' => $routeAirVal->farebasis,
                'depart_date' => $routeAirVal->depart_date,
                'arrival' => date('Y-m-d', strtotime($routeAirVal->arrival)),
                'departure' => date('Y-m-d', strtotime($routeAirVal->departure)),
                'air_status' => $routeAirVal->status,
                'equip' => $routeAirVal->equip,
                'stopover_city' => $routeAirVal->stopover_city,
                'stopover_qty' => $routeAirVal->stopover_qty,
                'seat_no' => $routeAirVal->seat_no,
                'airline_pnr' => $routeAirVal->airline_pnr,
                'fly_duration' => $routeAirVal->fly_duration,
                'meal_srv' => $routeAirVal->meal_srv,
                'terminal' => $routeAirVal->terminal,
                'ssr' => $routeAirVal->ssr,
                'sector_pair' => $routeAirVal->sector_pair,
                'miliage' => $routeAirVal->miliage,
                'path_code' => $routeAirVal->path_code,
                'land_sector_flag' => $routeAirVal->land_sector_flag,
                'land_sector_desc' => $routeAirVal->land_sector_desc,
            ];

            Temporary::create([
                'type' => 'route-air-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
    

        foreach ($inventory->routeHotels as $routeHotelVal) {
            $data = [
                'hotel_city' => $routeHotelVal->city,
                'hotel_name' => $routeHotelVal->hotel_name,
                'hotel_chain' => $routeHotelVal->hotel_chain,
                'phone' => $routeHotelVal->phone,
                'fax' => $routeHotelVal->fax,
                'checkin_date' => date('Y-m-d', strtotime($routeHotelVal->checkin_date)),
                'checkout_date' => date('Y-m-d', strtotime($routeHotelVal->checkout_date)),
                'hotel_status' => $routeHotelVal->status,
                'rm_type' => $routeHotelVal->rm_type,
                'rm_cat' => $routeHotelVal->rm_cat,
                'guest_prm' => $routeHotelVal->guest_prm,
                'meals' => $routeHotelVal->meals,
                'other_svc' => $routeHotelVal->other_svc,
                'ref_code' => $routeHotelVal->ref_code,
                'confirmation_code' => $routeHotelVal->confirmation_code,
                'address' => $routeHotelVal->address,
                'remark' => $routeHotelVal->remark,
            ];

            Temporary::create([
                'type' => 'route-hotel-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        // $trx = $inventory->trx->toArray();
        $cost = $inventory->cost->toArray();
        $transport = $inventory->transport->toArray();
        $inventory = $inventory->toArray();
        
        unset($cost['id'], $transport['id']);

        $merge = array_merge($inventory, $cost, $transport);

        $inventory = (object) $merge;

        return view('contents.master_datas.inventory.edit', compact('inventory', 'sales', 'airlines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('inventory.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('inventory.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('inventory.edit', $inventory->id);
            }

            $update = $inventory->update( $request->all() );
            if ($update) {
                $input = $request->all();
                $input['master_inventory_id'] = $inventory->id;

                $cost = $inventory->cost;
                $cost->update($input);

                $transport = $inventory->transport;
                $transport->update($input);

                $routeMiscs =  $inventory->routeMiscs;
                foreach ($routeMiscs as $value) {
                    $value->delete();
                }
                $routeAirs =  $inventory->routeAirs;
                foreach ($routeAirs as $value) {
                    $value->delete();
                }
                $routeCars =  $inventory->routeCars;
                foreach ($routeCars as $value) {
                    $value->delete();
                }
                $routeCarTransfers =  $inventory->routeCarTransfers;
                foreach ($routeCarTransfers as $value) {
                    $value->delete();
                }
                $routeHotels =  $inventory->routeHotels;
                foreach ($routeHotels as $value) {
                    $value->delete();
                }
                $routePkgs =  $inventory->routePkgs;
                foreach ($routePkgs as $value) {
                    $value->delete();
                }
                
                $miscs = \DB::table('temporaries')->whereType('misc-detail')
                    ->whereUserId(user_info('id'))
                    ->get();

                if (count($miscs) > 0) {
                    foreach ($miscs as $miscVal) {
                        $miscData = json_decode($miscVal->data);

                        $misc = new MasterInventoryRouteMisc;

                        $misc->master_inventory_id = $inventory->id;
                        $misc->description = $miscData->description;
                        $misc->start_date = $miscData->start_date;
                        $misc->end_date = $miscData->end_date;
                        $misc->start_desc = $miscData->start_desc;
                        $misc->end_desc = $miscData->end_desc;
                        $misc->status = $miscData->misc_status;

                        $misc->save();
                    }
                }

                $cars = \DB::table('temporaries')->whereType('car-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($cars) > 0) {
                    foreach ($cars as $carVal) {
                        $carData = json_decode($carVal->data);

                        $car = new MasterInventoryRouteCar;

                        $car->master_inventory_id = $inventory->id;
                        $car->from = $carData->from;
                        $car->to = $carData->to;
                        $car->company = $carData->company;
                        $car->class = $carData->class;
                        $car->departure = $carData->departure;
                        $car->arrival = $carData->arrival;
                        $car->status = $carData->car_status;

                        $car->save();
                    }
                }

                $carTransfers = \DB::table('temporaries')->whereType('car-transfer-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($carTransfers) > 0) {
                    foreach ($carTransfers as $carTransferVal) {
                        $carTransferData = json_decode($carTransferVal->data);

                        $carTransfer = new MasterInventoryRouteCarTransfer;

                        $carTransfer->master_inventory_id = $inventory->id;
                        $carTransfer->city = $carTransferData->city;
                        $carTransfer->company_code = $carTransferData->company_code;
                        $carTransfer->vehicle = $carTransferData->vehicle;
                        $carTransfer->days_hired = $carTransferData->days_hired;
                        $carTransfer->pickup_date = $carTransferData->pickup_date;
                        $carTransfer->pickup_location = $carTransferData->pickup_location;
                        $carTransfer->dropoff_date = $carTransferData->dropoff_date;
                        $carTransfer->dropoff_location = $carTransferData->dropoff_location;
                        $carTransfer->status = $carTransferData->trans_status;
                        $carTransfer->rate_type = $carTransferData->rate_type;

                        $carTransfer->save();
                    }
                }

                $pkgs = \DB::table('temporaries')->whereType('pkg-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($pkgs) > 0) {
                    foreach ($pkgs as $pkgVal) {
                        $pkgData = json_decode($pkgVal->data);

                        $pkg = new MasterInventoryRoutePkg;

                        $pkg->master_inventory_id = $inventory->id;
                        $pkg->package_name = $pkgData->package_name;
                        $pkg->start_date = $pkgData->pkg_start_date;
                        $pkg->end_date = $pkgData->pkg_end_date;
                        $pkg->status = $pkgData->pkg_status;

                        $pkg->save();
                    }
                }

                $routeAirs = \DB::table('temporaries')->whereType('route-air-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($routeAirs) > 0) {
                    foreach ($routeAirs as $routeAirVal) {
                        $routeAirData = json_decode($routeAirVal->data);

                        $routeAir = new MasterInventoryRouteAir;

                        $routeAir->master_inventory_id = $inventory->id;
                        $routeAir->route_from = $routeAirData->route_from;
                        $routeAir->route_to = $routeAirData->route_to;
                        $routeAir->airline_code = $routeAirData->airline_code;
                        $routeAir->flight_no = $routeAirData->flight_no;
                        $routeAir->class = $routeAirData->class;
                        $routeAir->farebasis = $routeAirData->farebasis;
                        $routeAir->depart_date = $routeAirData->depart_date;
                        $routeAir->arrival = $routeAirData->arrival;
                        $routeAir->departure = $routeAirData->departure;
                        $routeAir->status = $routeAirData->air_status;
                        $routeAir->equip = $routeAirData->equip;
                        $routeAir->stopover_city = $routeAirData->stopover_city;
                        $routeAir->stopover_qty = $routeAirData->stopover_qty;
                        $routeAir->seat_no = $routeAirData->seat_no;
                        $routeAir->airline_pnr = $routeAirData->airline_pnr;
                        $routeAir->fly_duration = $routeAirData->fly_duration;
                        $routeAir->meal_srv = $routeAirData->meal_srv;
                        $routeAir->terminal = $routeAirData->terminal;
                        $routeAir->ssr = $routeAirData->ssr;
                        $routeAir->sector_pair = $routeAirData->sector_pair;
                        $routeAir->miliage = $routeAirData->miliage;
                        $routeAir->path_code = $routeAirData->path_code;
                        $routeAir->land_sector_flag = $routeAirData->land_sector_flag;
                        $routeAir->land_sector_desc = $routeAirData->land_sector_desc;

                        $routeAir->save();
                    }
                }

                $routeHotels = \DB::table('temporaries')->whereType('route-hotel-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($routeHotels) > 0) {
                    foreach ($routeHotels as $routeHotelVal) {
                        $routeHotelData = json_decode($routeHotelVal->data);

                        $routeHotel = new MasterInventoryRouteHotel;

                        $routeHotel->master_inventory_id = $inventory->id;
                        $routeHotel->city = $routeHotelData->hotel_city;
                        $routeHotel->hotel_name = $routeHotelData->hotel_name;
                        $routeHotel->hotel_chain = $routeHotelData->hotel_chain;
                        $routeHotel->phone = $routeHotelData->phone;
                        $routeHotel->fax = $routeHotelData->fax;
                        $routeHotel->checkin_date = $routeHotelData->checkin_date;
                        $routeHotel->checkout_date = $routeHotelData->checkout_date;
                        $routeHotel->status = $routeHotelData->hotel_status;
                        $routeHotel->rm_type = $routeHotelData->rm_type;
                        $routeHotel->rm_cat = $routeHotelData->rm_cat;
                        $routeHotel->guest_prm = $routeHotelData->guest_prm;
                        $routeHotel->meals = $routeHotelData->meals;
                        $routeHotel->other_svc = $routeHotelData->other_svc;
                        $routeHotel->ref_code = $routeHotelData->ref_code;
                        $routeHotel->confirmation_code = $routeHotelData->confirmation_code;
                        $routeHotel->address = $routeHotelData->address;
                        $routeHotel->remark = $routeHotelData->remark;

                        $routeHotel->save();
                    }
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }

            flash()->error('<strong>Whoops! </strong> Something went wrong');        
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '. $e->getMessage());        
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $destroy = $inventory->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('inventory.index');
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
            Inventory::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('inventory.index');
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

        if ($request->type == 'pkg-detail') {
            $classEdit = 'editDataPkg';
            $classDelete = 'deleteDataPkg';
        } elseif ($request->type == 'car-detail') {
            $classEdit = 'editDataCar';
            $classDelete = 'deleteDataCar';
        } elseif ($request->type == 'car-transfer-detail') {
            $classEdit = 'editDataCarTrf';
            $classDelete = 'deleteDataCarTrf';
        } elseif ($request->type == 'route-air-detail') {
            $classEdit = 'editDataAir';
            $classDelete = 'deleteDataAir';
        } elseif ($request->type == 'route-hotel-detail') {
            $classEdit = 'editDataHotel';
            $classDelete = 'deleteDataHotel';
        } else {
            $classEdit = 'editData';
            $classDelete = 'deleteData';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($inventory) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $inventory['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $inventory['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inventoryDetailMisc(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->misc_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->misc_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'misc-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'misc_id']))
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
    public function inventoryDetailPkg(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->pkg_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->pkg_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'pkg-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'pkg_id']))
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
    public function inventoryDetailCar(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->car_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->car_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'car-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'car_id']))
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
    public function inventoryCarTransfer(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->car_transfer_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->car_transfer_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'car-transfer-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'car_transfer_id']))
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
    public function inventoryRouteAir(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->route_air_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->route_air_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'route-air-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'route_air_id']))
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
    public function inventoryRouteHotel(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->route_hotel_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->route_hotel_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'route-hotel-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'route_hotel_id']))
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
    public function inventoryDetailDelete(Request $request)
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
    public function inventoryDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $inventory = Inventory::select('*')->get();
        Excel::create('testing-'.date('Ymd'), function($excel) use ($inventory) {
            $excel->sheet('Sheet 1', function($sheet) use ($inventory) {
                $sheet->fromArray($inventory);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $inventories = Inventory::all();
        $pdf = PDF::loadView('contents.master_datas.inventory.pdf', compact('inventories'));
        return $pdf->download('inventory.pdf');
    }
}
