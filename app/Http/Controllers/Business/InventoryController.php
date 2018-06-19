<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Inventory\MasterInventory;

use App\DataTables\Business\InventoryDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business\Inventory\MasterInventory  $masterInventory
     * @return \Illuminate\Http\Response
     */
    public function show(MasterInventory $masterInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Inventory\MasterInventory  $masterInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterInventory $masterInventory)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Inventory\MasterInventory  $masterInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterInventory $masterInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\Inventory\MasterInventory  $masterInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterInventory $masterInventory)
    {
        //
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
            MasterInventory::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('inventory.index');
    }
}
