<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class HotelAllotment extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'master_hotel_allotment';

    protected $fillable = [
        'address_info',
        'name_info',
        'all_contact_person_info',
    	'id_hotel',
        'branch_id',
    	'company_id'
    ];

    public function hotelAllotmentDetail()
    {
        return $this->hasMany(MasterHotelAllotmentDetail::class, 'id_hotel_allotment', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($HotelAllotment) {
            $input = Request::all();
            // $input['id_hotel_allotment'] = $HotelAllotment->id;

            $hotelallotmentdetail = \DB::table('temporaries')->whereType('hotel-allotmentdetail-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($hotelallotmentdetail) > 0) {
                foreach ($hotelallotmentdetail as $hotelallotmentdetailvalue) {
                    $hotelallotmentdetailData = json_decode($hotelallotmentdetailvalue->data);

                    $had = new MasterHotelAllotmentDetail;
                    $had->id_hotel_allotment = $HotelAllotment->id;
                    $had->date = $hotelallotmentdetailData->date;
                    $had->available_room_smooking = $hotelallotmentdetailData->available_room_smooking;
                    $had->available_room_non_smooking = $hotelallotmentdetailData->available_room_non_smooking;
                    $had->company_id = user_info('company_id');
                    $had->save();
                }
            }

        });

    }
}
