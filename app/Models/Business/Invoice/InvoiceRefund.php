<?php

namespace App\Models\Business\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceRefund extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_invoice_refund';

    protected $fillable = [
    	'trx_invoice_id',
	    'ticket_no',
	    'company_id',
	    'branch_id'
    ];
}
