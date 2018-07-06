<?php

namespace App\Models\MasterData\Currency;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currency_rates';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_from_id',
        'currency_to_id',
        'rate'
    ];
}
