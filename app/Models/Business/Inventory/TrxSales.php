<?php

namespace App\Models\Business\Inventory;

use Illuminate\Database\Eloquent\Model;

class TrxSales extends Model
{
    protected $table = 'trx_sales';

    protected $fillable = [
    	'invoice_no',
    	'sales_date',
    	'ticket_amt',
    	'rebate'
    ];
}
