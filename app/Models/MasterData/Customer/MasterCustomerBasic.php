<?php

namespace App\Models\MasterData\Customer;

use Illuminate\Database\Eloquent\Model;

class MasterCustomerBasic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_basics';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'gender',
        'marital_status',
        'insurance_no',
        'country_of_birth',
        'dob',
        'security_id',
        'website',
        'nickname',
        'ic_no_1',
        'ic_no_1_country',
        'ic_no_2',
        'ic_no_2_country',
        'nationality_1',
        'nationality_2',
        'created_at',
        'updated_at'
    ];

    protected $foreign_key = 'customer_id';

    /**
     * Get the customer that owns the basic.
     */
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
    }
}
