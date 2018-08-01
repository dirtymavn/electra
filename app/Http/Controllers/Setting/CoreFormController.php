<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting\CoreForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Setting\CoreFormDataTable;

class CoreFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoreFormDataTable $dataTable)
    {
        return $dataTable->render('contents.settings.core_form.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Setting\CoreForm  $coreForm
     * @return \Illuminate\Http\Response
     */
    public function show(CoreForm $coreForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting\CoreForm  $coreForm
     * @return \Illuminate\Http\Response
     */
    public function edit(CoreForm $coreForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting\CoreForm  $coreForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoreForm $coreForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting\CoreForm  $coreForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoreForm $coreForm)
    {
        //
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchData(Request $request)
    {
        $results = CoreForm::select('core_forms.id', 'core_forms.name as text')
            ->where('core_forms.type', '<>', 'Core')
            ->where('core_forms.name', 'ilike', '%'.$request->search.'%')
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
    }
}
