<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelRoomsType extends Model
{
    protected $table = 'master_hotel_rooms_type';

    protected $fillable = [
    	'room_type',
        'room_description',
        'bed_type',
        'id_hotel',
        'branch_id',
        'company_id'
    ];
}
