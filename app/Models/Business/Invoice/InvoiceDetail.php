<?php

namespace App\Models\Business\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_invoice_detail';

    protected $fillable = [
    	'trx_invoice_id',
	    'product_code',
	    'product_code_desc',
	    'pkg_flag',
	    'suppress_itinerary_flag',
	    'qty',
	    'sales_cur',
	    'total_sales',
	    'total_cost',
	    'gp_amt',
	    'gp_percentage',
	    'pax1',
	    'pax2',
	    'unit_sales',
	    'unit_cost',
	    'unit_cost_tax',
	    'commission_rate',
	    'commission',
	    'discount_rate',
	    'discount',
	    'rebate_rate',
	    'rebate',
	    'company_id',
	    'branch_id'
    ];
}
