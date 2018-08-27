<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourOrderTour extends Model
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
    protected $table = 'trx_tour_order_tours';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_tour_id',
        'trx_tour_order_id',
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
