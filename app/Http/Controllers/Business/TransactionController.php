<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\TransactionDataTable;
use App\Models\Business\Customer;
use App\Http\Requests\Business\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('contents.business.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::getDataByCompany(@user_info()->company->id)
            ->pluck('customers.name', 'customers.id')->all();
        return view('contents.business.transaction.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Business\TransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        \DB::beginTransaction();
        try {
            $findCustomer = Customer::find($request->customer_id);
            $companyId = $findCustomer->company->id;
            
            $request->merge(['company_id' => $companyId]);

            $insert = Transaction::create($request->all());
            if ($insert) {
                flash()->success(trans('message.create.success'));
                \DB::commit();
                return redirect()->route('transaction.index');
            }
            
            flash()->error(trans('message.create.error'));
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            flash()->error(trans('message.error'));
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Business\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        
        $customers = $transaction->customer()
            ->pluck('name', 'id')->all();
        return view('contents.business.transaction.edit', compact('customers', 'transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Business\TransactionRequest  $request
     * @param  \App\Models\Business\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $updateTransaction = $transaction->update($request->all());
        flash()->success(trans('message.update.success'));
        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        // if ($transaction->status == 0) {
            $transaction->delete();
            flash()->success(trans('message.delete.success'));
        // } else {

        // }
    }

    /**
     * Approve the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $findTransaction = Transaction::find($id);
        if ($findTransaction) {
            $findTransaction->update(['status' => Transaction::APPROVE]);
            flash()->success(trans('message.approve'));
        } else {
            flash()->error(trans('message.not_found'));
        }

        return redirect()->back();
    }

    /**
     * Reject the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $findTransaction = Transaction::find($id);
        if ($findTransaction) {
            $findTransaction->update(['status' => Transaction::REJECT]);
            flash()->success(trans('message.reject'));
        } else {
            flash()->error(trans('message.not_found'));
        }

        return redirect()->back();
    }
}
