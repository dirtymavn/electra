<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class MasterInventory extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'master_inventory';

    protected $fillable = [
    	'trx_sales_id',
    	'inventory_type',
    	'voucher_no',
    	'product_code',
    	'received_date',
    	'booked_qty',
    	'sold_qty',
    	'status',
    	'qty',
    	'guest_name',
    	'iata_no',
    	'tour_code',
    	'coupon_no',
    	'nights',
    	'rooms',
    	'is_draft',
        'company_id',
        'branch_id'
    ];


    public function trx()
    {
        return $this->belongsTo(TrxSales::class, 'trx_sales_id', 'id');
    }

    public function cost()
    {
        return $this->hasOne(MasterInventoryCost::class, 'master_inventory_id', 'id');
    }

    public function transport()
    {
        return $this->hasOne(MasterInventoryTransport::class, 'master_inventory_id', 'id');
    }

    public function routeMiscs()
    {
        return $this->hasMany(MasterInventoryRouteMisc::class, 'master_inventory_id', 'id');
    }

    public function routeCars()
    {
        return $this->hasMany(MasterInventoryRouteCar::class, 'master_inventory_id', 'id');
    }

    public function routeCarTransfers()
    {
        return $this->hasMany(MasterInventoryRouteCarTransfer::class, 'master_inventory_id', 'id');
    }

    public function routePkgs()
    {
        return $this->hasMany(MasterInventoryRoutePkg::class, 'master_inventory_id', 'id');
    }

    public function routeAirs()
    {
        return $this->hasMany(MasterInventoryRouteAir::class, 'master_inventory_id', 'id');
    }

    public function routeHotels()
    {
        return $this->hasMany(MasterInventoryRouteHotel::class, 'master_inventory_id', 'id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($inventory) {
            $input = Request::all();
            $input['master_inventory_id'] = $inventory->id;

            $cost = new MasterInventoryCost;
            $cost->create($input);

            $transport = new MasterInventoryTransport;
            $transport->create($input);
            
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
                    // $car->company = $carData->company;
                    $car->supplier_code = $carData->supplier_code;
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
                    // $carTransfer->company_code = $carTransferData->company_code;
                    $carTransfer->supplier_code = $carTransferData->supplier_code;
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

        });

    }
}
