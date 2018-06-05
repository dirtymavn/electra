<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Customer;
use App\Models\Business\Customer\MasterCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\CustomerDataTable;
use App\Http\Requests\Business\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * @var \App\Models\Business\Customer
     * @var \App\Models\Business\Customer\MasterCustomer
    */
    protected $customer;
    protected $masterCustomer;

    /**
     * Create a new CustomerController instance.
     *
     * @param \App\Models\Business\Customer  $customer
     * @param \App\Models\Business\Customer\MasterCustomer  $masterCustomer
    */
    public function __construct(Customer $customer, MasterCustomer $masterCustomer)
    {
        $this->customer = $customer;
        $this->masterCustomer = $masterCustomer;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            // if (user_info()->parent) {
            //     $companyId = @user_info()->parent->company->id;
            // } else {
            //     $companyId = @user_info()->company->id;

            // }
            // $request->merge(['company_id' => $companyId]);
            // $insert = $this->customer->create($request->all());
            if (@$request->is_draft == 'true') {
                $request->merge(['is_draft' => true]);
                $msgSuccess = 'Data is successfully inserted as draft';
            } else {
                $msgSuccess = 'Data is successfully inserted';
                $request->merge(['is_draft' => false]);
            }
            $insert = $this->masterCustomer->create($request->all());
            
            if ($insert) {
                flash()->success($msgSuccess);
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
     * @param  \App\Models\Business\Customer\MasterCustomer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCustomer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Customer\MasterCustomer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCustomer $customer)
    {        
        $main = $customer->mains()->first()->toArray();
        $mainContact = $customer->mains()->first()->contacts()->first()->toArray();
        $basic = $customer->basics()->first()->toArray();
        $general = $customer->generals()->first()->toArray();
        $generalDoc = $customer->generals()->first()->docs()->first()->toArray();
        $discRate = $customer->discountRates()->first()->toArray();
        $creditCard = $customer->creditCards()->first()->toArray();
        $creditCard['cc_expiry_date'] = $creditCard['expiry_date'];
        $termFee = $customer->termFees()->first()->toArray();

        $customer = $customer->toArray();

        unset($main['id'], $mainContact['id'], $basic['id'], $general['id'], $generalDoc['id'], $discRate['id'], $creditCard['id'], $termFee['id']);

        $arrayMerge = array_merge($customer, $main, $mainContact, $basic, $general, $generalDoc, $discRate, $creditCard, $termFee);


        $customer = (object) $arrayMerge;
        return view('contents.business.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Customer\MasterCustomer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterCustomer $customer)
    {
        if (@$request->is_draft == 'false') {
            $request->merge(['is_draft' => false]);
            $msgSuccess = 'Data is successfully published';
        } else {
            $msgSuccess = 'Data is successfully updated';
            $request->merge(['is_draft' => true]);
        }

        $update = $customer->update($request->all());
        if ($update) {
            $input = $request->all();
            $input['customer_id'] = $customer->id;

            $main = $customer->mains()->first();
            $main->update($input);

            $mainContact = $customer->mains()->first()->contacts()->first();
            $mainContact->update($input);

            $basic = $customer->basics()->first();
            $basic->update($input);

            $general = $customer->generals()->first();
            $general->update($input);
            
            $generalDoc = $customer->generals()->first()->docs()->first();
            $generalDoc->update($input);

            $discountrate = $customer->discountRates()->first();
            $discountrate->update($input);

            $creditcard = $customer->creditCards()->first();
            $input['expiry_date'] = $input['cc_expiry_date'];
            $creditcard->update($input);

            $termfee = $customer->termFees()->first();
            $termfee->update($input);

            flash()->success('Data is successfully updated');
            return redirect()->route('customer.index');
        }

        flash()->error('<strong>Whoops! </strong> Something went wrong');        
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\Customer\MasterCustomer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCustomer $customer)
    {
        if ($customer->transactions) {
            flash()->error(trans('message.have_related'));
        } else {
            $destroy = $customer->delete();
            flash()->success('Data is successfully deleted');
        }
        
        return redirect()->route('customer.index');
    }
}
