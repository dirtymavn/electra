<?php

namespace App\Models\MasterData\ProductCode;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductCode extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_codes';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_code',
        'product_name',
        'product_description',
        'status',
        'company_id',
        'branch_id',
        'is_draft'
    ];

    /**
     * Get the type for the code.
     */
    public function types()
    {
        return $this->hasMany(ProductCodeType::class, 'product_code_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($productcode) {
        	$productcodes = \DB::table('temporaries')->whereType('data-productcode')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($productcodes) > 0) {
                foreach ($productcodes as $val) {
                    $value = json_decode($val->data);

                    $type = new ProductCodeType;
                    $type->product_code_id = $productcode->id;
			        $type->code_type = $value->code_type;
			        $type->commission_based = $value->commission_based;
			        $type->inventory_control = $value->inventory_control;
			        $type->package_product = $value->package_product;
			        $type->is_domestic = $value->is_domestic;
			        $type->no_profit_approval = $value->no_profit_approval;
			        $type->trx_fee = $value->trx_fee;
			        $type->misc_invoice = $value->misc_invoice;
			        $type->hotel_conf_advice = $value->hotel_conf_advice;
			        $type->gst_compulsory = $value->gst_compulsory;
			        $type->profit_markup = $value->profit_markup;
			        $type->profit_markup_amt = $value->profit_markup_amt;

                    $type->save();
                }
            }
        });
    }
}
