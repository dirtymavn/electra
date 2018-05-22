<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\CustomerDataTable;
use App\Http\Requests\Business\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * @var \App\Models\Business\Customer
    */
    protected $customer;

    /**
     * Create a new CompanyController instance.
     *
     * @param \App\Models\Business\Customer  $customer
    */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('contents.business.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.business.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Business\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        \DB::beginTransaction();
        try {
            $request->merge(['company_id' => user_info()->company->id]);
            $insert = $this->customer->create($request->all());
            
            if ($insert) {
                \DB::commit();
            }
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->route('customer.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('contents.business.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Business\CustomerRequest  $request
     * @param  \App\Models\Business\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $update = $customer->update($request->all());
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $update = $customer->delete();
        return redirect()->route('customer.index');
    }
}
