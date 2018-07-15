<?php

namespace App\Models\MasterData\ProductCode;

use Illuminate\Database\Eloquent\Model;

class ProductCodeType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_code_types';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_code_id',
        'code_type',
        'commission_based',
        'inventory_control',
        'package_product',
        'is_domestic',
        'no_profit_approval',
        'trx_fee',
        'misc_invoice',
        'hotel_conf_advice',
        'gst_compulsory',
        'profit_markup',
        'profit_markup_amt',
    ];
}
