<?php

namespace App\Models\Accounting\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\Setting\CoreForm;
use App\Models\MasterData\Branch;
use App\Models\Accounting\Invoice\TrxMiscInvoiceDetail;
use Request;

class TrxMiscInvoice extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'trx_accounting_misc_invoices';

    protected $fillable = [
        'invoice_no',
        'sales_id',
        'invoice_status',
        'invoice_date',
        'misc_invoice_type',
        'customer_id',
        'sales_id',
        'base_currency',
        'billing_currency',
        'company_id',
        'branch_id',
        'is_draft',
        'tc_id'
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

        self::created(function ($invoice) {
            $input = Request::all();
            $tempData = \DB::table('temporaries')->whereType('misc-invoice-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($tempData) > 0) {
                foreach ($tempData as $tempDataValue) {
                    $invoiceDetail = json_decode($tempDataValue->data,true);
                    $invoiceDetail['trx_accounting_misc_invoice_id'] = $invoice->id;
                    TrxMiscInvoiceDetail::create($invoiceDetail);
                }
            }           
        });

    }
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
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
