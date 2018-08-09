<?php

namespace App\Models\Business\Invoice;

use Illuminate\Database\Eloquent\Model;

class InvoiceRefund extends Model
{
    protected $table = 'trx_invoice_refund';

    protected $fillable = [
    	'trx_invoice_id',
	    'ticket_no',
	    'company_id',
	    'branch_id'
    ];
}
