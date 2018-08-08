<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Country extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_name',
        'nationality',
        'iata_code',
        'country_callcode',
        'company_id',
        'branch_id',
        'is_draft'
    ];

    /**
     * Get the city for the country.
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }

    /**
     * Get the data country by company.
     */
    public static function scopeGetDataByCompany($query)
    {
        return $query->whereCompanyId(user_info('company_id'))->whereIsDraft(false);
    }

    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'countries.company_id')
            ->where('countries.is_draft', false)
            ->where('countries.company_id', user_info('company_id'));

        return $return;

    }
}
