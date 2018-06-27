<?php

namespace App\Http\Controllers\Accounting\GL;

use App\Models\GL\TrxPosting\TrxPosting;
use App\Models\GL\TrxPosting\TrxPostingDetail;
use App\DataTables\GL\TrxPostingDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrxPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrxPostingDataTable $dataTable)
    {
        return $dataTable->render('contents.gl.periodend.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereType('fxTrans-detail')
        ->whereUserId(user_info('id'))->delete();

        return view('contents.gl.periodend.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $request->merge([ 'user_id' => user_info('id'), 'branch_id' => 0 ]);
        $insert = TrxPosting::create($request->all());

        if ($insert) {
            $redirect = redirect()->route('periodend.index');
            if (@$request->is_draft == 'true') {
                $redirect = redirect()->route('periodend.edit', $insert->id)->withInput();
            } elseif (@$request->is_publish_continue == 'true') {
                $redirect = redirect()->route('periodend.create');
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
     * @param  \App\Models\GL\TrxPosting\TrxPosting  $trxPosting
     * @return \Illuminate\Http\Response
     */
    public function show(TrxPosting $trxPosting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GL\TrxPosting\TrxPosting  $trxPosting
     * @return \Illuminate\Http\Response
     */
    public function edit(TrxPosting $trxPosting, $id)
    {
        $trxPosting = TrxPosting::find($id);
        // clear temporary data
        \DB::table('temporaries')->whereType('posting-detail')
        ->whereUserId(user_info('id'))->delete();

        $details = $trxPosting->details;
        foreach ($details as $detail) {
            \DB::table('temporaries')->insert([
                'type' => 'posting-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($detail->toArray()),
            ]);
        }

        return view('contents.gl.periodend.edit', compact('trxPosting'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GL\Request  $request
     * @param  \App\Models\GL\TrxPosting\TrxPosting  $trxPosting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrxPosting $trxPosting, $id)
    {
        $trxPosting = TrxPosting::find($id);
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('periodend.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('periodend.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('periodend.edit', $trxPosting->id);
            }
            $request->merge([ 'user_id' => user_info('id'), 'branch_id' => 0 ]);
            $update = $trxPosting->update($request->all());

            if ($update) {

                // delete childs
                $details = $trxPosting->details;
                foreach ($details as $value) {
                    $value->delete();
                }

                $fxTransDetails = \DB::table('temporaries')->whereType('posting-detail')
                ->whereUserId(user_info('id'))
                ->get();
                if (count($fxTransDetails) > 0) {
                    foreach ($fxTransDetails as $trxDetail) {
                        $detail = new TrxPostingDetail;

                        $trxDetail = json_decode($trxDetail->data);

                        $detail->trx_posting_id = $trxPosting->id;
                        $detail->transaction_subject = $trxDetail->transaction_subject;
                        $detail->transaction_type = $trxDetail->transaction_type;
                        $detail->in_qty = $trxDetail->in_qty;
                        $detail->in_price = $trxDetail->in_price;
                        $detail->in_total = $trxDetail->in_total;
                        $detail->out_qty = $trxDetail->out_qty;
                        $detail->out_price = $trxDetail->out_price;
                        $detail->out_total = $trxDetail->out_total;
                        $detail->result_qty = $trxDetail->result_qty;
                        $detail->result_avg = $trxDetail->result_avg;
                        $detail->result_total = $trxDetail->result_total;

                        $detail->save();
                    }

                    // clear temporary data
                    \DB::table('temporaries')->whereType('posting-detail')
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
     * @param  \App\Models\GL\FxTrans\TrxFxTrans  $trxPosting
     * @return \Illuminate\Http\Response
     */
     public function destroy(TrxPosting $trxPosting, $id)
     {
        $trxPosting = TrxPosting::find($id);
        $trxPosting->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('periodend.index');

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
            TrxPosting::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('periodend.index');
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
    public function trxTransDetailStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->trx_posting_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->trx_posting_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'posting-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'trx_posting_id']))
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
    public function trxTransDetailDelete(Request $request)
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
    public function trxTransDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }
}
