<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting\AccountingConfig\AccountingConfig;
use App\Models\Setting\AccountingConfig\AccountingConfigDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Setting\AccountingConfigDataTable;
use App\Models\Setting\CoreForm;
use App\Models\MasterData\Accounting\MasterCoa;

class AccountingConfigController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,accounting-config.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,accounting-config.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,accounting-config.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,accounting-config.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccountingConfigDataTable $dataTable)
    {
        return $dataTable->render('contents.settings.accounting_config.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coreForms = CoreForm::select('core_forms.id', 'core_forms.name as text')
            ->where('core_forms.type', '<>', 'Core')
            ->pluck('text', 'id')->all();
        return view('contents.settings.accounting_config.create', compact('coreForms'));
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
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);

            $insert = AccountingConfig::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('accounting-config.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('accounting-config.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('accounting-config.create');
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting\AccountingConfig\AccountingConfig  $accountingConfig
     * @return \Illuminate\Http\Response
     */
    public function show(AccountingConfig $accountingConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting\AccountingConfig\AccountingConfig  $accountingConfig
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountingConfig $accountingConfig)
    {
        // wew($accountingConfig->details);
        $coreForms = CoreForm::select('core_forms.id', 'core_forms.name as text')
            ->where('core_forms.type', '<>', 'Core')
            ->pluck('text', 'id')->all();
        return view('contents.settings.accounting_config.edit', compact('accountingConfig', 'coreForms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting\AccountingConfig\AccountingConfig  $accountingConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountingConfig $accountingConfig)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('accounting-config.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('accounting-config.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('accounting-config.edit', $accountingConfig->id);
            }

            $update = $accountingConfig->update($request->all());

            if ($update) {
                foreach ($accountingConfig->details as $value) {
                    $value->delete();
                }

                foreach ($request->config_detail['coa'] as $key => $coa) {
                    AccountingConfigDetail::create([
                        'accounting_config_id' => $accountingConfig->id,
                        'master_coa_id' => $coa,
                        'type' => $request->config_detail['type'][$key],
                        'value' => $request->config_detail['value'][$key],
                    ]);
                }

                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->error(trans('message.error') . ' : ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting\AccountingConfig\AccountingConfig  $accountingConfig
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountingConfig $accountingConfig)
    {
        $accountingConfig->delete();
        flash()->success(trans('message.delete.success'));
        return redirect()->route('accounting-config.index');
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
            AccountingConfig::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('accounting-config.index');
    }
}
