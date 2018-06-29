<?php

namespace App\Models\MasterData\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;
use Request;
use OwenIt\Auditing\Contracts\Auditable;

class MasterItinerary extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itineraries';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itinerary_code',
        'itinerary_direction',
        'company_id',
        'branch_id',
        'itinerary_name',
        'airline',
        'category',
        'city_code',
        'type',
        'nationality',
        'description',
        'min_cap',
        'max_cap',
        'validity_start',
        'validity_end',
        'departure',
        'days_duration',
        'cutoff_days',
        'remark',
        'is_draft',

    ];

    /**
     * Get the detail for the itinerary.
     */
    public function details()
    {
        return $this->hasMany(MasterItineraryDetail::class, 'master_itinerary_id');
    }

    /**
     * Get the optional for the itinerary.
     */
    public function optionals()
    {
        return $this->hasMany(MasterItineraryOptional::class, 'master_itinerary_id');
    }

    /**
     * Get the service for the itinerary.
     */
    public function services()
    {
        return $this->hasMany(MasterItineraryService::class, 'master_itinerary_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($itin) {
            $input = Request::all();
            $input['master_tour_itinerary_id'] = $itin->id;

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

            \DB::table('temporaries')->whereUserId(user_info('id'))
                ->delete();

        });
    }
}
