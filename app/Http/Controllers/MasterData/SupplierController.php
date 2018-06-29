<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\SupplierDataTable;

use App\Models\MasterData\Supplier\MasterSupplier as Supplier;

use DB;

class SupplierController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,supplier.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,supplier.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,supplier.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,supplier.destroy', ['only' => ['destroy']]);

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.supplier.create');
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

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = Supplier::create( $request->all() );
            
            if ($insert) {
                $redirect = redirect()->route('supplier.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('supplier.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('supplier.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '. $e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $parent = $supplier->toArray();
        $detail = $supplier->detail->toArray();
        $merge = array_merge($parent, $detail);
        $supplier = (object) $merge;

        return view('contents.master_datas.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('supplier.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('supplier.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('supplier.edit', $supplier->id);
            }

            $insert = $supplier->update( $request->all() );
            
            if ($insert) {
                \DB::commit();
                flash()->success($msgSuccess);
                return $redirect;
            } else {
                flash()->error('Data is failed to updated');
                return redirect()->back()->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            flash()->error('Data is failed to updated');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $destroy = $supplier->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('supplier.index');
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
            Supplier::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('supplier.index');
    }
}
