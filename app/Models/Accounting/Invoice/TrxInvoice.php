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


    protected static function boot()
    {
        parent::boot();

        self::created(function ($Invoice) {
            $input = Request::all();
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

    public function sales(){
        return $this->belongsTo('App\Models\Business\Sales\TrxSales','sales_id','id');
    }
}
