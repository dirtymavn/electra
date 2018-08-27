<?php

namespace App\Models\Business\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceCustomer extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_invoice_customer';

    protected $fillable = [
    	'trx_invoice_id',
		'customer_id',
		'customer_no',
		'customer_name',
		'customer_address',
		'customer_attention',
		'customer_gname',
		'customer_title',
		'our_ref',
		'your_ref',
		'sales_id',
		'company_id',
		'branch_id'
    ];
}