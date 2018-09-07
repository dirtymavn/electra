<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Accounting\InvoiceDataTable;
use App\Http\Requests\Business\InvoiceRequest;
use App\Models\Business\Country;
use App\Models\Accounting\Invoice\TrxInvoice as Invoice;
use App\Models\Temporary;
use App\Models\Business\Sales\TrxSales as Sales;
use App\Models\Business\Sales\TrxSalesDetail as SalesDetail;
use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\MasterData\Currency\Currency;
use App\Models\Business\Invoice\InvoiceDetail;
use App\Models\Business\Invoice\InvoiceRefund;

use DB;
use Excel;
use PDF;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,lg.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,lg.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,lg.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,lg.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceDataTable $dataTable)
    {
        // return Invoice::with('sales.customer')->get();
        return $dataTable->render('contents.accountings.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $invoiceNo= Invoice::getAutoNumber();
        $invoiceType= $this->invoiceType();
        $fop= $this->ddFop();
        $currentDate= date('d/m/Y');
        $currency= Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_name')->all();
        $listSales = Sales::getAvailableData()->pluck('trx_sales.sales_no', 'trx_sales.id')->all();
        return view('contents.accountings.invoice.create', compact('listSales','invoiceNo','currentDate','invoiceType','fop','currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\InvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
            $invoice=$request->all();
            $invoice['invoice_date']= date('Y-m-d',strtotime($invoice['invoice_date']));
            $invoice['trip_date']= date('Y-m-d', strtotime($invoice['trip_date']));
            $insert = Invoice::create($invoice);
            if ($insert) {
                $redirect = redirect()->route('accounting.invoice.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('accounting.invoice.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('accounting.invoice.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e->getMessage());
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Invoice  $Invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $Invoice)
    {
        //
    }


    public function edit(Invoice $invoice)
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $invoiceNo = $invoice->invoice_no;
        $invoiceType = $this->invoiceType();
        $fop = $this->ddFop();
        $currentDate = $invoice->invoice_Date;
        $listSales = Sales::getAvailableData()->pluck('trx_sales.sales_no', 'trx_sales.id')->all();
        $currency = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_name')->all();
        return view('contents.accountings.invoice.edit', compact('invoice', 'listSales', 'invoiceNo', 'currentDate', 'invoiceType', 'fop', 'currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\InvoiceRequest  $request
     * @param  \App\Models\MasterData\Invoice  $Invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {

        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('accounting.invoice.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('accounting.invoice.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('accounting.invoice.edit', $invoice->id);
            }

            $update = $invoice->update($request->all());

            if ($update) {
                flash()->success($msgSuccess);
                \DB::commit();
                $redirect = redirect()->route('accounting.invoice.index');
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Invoice  $Invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::destroy($id);
        flash()->success(trans('message.delete.success'));

        return redirect()->route('accounting.invoice.index');
    }

    /**
     * Remove the many resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        if (count($ids) > 0) {
            Invoice::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('accounting.invoice.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = Invoice::select('*')->get();
        \Excel::create('testing-' . date('Ymd'), function ($excel) use ($type) {
            $excel->sheet('Sheet 1', function ($sheet) use ($type) {
                $sheet->fromArray($type);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $types = Invoice::all();
        $pdf = \PDF::loadView('contents.accountings.invoice.pdf', compact('types'));
        return $pdf->download('invoice.pdf');
    }


    public function salesDataTable(Request $request)
    {
        $datas = SalesDetail::where('trx_sales_id',$request->trx_sales_id);

        return datatables()->of($datas)
            ->make(true);
    }

    public function salesDetail(Request $request)
    {
        $sales=Sales::with('customer')->find($request->sales_id);
        return response()->json(['result' => true, 'data' => $sales], 200);
    }

    public function invoiceType()
    {
        $data=[
            1=>'Cash Invoice',
            2=>'Hotel Booking Invoice',
            3=>'Sales Invoice',
            4=>'UATP'
        ];
        return $data;
    }

    public function ddFop()
    {
        $data = [
            1 => 'Cheque',
            2 => 'COD',
            3 => 'Bank Deposite',
            4 => 'Bank Guarantee',
            5 => 'Credit',
            6 => 'COA',
            7 => 'Cash',
            8 => 'Ticket By Cash',
            9 => 'Ticket By Cheque',
            10 => 'Credit Card'
        ];
        return $data;
    }
    
    public function salesDetailTable(Request $request)
    {
        $datas = SalesDetail::where('trx_sales_id', $request->trx_sales_id);
        $classEdit = 'editDataInvoiceDetail';
        $classDelete = 'deleteDataInvoiceDetail';

        return datatables()->of($datas)
            ->addColumn('action', function ($inventory) use ($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="' . $classEdit . '" title="Edit" data-id="' . $inventory['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger ' . $classDelete . '" title="Delete" data-id="' . $inventory['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function salesDetailShow(Request $request)
    {
        $findTemp = SalesDetail::find($request->id);
        return response()->json(['result' => true, 'data' => $findTemp], 200);
    }

    public function salesDetailDelete(Request $request)
    {
        if (SalesDetail::destroy($request->id)) {
            return response()->json(['result' => true], 200);
        } 
        return response()->json(['result' => false], 200);
    }
    public function salesDetailBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        if (count($ids) > 0) {
            if (SalesDetail::destroy($ids)) {
                return response()->json(['result' => true], 200);
            } 
        } 
        return response()->json(['result' => false], 200);
    }
}
