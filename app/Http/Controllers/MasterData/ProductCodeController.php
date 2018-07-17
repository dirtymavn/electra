<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\ProductCode\ProductCode;
use App\Models\MasterData\ProductCode\ProductCodeType;
use App\Models\Temporary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\ProductCodeDataTable;
use App\Http\Requests\MasterData\ProductCodeRequest;

class ProductCodeController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,productcode.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,productcode.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,productcode.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,productcode.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCodeDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.product_code.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        return view('contents.master_datas.product_code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\ProductCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCodeRequest $request)
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

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = ProductCode::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('productcode.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('productcode.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('productcode.create');
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
     * @param  \App\Models\MasterData\ProductCode\ProductCode  $productCode
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCode $productCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\ProductCode\ProductCode  $productCode
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCode $productCode, $id)
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();

        $productCode = ProductCode::find($id);

        foreach ($productCode->types as $type) {
            $data = [
                'code_type' => $type->code_type,
                'commission_based' => ($type->commission_based) ? 1 : 0,
                'inventory_control' => ($type->inventory_control) ? 1 : 0,
                'package_product' => ($type->package_product) ? 1 : 0,
                'is_domestic' => ($type->is_domestic) ? 1 : 0,
                'no_profit_approval' => ($type->no_profit_approval) ? 1 : 0,
                'trx_fee' => ($type->trx_fee) ? 1 : 0,
                'misc_invoice' => ($type->misc_invoice) ? 1 : 0,
                'hotel_conf_advice' => ($type->hotel_conf_advice) ? 1 : 0,
                'gst_compulsory' => ($type->gst_compulsory) ? 1 : 0,
                'profit_markup' => ($type->profit_markup) ? 1 : 0,
                'profit_markup_amt' => $type->profit_markup_amt,
            ];

            Temporary::create([
                'type' => 'data-productcode',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        return view('contents.master_datas.product_code.edit')->with(['productCode' => $productCode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\ProductCodeRequest  $request
     * @param  \App\Models\MasterData\ProductCode\ProductCode  $productCode
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCodeRequest $request, ProductCode $productCode, $id)
    {
        \DB::beginTransaction();
        try {
            $productCode = ProductCode::find($id);

            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('productcode.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('productcode.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('productcode.edit', $productCode->id);
            }

            $update = $productCode->update($request->all());

            if ($update) {
                $types =  $productCode->types;
                foreach ($types as $value) {
                    $value->delete();
                }
                $productcodes = \DB::table('temporaries')->whereType('data-productcode')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($productcodes) > 0) {
                    foreach ($productcodes as $val) {
                        $value = json_decode($val->data);

                        $type = new ProductCodeType;
                        $type->product_code_id = $productCode->id;
                        $type->code_type = $value->code_type;
                        $type->commission_based = $value->commission_based;
                        $type->inventory_control = $value->inventory_control;
                        $type->package_product = $value->package_product;
                        $type->is_domestic = $value->is_domestic;
                        $type->no_profit_approval = $value->no_profit_approval;
                        $type->trx_fee = $value->trx_fee;
                        $type->misc_invoice = $value->misc_invoice;
                        $type->hotel_conf_advice = $value->hotel_conf_advice;
                        $type->gst_compulsory = $value->gst_compulsory;
                        $type->profit_markup = $value->profit_markup;
                        $type->profit_markup_amt = $value->profit_markup_amt;

                        $type->save();
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
     * @param  \App\Models\MasterData\ProductCode\ProductCode  $productCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCode $productCode, $id)
    {
        $productCode = ProductCode::find($id);
        $productCode->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('productcode.index');
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
            ProductCode::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('productcode.index');
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
            ->addColumn('action', function ($productcode) use($request) {
                return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="'.$request->type.'" data-id="' . $productcode['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                        <a href="javascript:void(0)" class="danger deleteData" data-element="'.$request->type.'" title="Delete" data-id="' . $productcode['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->editColumn('commission_based', function ($productcode) use($request) {
                return ($productcode['commission_based']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('inventory_control', function ($productcode) use($request) {
                return ($productcode['inventory_control']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('package_product', function ($productcode) use($request) {
                return ($productcode['package_product']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('is_domestic', function ($productcode) use($request) {
                return ($productcode['is_domestic']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('no_profit_approval', function ($productcode) use($request) {
                return ($productcode['no_profit_approval']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('trx_fee', function ($productcode) use($request) {
                return ($productcode['trx_fee']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('misc_invoice', function ($productcode) use($request) {
                return ($productcode['misc_invoice']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('hotel_conf_advice', function ($productcode) use($request) {
                return ($productcode['hotel_conf_advice']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('gst_compulsory', function ($productcode) use($request) {
                return ($productcode['gst_compulsory']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('profit_markup', function ($productcode) use($request) {
                return ($productcode['profit_markup']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->rawColumns(['code_type',
                'commission_based',
                'inventory_control',
                'package_product',
                'is_domestic',
                'no_profit_approval',
                'trx_fee',
                'misc_invoice',
                'hotel_conf_advice',
                'gst_compulsory',
                'profit_markup','action'
            ])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productCodeDetailStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->productcode_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->productcode_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'data-productcode',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'productcode_id']))
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
