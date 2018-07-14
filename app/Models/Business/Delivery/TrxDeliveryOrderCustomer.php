<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;

class TrxDeliveryOrderCustomer extends Model
{
    protected $table = 'trx_delivery_order_customers';

    protected $fillable = [
    	'trx_delivery_order_id',
    	'customer_no',
    	'customer_address',
    	'tel_no',
    	'attn'
    ];
}