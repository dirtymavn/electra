<?php

namespace App\Models\MasterData\Currency;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Currency extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currency';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_name',
        'currency_code',
        'company_id',
        'branch_id',
        'is_draft'
    ];

    /**
     * Get the rate for the currency.
     */
    public function rates()
    {
        return $this->hasMany(CurrencyRate::class, 'currency_from_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($currency) {
        	$currencys = \DB::table('temporaries')->whereType('data-currency')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($currencys) > 0) {
                foreach ($currencys as $val) {
                    $value = json_decode($val->data);

                    $rate = new CurrencyRate;
                    $rate->currency_from_id = $currency->id;
                    $rate->currency_to_id = $currency->id;
                    $rate->rate = $value->rate;

                    $rate->save();
                }
            }
        });
    }

    /**
     * Get available currency
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'currency.company_id')
            ->where('currency.is_draft', false);
            // ->where('currency.company_id', user_info('company_id'));

        return $return;

    }
}
