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
}
