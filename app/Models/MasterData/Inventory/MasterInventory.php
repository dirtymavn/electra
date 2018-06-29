<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MasterInventory extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'master_inventory';

    protected $fillable = [
    	'trx_sales_id',
    	'inventory_type',
    	'voucher_no',
    	'product_code',
    	'recevied_date',
    	'booked_qty',
    	'sold_qty',
    	'status',
    	'qty',
    	'guest_name',
    	'iata_no',
    	'tour_code',
    	'coupon_no',
    	'nights',
    	'rooms',
    	'is_draft',
        'company_id',
        'branch_id'
    ];


    public function trx()
    {
        return $this->belongsTo(TrxSales::class, 'trx_sales_id', 'id');
    }
}
