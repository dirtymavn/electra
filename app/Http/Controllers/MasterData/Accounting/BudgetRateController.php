<?php

namespace App\Http\Controllers\MasterData\Accounting;

use App\Models\Budget\BudgetRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Budget\BudgetRateDataTable;
use App\Http\Requests\Budget\BudgetRateRequest;

class BudgetRateController extends Controller
{
    /**
     * @var App\Models\Budget\BudgetRate
    */
    protected $budgetRate;

    /**
     * Create a new BudgetRateController instance.
     *
     * @param \App\Models\Budget\BudgetRate  $budgetRate
    */
    public function __construct(BudgetRate $budgetRate)
    {
        $this->budgetRate = $budgetRate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BudgetRateDataTable $dataTable)
    {
        return $dataTable->render('contents.budgets.budget_rate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.budgets.budget_rate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Budget\BudgetRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetRateRequest $request)
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

            $insert = $this->budgetRate->create($request->all());

            if ($insert) {
                $redirect = redirect()->route('budget-rate.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('budget-rate.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('budget-rate.create');
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
     * @param  \App\Models\Budget\BudgetRate  $budgetrate
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetRate $budgetrate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget\BudgetRate  $budgetRate
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetRate $budgetRate)
    {
        return view('contents.budgets.budget_rate.edit', compact('budgetRate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Budget\BudgetRateRequest  $request
     * @param  \App\Models\Budget\BudgetRate  $budgetRate
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetRateRequest $request, BudgetRate $budgetRate)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('budget-rate.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('budget-rate.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('budget-rate.edit', $budgetRate->id);
            }

            $update = $budgetRate->update($request->all());

            if ($update) {

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
     * @param  \App\Models\Budget\BudgetRate  $budgetRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetRate $budgetRate)
    {
        if ($budgetRate->delete()) {
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->error(trans('message.delete.error'));
        }

        return redirect()->route('budget-rate.index');

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
            BudgetRate::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('budget-rate.index');
    }
}
