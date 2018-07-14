<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;

class TrxDeliveryOrder extends Model
{
    protected $table = 'trx_delivery_orders';

    protected $fillable = [
    	'do_no',
    	'do_type_id',
    	'do_date',
    	'team_code',
    	'sender',
    	'tel_no',
    	'department_code',
    	'is_draft',
    	'company_id'
    ];
}
