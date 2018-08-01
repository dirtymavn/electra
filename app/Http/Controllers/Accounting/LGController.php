<?php

namespace App\Http\Controllers\Accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Accounting\LGDataTable;
use App\Models\Accounting\LG\MasterLG;
use App\Models\Accounting\LG\MasterLGDetail;
use App\Models\MasterData\Supplier\MasterSupplier;
use App\Models\Temporary;
use App\Http\Requests\Accounting\LgRequest;

class LGController extends Controller
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
    public function index(LGDataTable $dataTable)
    {
        return $dataTable->render('contents.accountings.lg.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $suppliers = MasterSupplier::getAvailableData()->pluck('master_supplier.name', 'master_supplier.id')
            ->all();

        if (count($suppliers) == 0) {
            $suppliers = ['' => '- Not Available -'];
        }

        $creditTerms = ['' => '- Not Available -'];
        $baseCurrencys = ['' => '- Not Available -'];
        $billCurrencys = ['' => '- Not Available -'];
        $newCode = MasterLG::getAutoNumber();

        return view('contents.accountings.lg.create', compact('suppliers', 'baseCurrencys', 'billCurrencys', 'creditTerms', 'newCode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Accounting\LgRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LgRequest $request)
    {
        \DB::beginTransaction();
        try {
            $newCode = MasterLG::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'lg_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'lg_no' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = MasterLG::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('lg.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('lg.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('lg.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accounting\LG\MasterLG  $lg
     * @return \Illuminate\Http\Response
     */
    public function show(MasterLG $lg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accounting\LG\MasterLG  $lg
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterLG $lg)
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $suppliers = MasterSupplier::getAvailableData()->pluck('master_supplier.name', 'master_supplier.id')
            ->all();

        if (count($suppliers) == 0) {
            $suppliers = ['' => '- Not Available -'];
        }

        $creditTerms = ['' => '- Not Available -'];
        $baseCurrencys = ['' => '- Not Available -'];
        $billCurrencys = ['' => '- Not Available -'];

        foreach ($lg->details as $detail) {
            $data = [
                'product_code' => $detail->product_code,
                'product_code_description' => $detail->product_code_description,
                'qty' => $detail->qty,
                'unit_cost' => $detail->unit_cost,
                'total_amt' => $detail->total_amt,
                'discount' => $detail->discount,
                'tax' => $detail->tax,
                'gst_amt' => $detail->gst_amt,
            ];

            Temporary::create([
                'type' => 'data-lg',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }
        $newCode = $lg->lg_no;
        return view('contents.accountings.lg.edit', compact('lg', 'suppliers', 'baseCurrencys', 'billCurrencys', 'creditTerms', 'newCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Accounting\LgRequest  $request
     * @param  \App\Models\Accounting\LG\MasterLG  $lg
     * @return \Illuminate\Http\Response
     */
    public function update(LgRequest $request, MasterLG $lg)
    {
        \DB::beginTransaction();
        try {
            $newCode = MasterLG::getAutoNumber();
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false, 'lg_no' => $newCode]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('lg.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'lg_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('lg.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('lg.edit', $lg->id);
            }

            $update = $lg->update($request->all());

            if ($update) {
                $details =  $lg->details;
                foreach ($details as $value) {
                    $value->delete();
                }
                $lgs = \DB::table('temporaries')->whereType('data-lg')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($lgs) > 0) {
                    foreach ($lgs as $val) {
                        $value = json_decode($val->data);

                        $detail = new MasterLGDetail;
                        $detail->master_lg_id = $lg->id;
                        $detail->product_code = $value->product_code;
                        $detail->product_code_description = $value->product_code_description;
                        $detail->qty = $value->qty;
                        $detail->unit_cost = $value->unit_cost;
                        $detail->total_amt = $value->total_amt;
                        $detail->discount = $value->discount;
                        $detail->tax = $value->tax;
                        $detail->gst_amt = $value->gst_amt;

                        $detail->save();
                    }
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accounting\LG\MasterLG  $lg
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterLG $lg)
    {
        $lg->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('lg.index');
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
            MasterLG::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('lg.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
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
            ->addColumn('action', function ($lg) use($request) {
                return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="'.$request->type.'" data-id="' . $lg['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                        <a href="javascript:void(0)" class="danger deleteData" data-element="'.$request->type.'" title="Delete" data-id="' . $lg['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
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
    public function lgDetailStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->lg_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->lg_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'data-lg',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'lg_id']))
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
    public function dataDelete(Request $request)
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
    public function dataDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }
}
