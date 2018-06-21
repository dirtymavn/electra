<?php

namespace App\Http\Controllers\Business;

use App\Models\Business\Voucher\MasterVoucher as Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Business\VoucherDataTable;

use DB;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VoucherDataTable $dataTable)
    {
        return $dataTable->render('contents.business.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.business.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
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

            $insert = Voucher::create( $request->all() );

            if ($insert) {
                $redirect = redirect()->route('voucher.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('voucher.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('voucher.create');
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
     * @param  \App\Models\Business\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Business\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        return view('contents.business.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Business\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('voucher.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('voucher.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('voucher.index');
            }
           
            $insert = $voucher->update( $request->all() );
            
            if ($insert) {
                \DB::commit();
                flash()->success($msgSuccess);
                return $redirect;
            } else {
                flash()->error('Data is failed to updated');
                return redirect()->back()->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {
            
            DB::rollback();
            flash()->error('Data is failed to updated');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Business\voucher\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        if ($voucher->transactions) {
            flash()->error(trans('message.have_related'));
        } else {
            $destroy = $voucher->delete();
            flash()->success('Data is successfully deleted');
        }
        
        return redirect()->route('voucher.index');
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
            Voucher::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('voucher.index');
    }
}
