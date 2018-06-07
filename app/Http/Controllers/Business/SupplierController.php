<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\SupplierDataTable;

use App\Models\Business\Supplier\MasterSupplier as Supplier;

use DB;

class SupplierController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(SupplierDataTable $dataTable)
     {
        return $dataTable->render('contents.business.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.business.supplier.create');
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
                $request->merge(['is_draft' => true]);
                $msgSuccess = 'Data is successfully inserted as draft';
            } else {
                $msgSuccess = 'Data is successfully inserted';
                $request->merge(['is_draft' => false]);
            }
            $insert = Supplier::create($request->all());
            
            if ($insert) {
                flash()->success($msgSuccess);
                \DB::commit();
                return redirect()->route('supplier.index');
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {
            
            DB::rollback();
            flash()->error('Data is failed to insert');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('contents.business.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        DB::beginTransaction();
        try {

            $insert = $supplier->update( $request->all() );
            
            if ($insert) {
                flash()->success('Data is successfully updated');
                \DB::commit();
                return redirect()->route('supplier.index');
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
     * @param  \App\Models\Business\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $destroy = $supplier->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('supplier.index');
    }
}
