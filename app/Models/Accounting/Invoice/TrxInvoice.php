<?php

namespace App\Models\Accounting\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\Setting\CoreForm;
use App\Models\MasterData\Branch;

use Request;

class TrxInvoice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'trx_accounting_invoices';

    protected $fillable = [
        'invoice_no',
        'sales_id',
        'invoice_status',
        'invoice_date',
        'trip_date',
        'invoice_type',
        'address',
        'description',
        'trip_date',
        'base_currency',
        'billing_currency',
        'fop_id',
        'company_id',
        'branch_id',
        'is_draft',
    ];

    public function InvoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class, 'trx_invoice_id', 'id');
    }

    public function InvoiceCustomer()
    {
        return $this->hasOne(InvoiceCustomer::class, 'trx_invoice_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function ($Invoice) {
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

    public static function getAutoNumber()
    {
        $formCode = CoreForm::getCodeBySlug('invoice');

        $findBranch = Branch::findMyBranch();
        $branchCode = '';

        if ($findBranch) {
            $branchCode = $findBranch->branch_code;
        }


        $result = self::withTrashed()
            ->selectRaw('right(invoice_no,4) as invoice_no')
            ->whereRaw('left(right(invoice_no,8),4)=to_char(now(),\'mmyy\')')
            ->orderByRaw('right(invoice_no, 4) desc')
            ->where('invoice_no', '<>', 'draft')
            ->whereCompanyId(user_info('company_id'))
            ->first();

        $nextNumber = '0001';
        if ($result) {
            $nextNumber = str_pad((intval($result->invoice_no) + 1), 4, '0', STR_PAD_LEFT);
        }

        $formatedNumber = $formCode . $branchCode . date('my') . $nextNumber;
        return $formatedNumber;
    }
}
