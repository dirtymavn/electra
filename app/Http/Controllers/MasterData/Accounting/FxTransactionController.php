<?php

namespace App\Http\Controllers\MasterData\Accounting;

use App\Models\MasterData\Accounting\FxTrans\TrxFxTrans;
use App\Models\MasterData\Accounting\FxTrans\TrxFxTransDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\Accounting\TrxFxTransactionDataTable;
use App\Http\Requests\MasterData\Accounting\TrxFxTransRequest;

class FxTransactionController extends Controller
{
    /**
     * @var App\Models\MasterData\Accounting\FxTrans\TrxFxTrans
    */
    protected $trxFxTrans;

    /**
     * Create a new FxTransactionController instance.
     *
     * @param \App\Models\MasterData\Accounting\FxTrans\TrxFxTrans  $trxFxTrans
    */
    public function __construct(TrxFxTrans $trxFxTrans)
    {
        $this->trxFxTrans = $trxFxTrans;

        // middleware
        $this->middleware('sentinel_access:admin.company,fx-trans.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,fx-trans.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,fx-trans.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,fx-trans.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrxFxTransactionDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.accountings.trx_fx_trans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // clear temporary data
        \DB::table('temporaries')->whereType('fxTrans-detail')
            ->whereUserId(user_info('id'))->delete();

        return view('contents.master_datas.accountings.trx_fx_trans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\Accounting\TrxFxTransRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrxFxTransRequest $request)
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
            $insert = $this->trxFxTrans->create($request->all());

            if ($insert) {
                $redirect = redirect()->route('fx-trans.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('fx-trans.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('fx-trans.create');
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
     * @param  \App\Models\MasterData\Accounting\FxTrans\TrxFxTrans  $trxFxTrans
     * @return \Illuminate\Http\Response
     */
    public function show(TrxFxTrans $trxFxTrans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Accounting\FxTrans\TrxFxTrans  $trxFxTrans
     * @return \Illuminate\Http\Response
     */
    public function edit(TrxFxTrans $trxFxTrans, $id)
    {
        $trxFxTrans = $this->trxFxTrans->find($id);
        // clear temporary data
        \DB::table('temporaries')->whereType('fxTrans-detail')
            ->whereUserId(user_info('id'))->delete();

        $details = $trxFxTrans->details;
        foreach ($details as $detail) {
            \DB::table('temporaries')->insert([
                'type' => 'fxTrans-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($detail->toArray()),
            ]);
        }

        return view('contents.master_datas.accountings.trx_fx_trans.edit', compact('trxFxTrans'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\Accounting\TrxFxTransRequest  $request
     * @param  \App\Models\MasterData\Accounting\FxTrans\TrxFxTrans  $trxFxTrans
     * @return \Illuminate\Http\Response
     */
    public function update(TrxFxTransRequest $request, TrxFxTrans $trxFxTrans, $id)
    {
        $trxFxTrans = $this->trxFxTrans->find($id);
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('fx-trans.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('fx-trans.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('fx-trans.edit', $trxFxTrans->id);
            }

            $update = $trxFxTrans->update($request->all());

            if ($update) {
                
                // delete childs
                $details = $trxFxTrans->details;
                foreach ($details as $value) {
                    $value->delete();
                }

                $fxTransDetails = \DB::table('temporaries')->whereType('fxTrans-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($fxTransDetails) > 0) {
                    foreach ($fxTransDetails as $fxTransDetail) {
                        $detail = new TrxFxTransDetail;

                        $fxTransDetail = json_decode($fxTransDetail->data);

                        $detail->trx_fx_transaction_id = $trxFxTrans->id;
                        $detail->currency = $fxTransDetail->currency;
                        $detail->exchange_rate = $fxTransDetail->exchange_rate;

                        $detail->save();
                    }

                    // clear temporary data
                    \DB::table('temporaries')->whereType('fxTrans-detail')
                        ->whereUserId(user_info('id'))->delete();
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
     * @param  \App\Models\MasterData\Accounting\FxTrans\TrxFxTrans  $trxFxTrans
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrxFxTrans $trxFxTrans, $id)
    {
        $trxFxTrans = $this->trxFxTrans->find($id);
        $trxFxTrans->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('fx-trans.index');

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
            TrxFxTrans::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('fx-trans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return datatables()->of($datas)
            ->addColumn('action', function ($fxTrans) {
                return '<a href="javascript:void(0)" class="editData" title="Edit" data-id="' . $fxTrans['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                                    <a href="javascript:void(0)" class="danger deleteData" title="Delete" data-id="' . $fxTrans['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fxTransDetailStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->trx_fx_transaction_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->trx_fx_transaction_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'fxTrans-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'trx_fx_transaction_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Delete resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fxTransDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    /**
     * Get detail resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fxTransDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $trx = TrxFxTrans::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($trx) {
            $excel->sheet('Sheet 1', function($sheet) use ($trx) {
                $sheet->fromArray($trx);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $trxs = TrxFxTrans::all();
        $pdf = \PDF::loadView('contents.master_datas.accountings.trx_fx_trans.pdf', compact('trxs'));
        return $pdf->download('accounting-trx.pdf');
    }
}
