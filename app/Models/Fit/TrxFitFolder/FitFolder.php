<?php

namespace App\Models\Fit\TrxFitFolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Setting\CoreForm;
use Request;

class FitFolder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'trx_fit_folder';

    protected $fillable = [
        'fit_code',
        'fit_name',
        'departure_date',
        'return_date',
        'status',
        'direction',
        'company_id',
        'branch_id'
    ];

    public function fitfolderDetail()
    {
        return $this->hasOne(FitfolderDetail::class, 'id_fit_folder', 'id');
    }

    public function fitfolderGuide()
    {
        return $this->hasMany(FitfolderGuide::class, 'id_fit_folder', 'id');
    }

    public function fitfolderItinerary()
    {
        return $this->hasMany(FitfolderItinerary::class, 'id_fit_folder', 'id');
    }

    public function fitfolderRate()
    {
        return $this->hasMany(FitfolderRate::class, 'id_fit_folder', 'id');
    }

    public function fitfolderService()
    {
        return $this->hasMany(FitfolderService::class, 'id_fit_folder', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($Fitfolder) {
            $input = Request::all();
            // $input['id_hotel_allotment'] = $Fitfolder->id;

            $Fitfolderservice = \DB::table('temporaries')->whereType('fitfolderservice-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Fitfolderservice) > 0) {
                foreach ($Fitfolderservice as $Fitfolderservicevalue) {
                    $FitfolderserviceData = json_decode($Fitfolderservicevalue->data);

                    $fitservice = new FitfolderService;
                    $fitservice->id_fit_folder = $Fitfolder->id;
                    $fitservice->id_product = $FitfolderserviceData->id_product;
                    $fitservice->service_type = $FitfolderserviceData->service_type;
                    $fitservice->charge_method = $FitfolderserviceData->charge_method;
                    $fitservice->id_currency = $FitfolderserviceData->id_currency;
                    $fitservice->id_supplier = $FitfolderserviceData->id_supplier;
                    $fitservice->notes = $FitfolderserviceData->notes;
                    $fitservice->company_id = user_info('company_id');
                    $fitservice->save();
                }
            }

            $Fitfolderrate = \DB::table('temporaries')->whereType('fitfolderrate-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Fitfolderrate) > 0) {
                foreach ($Fitfolderrate as $Fitfolderratevalue) {
                    $FitfolderrateData = json_decode($Fitfolderratevalue->data);

                    $fitrate = new FitfolderRate;
                    $fitrate->id_fit_folder = $Fitfolder->id;
                    $fitrate->customer_type = $FitfolderrateData->customer_type;
                    $fitrate->price_type = $FitfolderrateData->price_type;
                    $fitrate->group_size = $FitfolderrateData->group_size;
                    $fitrate->price = $FitfolderrateData->price;
                    $fitrate->discount = $FitfolderrateData->discount;
                    $fitrate->company_id = user_info('company_id');
                    $fitrate->save();
                }
            }

            $Fitfolderitinerary = \DB::table('temporaries')->whereType('fitfolderitinerary-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Fitfolderitinerary) > 0) {
                foreach ($Fitfolderitinerary as $Fitfolderitineraryvalue) {
                    $FitfolderitineraryData = json_decode($Fitfolderitineraryvalue->data);

                    $fititinerary = new FitfolderItinerary;
                    $fititinerary->id_fit_folder = $Fitfolder->id;
                    $fititinerary->day = $FitfolderitineraryData->day;
                    $fititinerary->itinerary_code = $FitfolderitineraryData->itinerary_code;
                    $fititinerary->city = $FitfolderitineraryData->city;
                    $fititinerary->description = $FitfolderitineraryData->description;
                    $fititinerary->operator = $FitfolderitineraryData->operator;
                    $fititinerary->breakfast = $FitfolderitineraryData->breakfast;
                    $fititinerary->lunch = $FitfolderitineraryData->lunch;
                    $fititinerary->dinner = $FitfolderitineraryData->dinner;
                    $fititinerary->accomodation = $FitfolderitineraryData->accomodation;
                    $fititinerary->notes = $FitfolderitineraryData->notes;
                    $fititinerary->transport_detail = $FitfolderitineraryData->transport_detail;
                    $fititinerary->company_id = user_info('company_id');
                    $fititinerary->save();
                }
            }

            $Fitfolderguide = \DB::table('temporaries')->whereType('fitfolderguide-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Fitfolderguide) > 0) {
                foreach ($Fitfolderguide as $Fitfolderguidevalue) {
                    $FitfolderguideData = json_decode($Fitfolderguidevalue->data);

                    $fitguide = new FitfolderGuide;
                    $fitguide->id_fit_folder = $Fitfolder->id;
                    $fitguide->from_date = $FitfolderguideData->from_date;
                    $fitguide->to_date = $FitfolderguideData->to_date;
                    $fitguide->guide_number = $FitfolderguideData->guide_number;
                    $fitguide->title = $FitfolderguideData->title;
                    $fitguide->name = $FitfolderguideData->name;
                    $fitguide->notes = $FitfolderguideData->notes;
                    $fitguide->cash_advance = $FitfolderguideData->cash_advance;
                    $fitguide->cash_return = $FitfolderguideData->cash_return;
                    $fitguide->company_id = user_info('company_id');
                    $fitguide->save();
                }
            }


            // Save Trx Fitfolderdetail
            $fitdet = new FitfolderDetail();
            $fitdet->id_fit_folder = $Fitfolder->id;
            $fitdet->tour_category = $input['tour_category'];
            $fitdet->tour_type = $input['tour_type'];
            $fitdet->id_airlines = $input['id_airlines'];
            $fitdet->description = $input['description'];
            $fitdet->min_capacity = $input['min_capacity'];
            $fitdet->max_capacity = $input['max_capacity'];
            $fitdet->number_of_days = $input['number_of_days'];
            $fitdet->cut_of_date = $input['cut_of_date'];
            $fitdet->ticket_dateline = $input['ticket_dateline'];
            $fitdet->deposit_dateline = $input['deposit_dateline'];
            $fitdet->id_currency = $input['id_currency'];
            $fitdet->origin = $input['origin'];
            $fitdet->company_id = user_info('company_id');
            $fitdet->save();

        });

    }

    public static function getAutoNumber()
    {
        $result = self::whereCompanyId(user_info('company_id'))
            ->where('fit_code', '<>', 'draft')
            ->orderBy('id', 'desc')->first();
        $findCode = CoreForm::getCodeBySlug('fit-folder');
        if ($result) {
            $lastNumber = (int) substr($result->fit_code, strlen($result->fit_code) - 4, 4);
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

            $currMonth = (int)date('m', strtotime($result->fit_code));
            $currYear = (int)date('y', strtotime($result->fit_code));
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

    public static function getAvailableData()
    {
        return self::where('company_id', user_info()->company_id);
    }
}
