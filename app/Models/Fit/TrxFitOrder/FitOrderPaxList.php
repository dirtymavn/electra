<?php

namespace App\Models\Fit\TrxFitOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitOrderPaxList extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_fit_order_pax_lists';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_fit_order_id',
        'customer_id',
        'vip_status_flag',
        'surname',
        'given_name',
        'ptc',
        'title',
        'gender',
        'id_no',
        'dob',
    ];

    public function paxListTour()
    {
    	return $this->hasOne(FitOrderPaxListTour::class, 'trx_fit_order_pax_list_id');
    }
}
