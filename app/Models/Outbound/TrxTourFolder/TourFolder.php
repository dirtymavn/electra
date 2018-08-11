<?php

namespace App\Models\Outbound\TrxTourFolder;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Setting\CoreForm;
use Request;

class TourFolder extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'trx_tour_folder';

    protected $fillable = [
        'tour_code',
        'tour_name',
        'departure_date',
        'return_date',
        'status',
        'direction',
        'company_id',
        'branch_id'
    ];

    public function tourfolderDetail()
    {
        return $this->hasOne(TourfolderDetail::class, 'id_tour_folder', 'id');
    }

    public function tourfolderGuide()
    {
        return $this->hasMany(TourfolderGuide::class, 'id_tour_folder', 'id');
    }

    public function tourfolderItinerary()
    {
        return $this->hasMany(TourfolderItinerary::class, 'id_tour_folder', 'id');
    }

    public function tourfolderRate()
    {
        return $this->hasMany(TourfolderRate::class, 'id_tour_folder', 'id');
    }

    public function tourfolderService()
    {
        return $this->hasMany(TourfolderService::class, 'id_tour_folder', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($Tourfolder) {
            $input = Request::all();
            // $input['id_hotel_allotment'] = $Tourfolder->id;

            $Tourfolderservice = \DB::table('temporaries')->whereType('tourfolderservice-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Tourfolderservice) > 0) {
                foreach ($Tourfolderservice as $Tourfolderservicevalue) {
                    $TourfolderserviceData = json_decode($Tourfolderservicevalue->data);

                    $tourservice = new TourfolderService;
                    $tourservice->id_tour_folder = $Tourfolder->id;
                    $tourservice->id_product = $TourfolderserviceData->id_product;
                    $tourservice->service_type = $TourfolderserviceData->service_type;
                    $tourservice->charge_method = $TourfolderserviceData->charge_method;
                    $tourservice->id_currency = $TourfolderserviceData->id_currency;
                    $tourservice->id_supplier = $TourfolderserviceData->id_supplier;
                    $tourservice->notes = $TourfolderserviceData->notes;
                    $tourservice->company_id = user_info('company_id');
                    $tourservice->save();
                }
            }

            $Tourfolderrate = \DB::table('temporaries')->whereType('tourfolderrate-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Tourfolderrate) > 0) {
                foreach ($Tourfolderrate as $Tourfolderratevalue) {
                    $TourfolderrateData = json_decode($Tourfolderratevalue->data);

                    $tourrate = new TourfolderRate;
                    $tourrate->id_tour_folder = $Tourfolder->id;
                    $tourrate->customer_type = $TourfolderrateData->customer_type;
                    $tourrate->price_type = $TourfolderrateData->price_type;
                    $tourrate->group_size = $TourfolderrateData->group_size;
                    $tourrate->price = $TourfolderrateData->price;
                    $tourrate->discount = $TourfolderrateData->discount;
                    $tourrate->company_id = user_info('company_id');
                    $tourrate->save();
                }
            }

            $Tourfolderitinerary = \DB::table('temporaries')->whereType('tourfolderitinerary-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Tourfolderitinerary) > 0) {
                foreach ($Tourfolderitinerary as $Tourfolderitineraryvalue) {
                    $TourfolderitineraryData = json_decode($Tourfolderitineraryvalue->data);

                    $touritinerary = new TourfolderItinerary;
                    $touritinerary->id_tour_folder = $Tourfolder->id;
                    $touritinerary->day = $TourfolderitineraryData->day;
                    $touritinerary->itinerary_code = $TourfolderitineraryData->itinerary_code;
                    $touritinerary->city = $TourfolderitineraryData->city;
                    $touritinerary->description = $TourfolderitineraryData->description;
                    $touritinerary->operator = $TourfolderitineraryData->operator;
                    $touritinerary->breakfast = $TourfolderitineraryData->breakfast;
                    $touritinerary->lunch = $TourfolderitineraryData->lunch;
                    $touritinerary->dinner = $TourfolderitineraryData->dinner;
                    $touritinerary->accomodation = $TourfolderitineraryData->accomodation;
                    $touritinerary->notes = $TourfolderitineraryData->notes;
                    $touritinerary->transport_detail = $TourfolderitineraryData->transport_detail;
                    $touritinerary->company_id = user_info('company_id');
                    $touritinerary->save();
                }
            }

            $Tourfolderguide = \DB::table('temporaries')->whereType('tourfolderguide-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Tourfolderguide) > 0) {
                foreach ($Tourfolderguide as $Tourfolderguidevalue) {
                    $TourfolderguideData = json_decode($Tourfolderguidevalue->data);

                    $tourguide = new TourfolderGuide;
                    $tourguide->id_tour_folder = $Tourfolder->id;
                    $tourguide->from_date = $TourfolderguideData->from_date;
                    $tourguide->to_date = $TourfolderguideData->to_date;
                    $tourguide->guide_number = $TourfolderguideData->guide_number;
                    $tourguide->title = $TourfolderguideData->title;
                    $tourguide->name = $TourfolderguideData->name;
                    $tourguide->notes = $TourfolderguideData->notes;
                    $tourguide->cash_advance = $TourfolderguideData->cash_advance;
                    $tourguide->cash_return = $TourfolderguideData->cash_return;
                    $tourguide->company_id = user_info('company_id');
                    $tourguide->save();
                }
            }


            // Save Trx Tourfolderdetail
            $tourdet = new TourfolderDetail();
            $tourdet->id_tour_folder = $Tourfolder->id;
            $tourdet->tour_category = $input['tour_category'];
            $tourdet->tour_type = $input['tour_type'];
            $tourdet->id_airlines = $input['id_airlines'];
            $tourdet->description = $input['description'];
            $tourdet->min_capacity = $input['min_capacity'];
            $tourdet->max_capacity = $input['max_capacity'];
            $tourdet->number_of_days = $input['number_of_days'];
            $tourdet->cut_of_date = $input['cut_of_date'];
            $tourdet->ticket_dateline = $input['ticket_dateline'];
            $tourdet->deposit_dateline = $input['deposit_dateline'];
            $tourdet->id_currency = $input['id_currency'];
            $tourdet->origin = $input['origin'];
            $tourdet->company_id = user_info('company_id');
            $tourdet->save();

        });

    }

    public static function getAutoNumber()
    {
        $result = self::whereCompanyId(user_info('company_id'))
            ->where('tour_code', '<>', 'draft')
            ->orderBy('id', 'desc')->first();

        $findCode = CoreForm::getCodeBySlug('tourcode');
        if ($result) {
            $lastNumber = (int) substr($result->supplier_no, strlen($result->supplier_no) - 4, 4);
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

            $currMonth = (int)date('m', strtotime($result->supplier_no));
            $currYear = (int)date('y', strtotime($result->supplier_no));
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
