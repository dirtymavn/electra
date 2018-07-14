<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Airline extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'airlines';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'airline_name',
        'airline_code',
        'airline_class',
        'status',
        'company_id',
        'branch_id',
        'is_draft'
    ];

    /**
     * Get available airline
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'airlines.company_id')
            ->where('airlines.is_draft', false)
            ->where('airlines.status', true);

        if (user_info()->inRole('admin')) {
            $return = $return->where('airlines.company_id', user_info('company_id'));
        }

        return $return;

    }

    /**
     * Get the orderSelling for the airline.
     */
    public function orderSellings()
    {
        return $this->hasMany('App\Models\Outbound\TrxTourOrder\TourOrderPaxListTourSelling', 'airline_id');
    }
}
