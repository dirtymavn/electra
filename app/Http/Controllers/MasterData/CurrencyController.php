<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Currency\Currency;
use App\Models\MasterData\Currency\CurrencyRate;
use App\Models\Temporary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\CurrencyRateDataTable;
use App\Http\Requests\MasterData\CurrencyRequest;

class CurrencyController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,currencyrate.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,currencyrate.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,currencyrate.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,currencyrate.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CurrencyRateDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.currency_rate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        return view('contents.master_datas.currency_rate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = Currency::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('currencyrate.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('currencyrate.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('currencyrate.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Currency\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Currency\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency, $id)
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();

        $currency = Currency::find($id);

        foreach ($currency->rates as $rate) {
            $data = [
                'rate' => $rate->rate
            ];

            Temporary::create([
                'type' => 'data-currency',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        return view('contents.master_datas.currency_rate.edit')->with(['currencyrate' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CurrencyRequest  $request
     * @param  \App\Models\MasterData\Currency\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency, $id)
    {
        $currency = Currency::find($id);

        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('currencyrate.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('currencyrate.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('currencyrate.edit', $currency->id);
            }

            $update = $currency->update($request->all());

            if ($update) {
                $rates =  $currency->rates;
                foreach ($rates as $value) {
                    $value->delete();
                }
                $currencys = \DB::table('temporaries')->whereType('data-currency')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($currencys) > 0) {
                    foreach ($currencys as $val) {
                        $value = json_decode($val->data);

                        $rate = new CurrencyRate;
                        $rate->currency_from_id = $currency->id;
                        $rate->currency_to_id = $currency->id;
                        $rate->rate = $value->rate;

                        $rate->save();
                    }
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Currency\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency, $id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('currencyrate.index');
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
            Currency::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('currencyrate.index');
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
            ->addColumn('action', function ($currencyrate) use($request) {
                return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="'.$request->type.'" data-id="' . $currencyrate['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                                        <a href="javascript:void(0)" class="danger deleteData" data-element="'.$request->type.'" title="Delete" data-id="' . $currencyrate['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function currencyrateStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->currencyrate_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->currencyrate_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'data-currency',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'currencyrate_id']))
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
}
