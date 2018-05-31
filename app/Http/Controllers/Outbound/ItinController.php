<?php

namespace App\Http\Controllers\Outbound;

use App\Models\Outbound\Itin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Outbound\ItinDataTable;

class ItinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItinDataTable $dataTable)
    {
        return $dataTable->render('contents.outbounds.itin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.outbounds.itin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outbound\Itin  $itin
     * @return \Illuminate\Http\Response
     */
    public function show(Itin $itin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outbound\Itin  $itin
     * @return \Illuminate\Http\Response
     */
    public function edit(Itin $itin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outbound\Itin  $itin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itin $itin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outbound\Itin  $itin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itin $itin)
    {
        //
    }
}
