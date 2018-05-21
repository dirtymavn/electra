<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\CompanyDataTable;
use App\Models\Master\Company;
use App\Http\Requests\Master\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * @var \App\Models\Master\Company
    */
    protected $company;

    /**
     * Create a new CompanyController instance.
     *
     * @param \App\Models\Master\Company  $company
    */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDataTable $dataTable)
    {
        return $dataTable->render('contents.masters.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.masters.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Master\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        \DB::beginTransaction();
        try {
            $insert = $this->company->create($request->all());
            
            if ($insert) {
                \DB::commit();
                return redirect()->route('company.index');
            }
            
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            \DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('contents.masters.company.edit')->with(['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $update = $company->update($request->all());

        if ($update) {
            return redirect()->route('company.index');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->user) {
            return redirect()->back();
        } else {
            $company->delete();
            return redirect()->back();
        }
    }
}
