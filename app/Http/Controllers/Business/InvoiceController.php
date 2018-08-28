<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Invoice\InvoiceDetail;
use App\Models\Business\Invoice\InvoiceRefund;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\InvoiceDataTable;
use App\Http\Requests\Business\InvoiceRequest;
use App\Models\Business\Country;
use App\Models\Business\Invoice\Invoice;
use App\Models\Temporary;
use App\Models\Business\Sales\TrxSales as Sales;
use App\Models\MasterData\Customer\MasterCustomer;

use DB;
use Excel;
use PDF;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,invoice.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,invoice.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,invoice.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,invoice.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('contents.business.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $listSales = Sales::getAvailableData()->pluck('trx_sales.sales_no', 'trx_sales.id')->all();
        $listCustCredit = array();
        $customers = MasterCustomer::getAvailableData()->pluck('master_customers.customer_name', 'master_customers.id')
            ->all();
        return view('contents.business.invoice.create', compact('listSales', 'listCustCredit', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\InvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
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
            $insert = Invoice::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('invoice.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('invoice.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('invoice.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
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

    
    public function edit(Invoice $Invoice)
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $parent = $Invoice->toArray();
        foreach ($Invoice->InvoiceDetail as $valueInvoiceDetail) {
            $data = [
                'product_code' => $valueInvoiceDetail->product_code,
                'product_code_desc' => $valueInvoiceDetail->product_code_desc,
                'pkg_flag' => $valueInvoiceDetail->pkg_flag,
                'suppress_itinerary_flag' => $valueInvoiceDetail->suppress_itinerary_flag,
                'qty' => $valueInvoiceDetail->qty,
                'sales_cur' => $valueInvoiceDetail->sales_cur,
                'total_sales' => $valueInvoiceDetail->total_sales,
                'total_cost' => $valueInvoiceDetail->total_cost,
                'gp_amt' => $valueInvoiceDetail->gp_amt,
                'gp_percentage' => $valueInvoiceDetail->gp_percentage,
                'pax1' => $valueInvoiceDetail->pax1,
                'pax2' => $valueInvoiceDetail->pax2,
                'unit_sales' => $valueInvoiceDetail->unit_sales,
                'unit_cost' => $valueInvoiceDetail->unit_cost,
                'unit_cost_tax' => $valueInvoiceDetail->unit_cost_tax,
                'commission_rate' => $valueInvoiceDetail->commission_rate,
                'commission' => $valueInvoiceDetail->commission,
                'discount_rate' => $valueInvoiceDetail->discount_rate,
                'discount' => $valueInvoiceDetail->discount,
                'rebate_rate' => $valueInvoiceDetail->rebate_rate,
                'rebate' => $valueInvoiceDetail->rebate
            ];

            Temporary::create([
                'type' => 'invoicedetail-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($Invoice->InvoiceRefund as $valueInvoiceDetail) {
            $data = [
                'ticket_no' => $valueInvoiceDetail->ticket_no
            ];

            Temporary::create([
                'type' => 'invoicerefund-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $invCustomer = $Invoice->InvoiceCustomer->toArray();
        unset($invCustomer['id']);
        
        $arrayMerge = array_merge($parent,$invCustomer);
        
        $Invoice = (object)$arrayMerge;

        $listSales = Sales::getAvailableData()->pluck('trx_sales.sales_no', 'trx_sales.id')->all();
        $listCustCredit = array();
        $customers = MasterCustomer::getAvailableData()->pluck('master_customers.customer_name', 'master_customers.id')
            ->all();

        return view('contents.business.invoice.edit', compact('Invoice', 'listSales', 'customers', 'listCustCredit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\InvoiceRequest  $request
     * @param  \App\Models\MasterData\Invoice  $Invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $Invoice)
    {
        
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('invoice.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('invoice.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('invoice.edit', $Invoice->id);
            }

            $update = $Invoice->update($request->all());

            if ($update) {
                $input = $request->all();
                $input['id_invoice'] = $Invoice->id;

                $customer = $Invoice->InvoiceCustomer;
                $customer->update($input);

                $routeallotdetail =  $Invoice->InvoiceDetail;
                foreach ($routeallotdetail as $value) {
                    $value->delete();
                }

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


                $routeallrefund =  $Invoice->InvoiceRefund;
                foreach ($routeallrefund as $value) {
                    $value->delete();
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

                flash()->success($msgSuccess);
                \DB::commit();
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

        return redirect()->route('invoice.index');
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
        if ( count($ids) > 0 ) {
            Invoice::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('invoice.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = Invoice::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($type) {
            $excel->sheet('Sheet 1', function($sheet) use ($type) {
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
        $pdf = \PDF::loadView('contents.business.invoice.pdf', compact('types'));
        return $pdf->download('invoice.pdf');
    }


    public function detailData(Request $request)
    {
        $datas = [];
        $results = \DB::table('temporaries')->whereType($request->type)
            ->whereUserId(user_info('id'))
            ->select('id','data')
            ->get();

        if (count($results) > 0) {
            foreach ($results as $result) {
                $value = collect(json_decode($result->data))->toArray();
                
                $value['id'] = $result->id;

                array_push($datas, $value);
            }
        }

        $datas = collect($datas);

        if ($request->type == 'invoicedetail-detail') {
            $classEdit = 'editDataInvoiceDetail';
            $classDelete = 'deleteDataInvoiceDetail';
        } else if ($request->type == 'invoicerefund-detail') {
            $classEdit = 'editDataInvoiceRefund';
            $classDelete = 'deleteDataInvoiceRefund';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($inventory) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $inventory['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $inventory['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function InvoiceDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function InvoiceDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function invoicePopupInvoicedetail(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->invoicedetail_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->invoicedetail_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'invoicedetail-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'invoicedetail_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function invoicePopupInvoicrefund(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->invoicedetail_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->invoicedetail_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'invoicerefund-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'invoicerefund_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
