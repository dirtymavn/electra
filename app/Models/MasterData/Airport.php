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

    /**
     * Get available city
     *
     * @return array
     */
    public static function getDataAvailable()
    {
        $return = self::join('companies', 'companies.id', '=', 'airports.company_id')
            ->join('cities', 'cities.id', '=', 'airports.city_id')
            ->where('airports.is_draft', false)
            ->where('airports.status', true)
            ->where('airports.company_id', user_info('company_id'));

        return $return;

    }
}
