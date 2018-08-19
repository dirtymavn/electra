<?php

namespace App\Models\Fit\Delivery;

use Illuminate\Database\Eloquent\Model;

class TrxFitDeliveryOrderCustomer extends Model
{
    protected $table = 'trx_fit_delivery_order_customers';

    protected $fillable = [
    	'trx_fit_delivery_order_id',
    	'customer_no',
    	'customer_address',
    	'tel_no',
    	'attn'
    ];
}