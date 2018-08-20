<?php

namespace App\Models\Fit\TrxFitOrder;

use Illuminate\Database\Eloquent\Model;

class FitOrderTour extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_fit_order_tours';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_tour_id',
        'trx_fit_order_id',
        'tour_name',
        'tour_code',
        'depart_date',
        'return_date',
        'days',
        'source_type',
        'tour_category',
        'pax_no',
        'adult',
        'child',
        'infant',
        'senior',
        'ticket_only',
        'tour_type',
    ];
}
