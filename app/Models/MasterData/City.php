<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class City extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'city_name',
        'city_code',
        'status',
        'company_id',
        'branch_id',
        'is_draft'
    ];

    /**
     * Get the airport for the city.
     */
    public function airport()
    {
        return $this->hasOne(Airport::class, 'city_id');
    }

    /**
     * Get the country for the city.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function getDataAvailable()
    {
        return self::whereCompanyId(user_info('company_id'))
            ->whereStatus(true)
            ->whereIsDraft(false)
            ->whereDoesntHave('airport');
    }

    /**
     * Get available city
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'cities.company_id')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('cities.is_draft', false)
            ->where('cities.status', true)
            ->where('cities.company_id', user_info('company_id'));

        return $return;

    }
}
