<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelOther extends Model
{
    protected $table = 'master_hotel_others';

    protected $fillable = [
    	'max_cancellation_days_group',
    	'max_cancellation_days_fit',
    	'minimum_stay',
    	'maximum_stay',
    	'cancellation_charge',
    	'id_hotel',
        'branch_id',
        'company_id'
    ];
}