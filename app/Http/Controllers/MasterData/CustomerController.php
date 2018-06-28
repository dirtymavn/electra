<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\Master\Company;
use App\Models\Master\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\CustomerDataTable;
use App\Http\Requests\MasterData\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * @var \App\Models\MasterData\Customer\MasterCustomer
     * @var \App\Models\Master\Company
    */
    protected $masterCustomer;
    protected $companies;
    protected $countries;

    /**
     * Create a new CustomerController instance.
     *
     * @param \App\Models\MasterData\Customer\MasterCustomer  $masterCustomer
     * @param \App\Models\Master\Company  $companies
    */
    public function __construct(MasterCustomer $masterCustomer, Company $companies, Country $countries)
    {
        $this->masterCustomer = $masterCustomer;
        $this->companies = $companies;
        $this->countries = $countries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->companies->all()->pluck('name', 'id');
        $meals = $this->masterCustomer->meals();
        $countries = $this->countries->pluck('name', 'id');
        return view('contents.master_datas.customer.create', compact('companies', 'meals', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
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
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
            }

            $insert = $this->masterCustomer->create($request->all());
            
            if ($insert) {
                $redirect = redirect()->route('customer.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('customer.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('customer.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
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
     * @param  \App\Models\MasterData\Customer\MasterCustomer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCustomer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Customer\MasterCustomer  $customer
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
        $companies = $this->companies->all()->pluck('name', 'id');
        $meals = $this->masterCustomer->meals();
        $countries = $this->countries->pluck('name', 'id');
        return view('contents.master_datas.customer.edit', compact('customer', 'companies', 'meals', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CustomerRequest  $request
     * @param  \App\Models\MasterData\Customer\MasterCustomer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, MasterCustomer $customer)
    {
        if (@$request->is_draft == 'false') {
            $request->merge(['is_draft' => false]);
            $msgSuccess = trans('message.published');
            $redirect = redirect()->route('customer.index');
        } elseif (@$request->is_publish_continue == 'true') {
            $request->merge(['is_draft' => false]);
            $msgSuccess = trans('message.published_continue');
            $redirect = redirect()->route('customer.create');
        } else {
            $msgSuccess = trans('message.update.success');
            $redirect = redirect()->route('customer.edit', $customer->id);
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

            flash()->success($msgSuccess);
            return $redirect;
        }

        flash()->error('<strong>Whoops! </strong> Something went wrong');        
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Customer\MasterCustomer  $customer
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
            MasterCustomer::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('customer.index');
    }
}
