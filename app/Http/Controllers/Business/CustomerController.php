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
                flash()->success('Data is successfully inserted');
                \DB::commit();
                return redirect()->route('customer.index');
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong');
            \DB::rollback();
            return redirect()->back()->withInput();
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
        if ($update) {
            flash()->success('Data is successfully inserted');
            return redirect()->route('customer.index');
        }

        flash()->error('<strong>Whoops! </strong> Something went wrong');        
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $destroy = $customer->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('customer.index');
    }
}
