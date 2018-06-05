<?php

namespace App\Models\Business\Customer;

use Illuminate\Database\Eloquent\Model;

class MasterCustomerTermFee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_termfees';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'credit_limit',
        'share_credit_code',
        'addon_credit_limit',
        'addon_from_date',
        'addon_to_date',
        'credit_term_type',
        'invoce_delivery_method',
        'recall_commission_method',
        'rebate_method',
        'rebate_amount_type_id',

    ];

    /**
     * Get the customer that owns the basic.
     */
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
    }
}
