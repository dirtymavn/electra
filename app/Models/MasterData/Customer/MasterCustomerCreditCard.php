<?php

namespace App\Models\MasterData\Customer;

use Illuminate\Database\Eloquent\Model;

class MasterCustomerCreditCard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_credit_cards';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'card_type',
        'merchant_no',
        'merchant_no_int',
        'credit_card_no',
        'expiry_date',
        'cardholder_name',
        'bill_type',
        'preferred_card',
        'sof',
        'remark',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the customer that owns the basic.
     */
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
    }
}
