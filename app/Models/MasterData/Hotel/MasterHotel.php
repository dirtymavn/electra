<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class MasterHotel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'master_hotel';

    protected $fillable = [
    	'name',
    	'address',
        'id_city',
        'id_country',
        'id_hotel_chain',
        'phone',
        'phone_2',
        'email',
        'fax',
        'fax_2',
        'branch_id',
    	'company_id'
    ];

    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_hotel.company_id')
            ->where('master_hotel.company_id', user_info('company_id'));

        return $return;

    }

    public function hotelContact()
    {
        return $this->hasMany(MasterHotelContact::class, 'id_hotel', 'id');
    }

    public function hotelProperty()
    {
        return $this->hasOne( MasterHotelProperty::class, 'id_hotel', 'id');
    }

    public function hotelOther()
    {
        return $this->hasOne( MasterHotelOther::class );
    }

    public function hotelService()
    {
        return $this->hasMany(MasterHotelService::class, 'id_hotel', 'id');
    }

    public function hotelRoomsType()
    {
        return $this->hasOne( MasterHotelRoomsType::class );
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($masterhotel) {
            $input = Request::all();
            $input['id_hotel'] = $masterhotel->id;
            
            $hotelcontact = \DB::table('temporaries')->whereType('hotel-contact-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($hotelcontact) > 0) {
                foreach ($hotelcontact as $hotelcontactvalue) {
                    $hotelcontactData = json_decode($hotelcontactvalue->data);

                    $hc = new MasterHotelContact;
                    $hc->id_hotel = $masterhotel->id;
                    $hc->title = $hotelcontactData->title;
                    $hc->name = $hotelcontactData->name;
                    $hc->phone = $hotelcontactData->phone;
                    $hc->fax = $hotelcontactData->fax;
                    $hc->email = $hotelcontactData->email;
                    $hc->company_id = user_info('company_id');
                    $hc->save();
                }
            }

            $hp = new MasterHotelProperty;
            $hp->id_hotel = $masterhotel->id;
            $hp->room_capacity = $input['room_capacity'];
            $hp->suite_number = $input['suite_number'];
            $hp->number_of_floors = $input['number_of_floors'];
            $hp->non_smooking_room = $input['non_smooking_room'];
            $hp->number_of_meeting_room = $input['number_of_meeting_room'];
            $hp->max_capacity = $input['max_capacity'];
            $hp->property_type = $input['property_type'];
            $hp->company_id = user_info('company_id');
            $hp->save();


            $ho = new MasterHotelOther;
            $ho->id_hotel = $masterhotel->id;
            $ho->max_cancellation_days_group = $input['max_cancellation_days_group'];
            $ho->max_cancellation_days_fit = $input['max_cancellation_days_fit'];
            $ho->minimum_stay = $input['minimum_stay'];
            $ho->maximum_stay = $input['maximum_stay'];
            $ho->cancellation_charge = $input['cancellation_charge'];
            $ho->company_id = user_info('company_id');
            $ho->save();


            $hotelservice = \DB::table('temporaries')->whereType('hotel-service-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($hotelservice) > 0) {
                foreach ($hotelservice as $hotelservicevalue) {
                    $hotelserviceData = json_decode($hotelservicevalue->data);

                    $hs = new MasterHotelService;
                    $hs->id_hotel = $masterhotel->id;
                    $hs->service_name = $hotelserviceData->service_name;
                    $hs->service_desciption = $hotelserviceData->service_desciption;
                    $hs->cost = $hotelserviceData->cost;
                    $hs->sales = $hotelserviceData->sales;
                    $hs->start_date = $hotelserviceData->start_date;
                    $hs->end_date = $hotelserviceData->end_date;
                    $hs->season = $hotelserviceData->season;
                    $hs->is_free = $hotelserviceData->is_free;
                    $hs->company_id = user_info('company_id');
                    $hs->save();
                }
            }

            $hrt = new MasterHotelRoomsType;
            $hrt->id_hotel = $masterhotel->id;
            $hrt->room_type = $input['room_type'];
            $hrt->room_description = $input['room_description'];
            $hrt->bed_type = $input['bed_type'];
            $hrt->company_id = user_info('company_id');
            $hrt->save();

        });

    }
}
