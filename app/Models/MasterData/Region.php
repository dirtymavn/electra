<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Region extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regions';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_name',
        'region_code',
        'region_description',
        'status',
        'company_id',
        'branch_id',
        'is_draft'
    ];
}
