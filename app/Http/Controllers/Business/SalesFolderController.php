<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\SalesDataTable;

use App\Models\Business\Sales\TrxSales as Sales;
use App\Models\Business\Sales\TrxSalesCreditCard;
use App\Models\Business\Sales\TrxSalesBilling;
use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\MasterData\City;
use App\Models\MasterData\Department;
use App\Models\Temporary;

use DB;
use Excel;
use PDF;

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
        $newCode = '';
        $company_id = user_info()->company_id;
        $customers = MasterCustomer::getAvaliable()->pluck('customer_name', 'id')->all();
        $cities = City::getDataAvailable()->pluck('city_name', 'id')->all();
        $departments = Department::getAvailableData()->pluck('department_name', 'company_departments.id')->all();
         // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        return view('contents.business.sales.create', compact('customers', 'cities', 'newCode', 'departments'));
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
            $newCode = Sales::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'sales_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'sales_no' => $newCode]);
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
    public function edit($id)
    {
        $customers = MasterCustomer::getAvaliable()->pluck('customer_name', 'id')->all();
        $departments = Department::getAvailableData()->pluck('department_name', 'company_departments.id')->all();
        $sales = Sales::find($id);
        $trxsales = Sales::find($id)->toArray();
        $credit = TrxSalesCreditCard::where('trx_sales_id', $id)->first()->toArray();
        $billing = TrxSalesBilling::where('trx_sales_id', $id)->first()->toArray();
        unset($credit['id'], $credit['created_at'], $credit['updated_at'], $billing['id'], $billing['created_at'], $billing['updated_at']);

        $merge = array_merge($trxsales, $credit, $billing);
        $cities = City::getDataAvailable()->pluck('city_name', 'id')->all();
        $sales = (object) $merge;
        return view('contents.business.sales.edit', compact('sales', 'customers', 'cities', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\sales\sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $newCode = Sales::getAutoNumber();
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false, 'sales_no' => $newCode]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('sales.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'sales_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('sales.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('sales.edit', $id);
            }

            $update = Sales::find($id)->update( $request->all() );

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
            Sales::whereIn('id', $ids)->delete();
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
        } elseif($request->type == 'cost-detail') {
            $classEdit = 'editDataCost';
            $classDelete = 'deleteDataCost';
        } elseif($request->type == 'price-detail') {
            $classEdit = 'editDataPrice';
            $classDelete = 'deleteDataPrice';
        } elseif($request->type == 'segment-detail') {
            $classEdit = 'editDataSegment';
            $classDelete = 'deleteDataSegment';
        } elseif($request->type == 'passenger-detail') {
            $classEdit = 'editDataPassenger';
            $classDelete = 'deleteDataPassenger';
        } else {
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

            Temporary::where('type', 'mis-detail')
                ->whereParentId($request->sales_id)
                ->whereUserId(user_info('id'))
                ->update([ 'parent_id' => $temp->id ]);

            Temporary::where('type', 'cost-detail')
                ->whereParentId($request->sales_id)
                ->whereUserId(user_info('id'))
                ->update([ 'parent_id' => $temp->id ]);

            Temporary::where('type', 'price-detail')
                ->whereParentId($request->sales_id)
                ->whereUserId(user_info('id'))
                ->update([ 'parent_id' => $temp->id ]);

            Temporary::where('type', 'segment-detail')
                ->whereParentId($request->sales_id)
                ->whereUserId(user_info('id'))
                ->update([ 'parent_id' => $temp->id ]);

            Temporary::where('type', 'passenger-detail')
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

     /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salesPrice(Request $request)
    {
        \DB::beginTransaction();
        try {
            \Log::info($request->all());
            if (@$request->price_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->price_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'price-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'price_id'])),
                'parent_id' => $request->price_id
            ]);

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
    public function salesMis(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->mis_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->mis_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'mis-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'mis_id'])),
                'parent_id' => $request->mis_id
            ]);

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
    public function salesCost(Request $request)
    {
        \DB::beginTransaction();
        try {
            \Log::info($request->all());
            if (@$request->cost_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->cost_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'cost-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'cost_id'])),
                'parent_id' => $request->cost_id
            ]);

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
    public function salesSegment(Request $request)
    {
        \DB::beginTransaction();
        try {
            \Log::info($request->all());
            if (@$request->segment_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->segment_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'segment-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'segment_id'])),
                'parent_id' => $request->segment_id
            ]);

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
    public function salesPassenger(Request $request)
    {
        \DB::beginTransaction();
        try {
            \Log::info($request->all());
            if (@$request->passenger_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->passenger_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'passenger-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'passenger_id'])),
                'parent_id' => $request->passenger_id
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $sales = Sales::select(
            'trx_sales.sales_no',
            'master_customers.customer_name',
            'trx_sales.trip_date',
            'trx_sales.deadline',
            'trx_sales.invoice_no',
            'trx_sales.sales_date',
            'trx_sales.created_at'
        )->join('master_customers', 'master_customers.id', '=', 'trx_sales.customer_id' )->get();
        Excel::create('testing-'.date('Ymd'), function($excel) use ($sales) {
            $excel->sheet('Sheet 1', function($sheet) use ($sales) {
                $sheet->fromArray($sales);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $saless = Sales::all();
        $pdf = PDF::loadView('contents.business.sales.pdf', compact('saless'));
        return $pdf->download('sales.pdf');
    }
}
