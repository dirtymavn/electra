<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Setting\CoreForm;
use Request;

class HotelBooking extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'trx_hotel_booking';

    protected $fillable = [
    	'id_hotel',
        'is_group',
        'tour_code',
        'id_customer',
        'deal_company',
        'contact',
        'phone',
        'fax',
        'rate',
        'check_in',
        'check_out',
        'booking_status',
        'arrival_detail',
        'company_id',
        'branch_id'
    ];

    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_hotel_chain.company_id')
            ->where('master_hotel_chain.company_id', user_info('company_id'));

        return $return;

    }

    public static function getAutoNumber()
    {
        $result = self::whereCompanyId(user_info('company_id'))
            ->where('booking_number', '<>', 'draft')
            ->orderBy('id', 'desc')->first();

        $findCode = CoreForm::getCodeBySlug('hotel_booking');
        if ($result) {
            $lastNumber = (int) substr($result->lg_no, strlen($result->lg_no) - 4, 4);
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

            $currMonth = (int)date('m', strtotime($result->lg_no));
            $currYear = (int)date('y', strtotime($result->lg_no));
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


    public function hotelbookingRemark()
    {
        return $this->hasOne(HotelBookingRemark::class, 'id_hotel_booking', 'id');
    }

    public function hotelbookingDetail()
    {
        return $this->hasMany(HotelBookingDetail::class, 'id_hotel_booking', 'id');
    }

    public function hotelbookingPax()
    {
        return $this->hasMany(HotelBookingPax::class, 'id_hotel_booking', 'id');
    }

    public function hotelbookingService()
    {
        return $this->hasMany(HotelBookingService::class, 'id_hotel_booking', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($Hotelbooking) {
            $input = Request::all();
            // $input['id_hotel_allotment'] = $Hotelbooking->id;
            
            // Save Trx hotel booking detail
            $bookremark = new HotelBookingRemark();
            $bookremark->id_hotel_booking = $Hotelbooking->id;
            $bookremark->remark = $input['remark'];
            $bookremark->internal_notes = $input['internal_notes'];
            $bookremark->accounting_notes = $input['accounting_notes'];
            $bookremark->cancel_notice = $input['cancel_notice'];
            $bookremark->reference_number = $input['reference_number'];
            $bookremark->tnr_number = $input['tnr_number'];
            $bookremark->company_id = user_info('company_id');
            $bookremark->save();


            $Hotelbookingdetail = \DB::table('temporaries')->whereType('hotelbookingdetail-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Hotelbookingdetail) > 0) {
                foreach ($Hotelbookingdetail as $Hotelbookingdetailvalue) {
                    $bookingdetailData = json_decode($Hotelbookingdetailvalue->data);

                    $bookdetail = new HotelBookingDetail;
                    $bookdetail->id_hotel_booking = $Hotelbooking->id;
                    $bookdetail->id_room_type = $bookingdetailData->id_room_type;
                    $bookdetail->id_room_category = $bookingdetailData->id_room_category;
                    $bookdetail->room_number = $bookingdetailData->room_number;
                    $bookdetail->night = $bookingdetailData->night;
                    $bookdetail->price_per_night = $bookingdetailData->price_per_night;
                    $bookdetail->include_breakfast = $bookingdetailData->include_breakfast;
                    $bookdetail->non_smooking = $bookingdetailData->non_smooking;
                    $bookdetail->high_floor = $bookingdetailData->high_floor;
                    $bookdetail->company_id = user_info('company_id');
                    $bookdetail->save();

                }
            }

            $Hotelbookingpax = \DB::table('temporaries')->whereType('hotelbookingpax-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Hotelbookingpax) > 0) {
                foreach ($Hotelbookingpax as $Hotelbookingpaxvalue) {
                    $bookingpaxData = json_decode($Hotelbookingpaxvalue->data);

                    $bookpax = new HotelBookingPax;
                    $bookpax->id_hotel_booking = $Hotelbooking->id;
                    $bookpax->title = $bookingpaxData->title;
                    $bookpax->pax_name = $bookingpaxData->pax_name;
                    $bookpax->type = $bookingpaxData->type;
                    $bookpax->id_nationality = $bookingpaxData->id_nationality;
                    $bookpax->company_id = user_info('company_id');
                    $bookpax->save();

                }
            }

            $Hotelbookingservice = \DB::table('temporaries')->whereType('hotelbookingservice-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Hotelbookingservice) > 0) {
                foreach ($Hotelbookingservice as $Hotelbookingservicevalue) {
                    $bookingserviceData = json_decode($Hotelbookingservicevalue->data);

                    $bookservice = new HotelBookingService;
                    $bookservice->id_hotel_booking = $Hotelbooking->id;
                    $bookservice->id_hotel_service = $bookingserviceData->id_hotel_service;
                    $bookservice->service_code = $bookingserviceData->service_code;
                    $bookservice->service_description = $bookingserviceData->service_description;
                    $bookservice->quantity = $bookingserviceData->quantity;
                    $bookservice->quantity_order = $bookingserviceData->quantity_order;
                    $bookservice->order_date = $bookingserviceData->order_date;
                    $bookservice->total_sales = $bookingserviceData->total_sales;
                    $bookservice->company_id = user_info('company_id');
                    $bookservice->save();

                }
            }




        });

    }
}
