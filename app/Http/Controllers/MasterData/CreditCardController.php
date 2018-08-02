<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\CreditCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\CreditCardDataTable;
use App\Http\Requests\MasterData\CreditCardRequest;

class CreditCardController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,credit-card.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,credit-card.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,credit-card.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,credit-card.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CreditCardDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.credit_card.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.credit_card.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CreditCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditCardRequest $request)
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
            $insert = CreditCard::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('credit-card.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('credit-card.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('credit-card.create');
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
     * @param  \App\Models\MasterData\CreditCard  $CreditCard
     * @return \Illuminate\Http\Response
     */
    public function show(CreditCard $CreditCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\CreditCard  $CreditCard
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditCard $CreditCard)
    {
        return view('contents.master_datas.credit_card.edit')->with(['creditcard' => $CreditCard]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CreditCardRequest  $request
     * @param  \App\Models\MasterData\CreditCard  $CreditCard
     * @return \Illuminate\Http\Response
     */
    public function update(CreditCardRequest $request, CreditCard $CreditCard)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('credit-card.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('credit-card.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('credit-card.edit', $CreditCard->id);
            }

            $update = $CreditCard->update($request->all());

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
     * @param  \App\Models\MasterData\CreditCard  $CreditCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditCard $CreditCard)
    {
        $CreditCard->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('credit-card.index');
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
            CreditCard::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('credit-card.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = CreditCard::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($type) {
            $excel->sheet('Sheet 1', function($sheet) use ($type) {
                $sheet->fromArray($type);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $types = CreditCard::all();
        $pdf = \PDF::loadView('contents.master_datas.credit_card.pdf', compact('types'));
        return $pdf->download('credit-card.pdf');
    }
}
