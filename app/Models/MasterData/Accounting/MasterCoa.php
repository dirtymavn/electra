<?php

namespace App\Models\MasterData\Accounting;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MasterCoa extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	protected $table = 'master_coa';
	
    protected $fillable = [
        'company_id',
        'branch_id',
    	'acc_no_key',
    	'acc_no_interface',
    	'acc_description',
    	'sub_acc_id',
    	'acc_type',
    	'rollup_key_acc_no',
    	'acc_liquidity',
    	'rollup_detail',
    	'analysis_type',
    	'foregin_currency_only_flag',
    	'ap_ar_control_flag',
    	'tour_account_flag',
    	'fx_adjusment_flag',
    	'inter_branch_acc_flag',
    	'internal_payment_flag',
    	'is_draft'
    ];
}
