<?php

namespace App\Models\Accounting\Invoice;

use Illuminate\Database\Eloquent\Model;

class TrxMiscInvoiceDetail extends Model
{
    protected $table= 'trx_accounting_misc_invoice_details';
    protected $fillable=[
        'id',
        'product_code',
        'trx_accounting_misc_invoice_id',
        'coa_id',
        'sales_id',
        'product_code',
        'description',
        'unit_cost',
        'cost_gst',
        'unit_price',
        'qty',
        'gst',
        'total_sales',
        'created_at',
        'updated_at'
    ];
}
