<?php

namespace App\Models\MasterData\Voucher;

use Illuminate\Database\Eloquent\Model;

class MasterVoucher extends Model
{
    protected $table = 'master_voucher';
    
    protected $fillable = [
        'voucher_no',
        'voucher_status',
        'voucher_date',
        'voucher_currency',
        'voucher_amt',
        'valid_from',
        'valid_to',
        'transferrable_flag',
        'internal_desc',
        'desc',
        'cust_no',
        'cust_name',
        'cust_address',
        'is_draft',
        'company_id',
        'branch_id'
    ];
}
