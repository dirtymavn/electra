<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSales extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];
	
    protected $table = 'trx_sales';

    protected $fillable = [
    	'invoice_no',
    	'sales_date',
    	'ticket_amt',
    	'rebate'
    ];
}
