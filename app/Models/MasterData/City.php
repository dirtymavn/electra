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

    public static function getDataAvailable()
    {
        return self::whereCompanyId(user_info('company_id'))
            ->whereStatus(true)
            ->whereDoesntHave('airport');
    }
}
