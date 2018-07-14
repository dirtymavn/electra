<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Tour extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_tours';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tour_name',
        'tour_code',
        'depart_date',
        'return_date',
        'source_type',
        'tour_category',
        'pax_no',
        'adult',
        'child',
        'infant',
        'senior',
        'ticket_only',
        'tour_type',
        'availability',
        'company_id',
        'branch_id',
        'is_draft',
    ];
}
