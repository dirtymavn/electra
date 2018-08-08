<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelService extends Model
{
    protected $table = 'master_hotel_service';

    protected $fillable = [
    	'service_name',
        'service_desciption',
        'cost',
        'sales',
        'start_date',
        'end_date',
        'season',
        'is_free',
        'id_hotel',
        'branch_id',
    	'company_id'
    ];
}
