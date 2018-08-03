<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelContact extends Model
{
    protected $table = 'master_hotel_contact';

    protected $fillable = [
    	'title',
        'name',
        'phone',
        'fax',
        'email',
        'id_hotel',
        'branch_id',
    	'company_id'
    ];
}
