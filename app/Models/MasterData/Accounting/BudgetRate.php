<?php

namespace App\Models\MasterData\Accounting;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BudgetRate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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
        'company_id',
        'branch_id'

    ];
}
