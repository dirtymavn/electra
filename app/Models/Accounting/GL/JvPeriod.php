<?php

namespace App\Models\Accounting\GL;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class JvPeriod extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_jv_periods';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fiscal_year',
        'period_month',
        'period_status',
        'start_date',
        'end_date',
        'report_date',
        'is_draft',
        'company_id',
        'branch_id'

    ];
}
