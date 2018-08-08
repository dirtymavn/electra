<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelAllotmentDetail extends Model
{
    protected $table = 'master_hotel_allotment_detail';

    protected $fillable = [
    	'date',
        'available_room_smooking',
        'available_room_non_smooking',
        'id_hotel_allotment',
        'branch_id',
    	'company_id'
    ];
}
