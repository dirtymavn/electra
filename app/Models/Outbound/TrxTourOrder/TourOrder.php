<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\MasterData\Tour;
use Request;

class TourOrder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_tour_orders';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_no',
        'customer_id',
        'order_type',
        'trip_date',
        'deadline',
        'your_ref',
        'our_ref',
        'tc_id',
        'company_id',
        'branch_id',
        'is_draft',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($tourOrder) {
            $input = Request::all();

            $tour = Tour::find($input['master_tour_id']);

            if ($tour) {
            	$tourOrderTour = new TourOrderTour;
	            $tourOrderTour->master_tour_id = $tour->id;
		        $tourOrderTour->trx_tour_order_id = $tourOrder->id;
		        $tourOrderTour->tour_name = $tour->tour_name;
		        $tourOrderTour->tour_code = $tour->tour_code;
		        $tourOrderTour->depart_date = $tour->depart_date;
		        $tourOrderTour->return_date = $tour->return_date;
		        $tourOrderTour->days = $input['days'];
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
					        $flight->airline_id = $tourPaxlistTourFlight->flight_airline_id;
					        $flight->flight_no = $tourPaxlistTourFlight->flight_no;
					        $flight->class = $tourPaxlistTourFlight->class;
					        $flight->farebasis = $tourPaxlistTourFlight->farebasis;
					        $flight->depart_date = $tourPaxlistTourFlight->depart_date;
					        $flight->arrived_date = $tourPaxlistTourFlight->arrived_date;
					        $flight->status = $tourPaxlistTourFlight->status;
					        $flight->save();
		                }
		            }
                }
            }
        });
    }

    public function tour()
    {
    	return $this->hasOne(TourOrderTour::class, 'trx_tour_order_id');
    }

    public function paxLists()
    {
    	return $this->hasMany(TourOrderPaxList::class, 'trx_tour_order_id');
    }

    public static function roomTypes()
    {
    	$types = [
            'Standard' => 'Standard',
            'Superior' => 'Superior',
            'Deluxe' => 'Deluxe',
            'Junior Suite' => 'Junior Suite',
            'Suite' => 'Suite',
            'Presidential' => 'Presidential'
        ];
        
        return collect($types);
    }

    public static function roomCategories()
    {
    	$categories = [
            'Single' => 'Single',
            'Twin' => 'Twin',
            'Double' => 'Double',
            'Family' => 'Family'
        ];
        
        return collect($categories);
    }

    public static function getAutoNumber()
    {
        $result = self::orderBy('id', 'desc')->first();

        $findCode = \DB::table('setting_codes')->whereType('TO')->first();
        if ($result) {
            $lastNumber = (int) substr($result->order_no, strlen($result->order_no) - 4, 4);
            $newNumber = $lastNumber + 1;
            
            if (strlen($newNumber) == 1) {
                $newNumber = '000'.$newNumber;
            } elseif (strlen($newNumber) == 2) {
                $newNumber = '00'.$newNumber;
            } elseif (strlen($newNumber) == 3) {
                $newNumber = '0'.$newNumber;
            } else {
                $newNumber = $newNumber;
            }

            $currMonth = (int)substr($result->order_no, 2, 2);
            $currYear = (int)substr($result->order_no, 4, 2);
            $nowMonth = (int)date('m');
            $nowYear = (int)date('y');

            if ( ($currMonth < $nowMonth && $currYear == $nowYear) || ($currMonth == $nowMonth && $currYear < $nowYear) ) {
                $newNumber = '0001';
            } else {
                $newNumber = $newNumber;
            }

            $newCode = $findCode->type.date('my').$newNumber;
        } else {
            $newCode = $findCode->type.date('my').'0001';
        }

        return $newCode;
    }
}
