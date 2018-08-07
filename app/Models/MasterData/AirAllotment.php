<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class AirAllotment extends Model
{
    protected $table = 'master_air_allotment';

    protected $fillable = [
    	'pnr',
        'id_airport_from',
    	'id_ariport_to',
    	'id_airlines',
        'flight_number',
        'class',
        'status',
        'departure_date',
        'arrival_date',
        'allotment',
        'reserve',
        'sold',
        'available',
        'reserve_tour',
        'branch_id',
    	'company_id'
    ];
}