<?php

namespace App\Models\MasterData\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;
use Request;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Setting\CoreForm;

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

            \DB::table('temporaries')->whereUserId(user_info('id'))
                ->delete();

        });
    }

    public static function getAutoNumber()
    {
        $result = self::whereCompanyId(user_info('company_id'))
            ->where('itinerary_code', '<>', 'draft')
            ->orderBy('id', 'desc')->first();

        $findCode = CoreForm::getCodeBySlug('itinerary');
        if ($result) {
            $lastNumber = (int) substr($result->itinerary_code, strlen($result->itinerary_code) - 4, 4);
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

            $currMonth = (int)date('m', strtotime($result->itinerary_code));
            $currYear = (int)date('y', strtotime($result->itinerary_code));
            $nowMonth = (int)date('m');
            $nowYear = (int)date('y');

            if ( ($currMonth < $nowMonth && $currYear == $nowYear) || ($currMonth == $nowMonth && $currYear < $nowYear) ) {
                $newNumber = '0001';
            } else {
                $newNumber = $newNumber;
            }

            $newCode = $findCode.$newNumber;
        } else {
            $newCode = $findCode.'0001';
        }

        return $newCode;
    }
}
