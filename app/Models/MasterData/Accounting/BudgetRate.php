<?php

namespace App\Models\MasterData\Accounting;

use Illuminate\Database\Eloquent\Model;

class BudgetRate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'budget_rates';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'acc_period_mo',
        'from_currency',
        'to_currency',
        'exchange_rate',
        'is_draft',

    ];
}
