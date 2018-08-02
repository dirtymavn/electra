<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'master_credit_card';

    protected $fillable = [
    	'number',
        'expire_date',
    	'name',
    	'address',
        'state',
        'city',
        'zipcode',
        'cvv',
        'branch_id',
    	'company_id'
    ];
}