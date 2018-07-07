<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Airport;
use App\Models\MasterData\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\AirportDataTable;
use App\Http\Requests\MasterData\AirportRequest;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AirportDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.airport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::getDataAvailable()->pluck('city_name', 'id')->all();
        return view('contents.master_datas.airport.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\AirportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AirportRequest $request)
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
            $insert = Airport::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('airport.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('airport.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('airport.create');
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
     * @param  \App\Models\MasterData\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function edit(Airport $airport)
    {
        $cities = City::getDataAvailable()->pluck('city_name', 'id')->all();
        $myCity = $airport->city()->pluck('city_name', 'id')->all();

        if (count($cities) > 0) {
            foreach ($myCity as $key => $value) {
                $cities[$key] = $value;
            }
        } else {
            $cities = $myCity;
        }

        return view('contents.master_datas.airport.edit', compact('airport', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\AirportRequest  $request
     * @param  \App\Models\MasterData\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function update(AirportRequest $request, Airport $airport)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('airport.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('airport.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('airport.edit', $airport->id);
            }

            $update = $airport->update($request->all());

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
     * @param  \App\Models\MasterData\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('airport.index');
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
            Airport::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('airport.index');
    }
}
