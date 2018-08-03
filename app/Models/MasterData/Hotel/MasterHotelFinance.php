<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class MasterHotelFinance extends Model
{
    protected $table = 'master_hotel_finance';

    protected $fillable = [
    	'deposit_type',
    	'payment_type',
    	'credit_limit',
    	'id_credit_limit_currency',
    	'credit_terms',
    	'bank_name_1',
        'bank_account_1',
        'currency_1',
        'bank_name_2',
        'bank_account_2',
        'currency_2',
    	'id_hotel',
        'branch_id',
        'company_id'
    ];
}