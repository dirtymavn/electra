<?php

namespace App\Models\Accounting\GL\TrxPosting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxPostingDetail extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	protected $table = 'trx_posting_detail';

    protected $fillable = [
    	'trx_posting_id',
    	'transaction_subject',
    	'transaction_type',
    	'in_qty',
    	'in_price',
    	'in_total',
    	'out_qty',
    	'out_price',
    	'out_total',
    	'result_qty',
    	'result_avg',
    	'result_total'
    ];
}
