<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Hotel\HotelChain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\HotelChainDataTable;
use App\Http\Requests\MasterData\HotelChainRequest;

class HotelChainController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,hotel-chain.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,hotel-chain.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,hotel-chain.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,hotel-chain.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HotelChainDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.hotel_chain.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.hotel_chain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\HotelChainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelChainRequest $request)
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
            $insert = HotelChain::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('hotel-chain.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('hotel-chain.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('hotel-chain.create');
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
     * @param  \App\Models\MasterData\HotelChain  $HotelChain
     * @return \Illuminate\Http\Response
     */
    public function show(HotelChain $HotelChain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\HotelChain  $HotelChain
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelChain $HotelChain)
    {
        return view('contents.master_datas.hotel_chain.edit')->with(['hotelchain' => $HotelChain]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\HotelChainRequest  $request
     * @param  \App\Models\MasterData\HotelChain  $HotelChain
     * @return \Illuminate\Http\Response
     */
    public function update(HotelChainRequest $request, HotelChain $HotelChain)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('hotel-chain.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('hotel-chain.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('hotel-chain.edit', $HotelChain->id);
            }

            $update = $HotelChain->update($request->all());

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
     * @param  \App\Models\MasterData\HotelChain  $HotelChain
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelChain $HotelChain)
    {
        $HotelChain->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('hotel-chain.index');
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
            HotelChain::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('hotel-chain.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = HotelChain::select('*')->get();
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
        $types = HotelChain::all();
        $pdf = \PDF::loadView('contents.master_datas.hotel_chain.pdf', compact('types'));
        return $pdf->download('hotel-chain.pdf');
    }
}
