<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Customer\MasterCustomer;
use App\Models\MasterData\Customer\MasterCustomerCreditCard;
use App\Models\Master\Company;
use App\Models\Master\Country;
use App\Models\Temporary;
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

        // middleware
        $this->middleware('sentinel_access:admin.company,customer.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,customer.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,customer.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,customer.destroy', ['only' => ['destroy']]);

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
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->whereType('customer-creditcard')->delete();

        if (user_info()->inRole('super-admin')) {
            $companies = $this->companies->all()->pluck('name', 'id');
        } else {
            $companies = user_info()->company()->pluck('name', 'id')->all();
        }
        $meals = $this->masterCustomer->meals();
        $countries = $this->countries->pluck('name', 'name');
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
            $request->merge([ 'customer_no' => randomString(), 'company_id' =>  @user_info()->company->id ]);
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
            flash()->error('<strong>Whoops! </strong> Something went wrong '.$e->getMessage());
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
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->whereType('customer-creditcard')->delete();

        $main = $customer->mains()->first()->toArray();
        $mainContact = $customer->mains()->first()->contacts()->first()->toArray();
        $basic = $customer->basics()->first()->toArray();
        $general = $customer->generals()->first()->toArray();
        $generalDoc = $customer->generals()->first()->docs()->first()->toArray();
        $discRate = $customer->discountRates()->first()->toArray();

        foreach ($customer->creditCards as $creditCard) {
            $data = [
                'card_type' => $creditCard->card_type,
                'merchant_no' => $creditCard->merchant_no,
                'merchant_no_int' => $creditCard->merchant_no_int,
                'credit_card_no' => $creditCard->credit_card_no,
                'cc_expiry_date' => $creditCard->expiry_date,
                'cardholder_name' => $creditCard->cardholder_name,
                'bill_type' => $creditCard->bill_type,
                'preferred_card' => ($creditCard->preferred_card) ? '1' : '0',
                'sof' => $creditCard->sof,
                'cc_remark' => $creditCard->remark
            ];

            Temporary::create([
                'type' => 'customer-creditcard',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $termFee = $customer->termFees()->first()->toArray();

        $customer = $customer->toArray();

        unset($main['id'], $mainContact['id'], $basic['id'], $general['id'], $generalDoc['id'], $discRate['id'], $termFee['id']);

        $arrayMerge = array_merge($customer, $main, $mainContact, $basic, $general, $generalDoc, $discRate, $termFee);


        $customer = (object) $arrayMerge;
        if (user_info()->inRole('super-admin')) {
            $companies = $this->companies->all()->pluck('name', 'id');
        } else {
            $companies = user_info()->company()->pluck('name', 'id')->all();
        }

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

            $creditCards =  $customer->creditCards;
            foreach ($creditCards as $value) {
                $value->delete();
            }

            $creditCards = \DB::table('temporaries')->whereType('customer-creditcard')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($creditCards) > 0) {
                foreach ($creditCards as $creditCard) {
                    $creditCard = json_decode($creditCard->data);

                    $cc = new MasterCustomerCreditCard;

                    $cc->customer_id = $customer->id;
                    $cc->card_type = $creditCard->card_type;
                    $cc->merchant_no = $creditCard->merchant_no;
                    $cc->merchant_no_int = $creditCard->merchant_no_int;
                    $cc->credit_card_no = $creditCard->credit_card_no;
                    $cc->expiry_date = $creditCard->cc_expiry_date;
                    $cc->cardholder_name = $creditCard->cardholder_name;
                    $cc->bill_type = $creditCard->bill_type;
                    $cc->preferred_card = $creditCard->preferred_card;
                    $cc->sof = $creditCard->sof;
                    $cc->remark = $creditCard->cc_remark;

                    $cc->save();
                }
            }

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
        if ($customer->transactions || $customer->orders) {
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

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $datas = [];
        $results = \DB::table('temporaries')->whereType($request->type)
            ->whereUserId(user_info('id'))
            ->select('id','data')
            ->get();

        if (count($results) > 0) {
            foreach ($results as $result) {
                $value = collect(json_decode($result->data))->toArray();
                
                $value['id'] = $result->id;

                array_push($datas, $value);
            }
        }

        $datas = collect($datas);

        return datatables()->of($datas)
            ->addColumn('action', function ($customer) use($request) {
                return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="'.$request->type.'" data-id="' . $customer['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                        <a href="javascript:void(0)" class="danger deleteData" data-element="'.$request->type.'" title="Delete" data-id="' . $customer['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->editColumn('preferred_card', function ($customer) use($request) {
                return ($customer['preferred_card']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->editColumn('sof', function ($customer) use($request) {
                return ($customer['sof']) ? '<div class="status-pill green" data-title="Yes" data-toggle="tooltip" data-original-title="" title=""></div>' : '<div class="status-pill red" data-title="No" data-toggle="tooltip" data-original-title="" title=""></div>';
            })
            ->rawColumns(['preferred_card', 'sof', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerCreditCardStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->customer_creditcard_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->customer_creditcard_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'customer-creditcard',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'customer_creditcard_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Delete resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete(); 
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    /**
     * Get detail resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchData(Request $request)
    {
        $results = MasterCustomer::getAvailableData()
            ->select('master_customers.id', 'master_customers.customer_name as text')
            ->where('master_customers.customer_name', 'ilike', '%'.$request->search.'%')
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCustomerById(Request $request)
    {
        $customer = MasterCustomer::find($request->id);

        $main = $customer->mains()->first()->toArray();
        $mainContact = $customer->mains()->first()->contacts()->first()->toArray();
        $basic = $customer->basics()->first()->toArray();
        $general = $customer->generals()->first()->toArray();
        $generalDoc = $customer->generals()->first()->docs()->first()->toArray();
        $discRate = $customer->discountRates()->first()->toArray();

        $termFee = $customer->termFees()->first()->toArray();

        $customer = $customer->toArray();

        unset($main['id'], $mainContact['id'], $basic['id'], $general['id'], $generalDoc['id'], $discRate['id'], $termFee['id']);

        $arrayMerge = array_merge($customer, $main, $mainContact, $basic, $general, $generalDoc, $discRate, $termFee);


        $customer = (object) $arrayMerge;

        return json_encode($customer);
    }
}
