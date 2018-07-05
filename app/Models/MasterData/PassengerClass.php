<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PassengerClass extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'passenger_class';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'passenger_class_name',
        'passenger_class_code',
        'passenger_class_type',
        'company_id',
        'branch_id',
        'is_draft'
    ];
}
