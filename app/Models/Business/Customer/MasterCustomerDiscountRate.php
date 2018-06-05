<?php

namespace App\Models\Business\Customer;

use Illuminate\Database\Eloquent\Model;

class MasterCustomerDiscountRate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_discount_rates';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'product_code',
        'discount_percentage',
        'remark',

    ];

    /**
     * Get the customer that owns the basic.
     */
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
    }
}
