<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\InventoryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\InventoryTypeDataTable;
use App\Http\Requests\MasterData\InventoryTypeRequest;

class InventoryTypeController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,inventory-type.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,inventory-type.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,inventory-type.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,inventory-type.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InventoryTypeDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.inventory_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.inventory_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\InventoryTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryTypeRequest $request)
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
            $insert = InventoryType::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('inventory-type.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('inventory-type.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('inventory-type.create');
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
     * @param  \App\Models\MasterData\InventoryType  $InventoryType
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryType $InventoryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\InventoryType  $InventoryType
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryType $InventoryType)
    {
        return view('contents.master_datas.inventory_type.edit')->with(['Inventorytype' => $InventoryType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\InventoryTypeRequest  $request
     * @param  \App\Models\MasterData\InventoryType  $InventoryType
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryTypeRequest $request, InventoryType $InventoryType)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('inventory-type.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('inventory-type.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('inventory-type.edit', $InventoryType->id);
            }

            $update = $InventoryType->update($request->all());

            if ($update) {

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
     * @param  \App\Models\MasterData\InventoryType  $InventoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryType $InventoryType)
    {
        $InventoryType->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('inventory-type.index');
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
            InventoryType::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('inventory-type.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = InventoryType::select('*')->get();
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
        $types = InventoryType::all();
        $pdf = \PDF::loadView('contents.master_datas.inventory_type.pdf', compact('types'));
        return $pdf->download('inventory-type.pdf');
    }
}
