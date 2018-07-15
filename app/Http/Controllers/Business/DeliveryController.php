<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\DeliveryDataTable;

use App\Models\Business\Delivery\TrxDeliveryOrder as TrxDelivery;
use App\Models\Business\Delivery\DoType;


class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DeliveryDataTable $dataTable)
    {
        return $dataTable->render('contents.business.delivery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dotypes = DoType::where('is_draft', false)->pluck('do_type_name', 'id')->all();
        return view('contents.business.delivery.create', compact('dotypes'));
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

            $request->merge(['company_id' => @user_info()->company->id]);
            $insert = TrxDelivery::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('delivery.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('delivery.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('delivery.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery = TrxDelivery::find($id);
        $deliveries = TrxDelivery::find($id)->toArray();
        $trx_customer = $delivery->trx_customer->toArray();
        $trx_dispatch = $delivery->trx_dispatch->toArray();
        $dotypes = DoType::where('company_id', user_info()->company_id)->pluck('do_type_name', 'id')->all();
        unset($trx_customer['id'], $trx_customer['created_at'], $trx_customer['updated_at'], $trx_dispatch['id'], $trx_dispatch['created_at'], $trx_dispatch['updated_at']);
        $arrayMerge = array_merge($trx_customer, $trx_dispatch, $deliveries);
        $delivery = (object) $arrayMerge;

        return view('contents.business.delivery.edit', compact('delivery', 'dotypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            $insert = TrxDelivery::find($id)->update($request->all());

            if ($insert) {
                $redirect = redirect()->route('delivery.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('delivery.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('delivery.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $delivery = TrxDelivery::find($id);
        $delivery->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('delivery.index');
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
            TrxDelivery::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('delivery.index');
    }
}
