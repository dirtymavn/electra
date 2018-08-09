<?php

namespace App\Models\Business\Invoice;

use Illuminate\Database\Eloquent\Model;

class InvoiceCustomer extends Model
{
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