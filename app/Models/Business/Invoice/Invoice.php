<?php

namespace App\Models\Business\Invoice;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class Invoice extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'trx_invoice';

    protected $fillable = [
        'invoice_no',
        'sales_id',
        'invoice_status',
        'invoice_date',
        'trip_date',
        'base_currency',
        'base_amt',
        'bill_currency',
        'bill_amt',
        'seattled_amt',
        'fop',
        'customer_credit_term_id',
        'company_id',
        'branch_id'
    ];

    public function InvoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class, 'trx_invoice_id', 'id');
    }

    public function InvoiceCustomer()
    {
        // return $this->belongsTo( InvoiceCustomer::class, 'id', 'trx_invoice_id' );
        return $this->hasOne(InvoiceCustomer::class, 'trx_invoice_id', 'id');
    }

    public function InvoiceRefund()
    {
        return $this->hasMany(InvoiceRefund::class, 'trx_invoice_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($Invoice) {
            $input = Request::all();
            // $input['id_hotel_allotment'] = $Invoice->id;

            $Invoicedetail = \DB::table('temporaries')->whereType('invoicedetail-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Invoicedetail) > 0) {
                foreach ($Invoicedetail as $Invoicedetailvalue) {
                    $InvoicedetailData = json_decode($Invoicedetailvalue->data);

                    $invdet = new InvoiceDetail;
                    $invdet->trx_invoice_id = $Invoice->id;
                    $invdet->product_code = $InvoicedetailData->product_code;
                    $invdet->product_code_desc = $InvoicedetailData->product_code_desc;
                    $invdet->pkg_flag = $InvoicedetailData->pkg_flag;
                    $invdet->suppress_itinerary_flag = $InvoicedetailData->suppress_itinerary_flag;
                    $invdet->qty = $InvoicedetailData->qty;
                    $invdet->sales_cur = $InvoicedetailData->sales_cur;
                    $invdet->total_sales = $InvoicedetailData->total_sales;
                    $invdet->total_cost = $InvoicedetailData->total_cost;
                    $invdet->gp_amt = $InvoicedetailData->gp_amt;
                    $invdet->gp_percentage = $InvoicedetailData->gp_percentage;
                    $invdet->pax1 = $InvoicedetailData->pax1;
                    $invdet->pax2 = $InvoicedetailData->pax2;
                    $invdet->unit_sales = $InvoicedetailData->unit_sales;
                    $invdet->unit_cost = $InvoicedetailData->unit_cost;
                    $invdet->unit_cost_tax = $InvoicedetailData->unit_cost_tax;
                    $invdet->commission_rate = $InvoicedetailData->commission_rate;
                    $invdet->commission = $InvoicedetailData->commission;
                    $invdet->discount_rate = $InvoicedetailData->discount_rate;
                    $invdet->discount = $InvoicedetailData->discount;
                    $invdet->rebate_rate = $InvoicedetailData->rebate_rate;
                    $invdet->rebate = $InvoicedetailData->rebate;
                    $invdet->company_id = user_info('company_id');
                    $invdet->save();

                }
            }

            $Invoicerefund = \DB::table('temporaries')->whereType('invoicerefund-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Invoicerefund) > 0) {
                foreach ($Invoicerefund as $Invoicerefundvalue) {
                    $InvoicerefundData = json_decode($Invoicerefundvalue->data);

                    $invref = new InvoiceRefund;
                    $invref->trx_invoice_id = $Invoice->id;
                    $invref->ticket_no = $InvoicerefundData->ticket_no;
                    $invref->company_id = user_info('company_id');
                    $invref->save();

                }
            }


            // Save Trx InvoiceCustomer 
            $invcus = new InvoiceCustomer();
            $invcus->trx_invoice_id = $Invoice->id;
            $invcus->customer_id = $input['customer_id'];
            $invcus->customer_no = $input['customer_no'];
            $invcus->customer_name = $input['customer_name'];
            $invcus->customer_address = $input['customer_address'];
            $invcus->customer_attention = $input['customer_attention'];
            $invcus->customer_gname = $input['customer_gname'];
            $invcus->customer_title = $input['customer_title'];
            $invcus->our_ref = $input['our_ref'];
            $invcus->your_ref = $input['your_ref'];
            $invcus->sales_id = $input['sales_id'];
            $invcus->company_id = user_info('company_id');
            $invcus->save();

        });

    }
}
