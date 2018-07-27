<?php

namespace App\Http\Controllers\MasterData\Accounting;

use App\Models\MasterData\Accounting\MasterCoa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\Accounting\MasterCoaDataTable;

class MasterCoaController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,account.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,account.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,account.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,account.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MasterCoaDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.accountings.account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.accountings.account.create');
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
            $insert = MasterCoa::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('account.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('account.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('account.create');
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
     * @param  \App\Models\MasterData\Accounting\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCoa $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Accounting\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCoa $account)
    {
        return view('contents.master_datas.accountings.account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Accounting\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterCoa $account)
    {
         \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('account.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('account.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('account.edit', $account->id);
            }

            $update = $account->update($request->all());

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
     * @param  \App\Models\MasterData\Accounting\MasterCoa  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterCoa $account)
    {
        $account->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('account.index');
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
            MasterCoa::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('account.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $trx = MasterCoa::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($trx) {
            $excel->sheet('Sheet 1', function($sheet) use ($trx) {
                $sheet->fromArray($trx);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $trxs = MasterCoa::all();
        $pdf = \PDF::loadView('contents.master_datas.accountings.account.pdf', compact('trxs'));
        return $pdf->download('accounting-trx.pdf');
    }
}
