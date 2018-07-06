<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Airport extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'airports';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id',
        'airport_name',
        'airport_code_icao',
        'airport_code_iata',
        'status',
        'company_id',
        'branch_id',
        'is_draft'
    ];

    /**
     * Get the city for the airport.
     */
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
