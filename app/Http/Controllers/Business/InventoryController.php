<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Inventory\MasterInventory;

use App\DataTables\Business\InventoryDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business\Inventory\MasterInventory as Inventory;
use App\Models\Business\Inventory\TrxSales as Trx;

use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InventoryDataTable $dataTable)
    {
        return $dataTable->render('contents.business.inventory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.business.inventory.create');
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

            $trx = Trx::create( $request->all() );
            $request->merge([ 'trx_sales_id' => $trx->id ]);
            $insert = Inventory::create( $request->all() );

            if ($insert) {
                $redirect = redirect()->route('inventory.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('inventory.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('inventory.create');
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
     * @param  \App\Models\Business\Inventory\MasterInventory  $masterInventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $trx = $inventory->trx->toArray();
        $inventory = $inventory->toArray();
        unset($trx['id']);

        $merge = array_merge($inventory, $trx);

        $inventory = (object) $merge;
        return view('contents.business.inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('inventory.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('inventory.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('inventory.edit', $inventory->id);
            }

            $update = $inventory->update( $request->all() );

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
     * @param  \App\Models\Business\Inventory\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $destroy = $inventory->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('inventory.index');
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
            Inventory::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('inventory.index');
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

        if ($request->type == 'misc') {
            return datatables()->of($datas)
                ->addColumn('action', function ($itin) {
                    return '<a href="javascript:void(0)" class="editData" title="Edit" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                <a href="javascript:void(0)" class="danger deleteData" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->editColumn('as_remark_flag', function ($itin) {
                    return ($itin['as_remark_flag'] == 'true' || $itin['as_remark_flag'] === true) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';

                })
                ->rawColumns(['as_remark_flag', 'action'])
                ->make(true);
        } elseif ($request->type == 'pkg') {
            return datatables()->of($datas)
                ->addColumn('action', function ($itin) {
                    return '<a href="javascript:void(0)" class="editDataOptional" title="Edit" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                                        <a href="javascript:void(0)" class="danger deleteDataOptional" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return datatables()->of($datas)
                ->addColumn('action', function ($itin) {
                    return '<a href="javascript:void(0)" class="editDataService" title="Edit" data-id="' . $itin['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                            <a href="javascript:void(0)" class="danger deleteDataService" title="Delete" data-id="' . $itin['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itineraryDetailStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->itinerary_detail_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->itinerary_detail_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'itinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'itinerary_detail_id']))
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
    public function itineraryDetailDelete(Request $request)
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
    public function itineraryDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }
}
