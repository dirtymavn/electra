<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelProperty extends Model
{
    protected $table = 'master_hotel_property';

    protected $fillable = [
    	'room_capacity',
    	'suite_number',
    	'number_of_floors',
    	'number_of_meeting_room',
    	'max_capacity',
    	'property_type',
    	'id_hotel',
        'branch_id',
    	'company_id'
    ];
}