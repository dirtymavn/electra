<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\SalesDataTable;

use App\Models\Business\Sales;
use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\Temporary;

use DB;

class SalesFolderController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,sales.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,sales.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,sales.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,sales.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalesDataTable $dataTable)
    {
        return $dataTable->render('contents.business.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_id = user_info()->company_id;
        $customers = MasterCustomer::whereCompanyId($company_id)->pluck('customer_name', 'id')->all();
        return view('contents.business.sales.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
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
            $request->merge( [ 'company_id' => user_info()->company_id ] );
            $insert = Sales::create( $request->all() );

            if ($insert) {
                $redirect = redirect()->route('sales.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('sales.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('sales.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '.$e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\sales\Mastersales  $mastersales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\sales\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        $trx = $sales->trx->toArray();
        $sales = $sales->toArray();
        unset($trx['id']);

        $merge = array_merge($sales, $trx);

        $sales = (object) $merge;
        return view('contents.master_datas.sales.edit', compact('sales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\sales\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('sales.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('sales.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('sales.edit', $sales->id);
            }

            $update = $sales->update( $request->all() );

            flash()->success($msgSuccess);
            return $redirect;
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '. $e->getMessage());        
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\Sales\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        $destroy = $sales->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('sales.index');
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
            sales::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('sales.index');
    }

    /**
     * Delete resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salesDetailDelete(Request $request)
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
    public function salesDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
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
        if (!empty(@$request->parent_id)) {
            $results = \DB::table('temporaries')->whereType($request->type)
                ->whereUserId(user_info('id'))
                ->whereParentId($request->parent_id)
                ->select('id','data')
                ->get();   
        
        } else {
            $results = \DB::table('temporaries')->whereType($request->type)
                ->whereUserId(user_info('id'))
                ->select('id','data')
                ->get();
        }
            
        if (count($results) > 0) {
            foreach ($results as $result) {
                $value = collect(json_decode($result->data))->toArray();
                
                $value['id'] = $result->id;

                array_push($datas, $value);
            }
        }

        $datas = collect($datas);

        if ($request->type == 'sales-detail') {
            $classEdit = 'editDataSales';
            $classDelete = 'deleteDataSales';
        } elseif ($request->type == 'mis-detail') {
            $classEdit = 'editDataMis';
            $classDelete = 'deleteDataMis';
        } elseif($request->type == 'routing-detail') {
            $classEdit = 'editDataRouting';
            $classDelete = 'deleteDataRouting';
        }else {
            $classEdit = 'editData';
            $classDelete = 'deleteData';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($sales) use($classEdit, $classDelete, $request) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $sales['id'] . '" data-button="edit" data-element="'. $request->type .'"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $sales['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
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
    public function salesDetail(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->sales_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->sales_id)->delete();
            }
             $temp = Temporary::create([
                'type' => 'sales-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'sales_id']))
            ]);

             \Log::info($request->all());

            Temporary::where('type', 'routing-detail')
                ->whereParentId($request->sales_id)
                ->whereUserId(user_info('id'))
                ->update([ 'parent_id' => $temp->id ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salesRouting(Request $request)
    {
        \DB::beginTransaction();
        try {
            \Log::info($request->all());
            if (@$request->routing_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->routing_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'routing-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'routing_id'])),
                'parent_id' => $request->routing_id
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
