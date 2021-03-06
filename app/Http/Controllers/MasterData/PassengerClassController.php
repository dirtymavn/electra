<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\PassengerClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\PassengerClassDataTable;

class PassengerClassController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,passenger.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,passenger.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,passenger.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,passenger.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PassengerClassDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.passenger_class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = PassengerClass::classTypes();
        return view('contents.master_datas.passenger_class.create', compact('types'));
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
            $insert = PassengerClass::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('passenger.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('passenger.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('passenger.create');
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
     * @param  \App\Models\MasterData\PassengerClass  $passengerClass
     * @return \Illuminate\Http\Response
     */
    public function show(PassengerClass $passengerClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\PassengerClass  $passengerClass
     * @return \Illuminate\Http\Response
     */
    public function edit(PassengerClass $passengerClass, $id)
    {
        $passenger = PassengerClass::find($id);
        $types = PassengerClass::classTypes();
        return view('contents.master_datas.passenger_class.edit', compact('passenger', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\PassengerClass  $passengerClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PassengerClass $passengerClass, $id)
    {
        \DB::beginTransaction();
        try {
            $passengerClass = PassengerClass::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('passenger.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('passenger.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('passenger.edit', $passengerClass->id);
            }

            $update = $passengerClass->update($request->all());

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
     * @param  \App\Models\MasterData\PassengerClass  $passengerClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(PassengerClass $passengerClass, $id)
    {
        $passengerClass = PassengerClass::find($id);
        $passengerClass->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('passenger.index');
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
            PassengerClass::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('passenger.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $passenger = PassengerClass::select('*')->get();
        \Excel::create('testing-'.date('Ymd'), function($excel) use ($passenger) {
            $excel->sheet('Sheet 1', function($sheet) use ($passenger) {
                $sheet->fromArray($passenger);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $passengers = PassengerClass::all();
        $pdf = \PDF::loadView('contents.master_datas.passenger_class.pdf', compact('passengers'));
        return $pdf->download('passenger-class.pdf');
    }
}
