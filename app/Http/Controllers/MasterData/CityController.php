<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\City;
use App\Models\MasterData\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\CityDataTable;
use App\Http\Requests\MasterData\CityRequest;

class CityController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,city.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,city.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,city.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,city.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.city.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::getDataByCompany()->pluck('country_name', 'id')->all();
        return view('contents.master_datas.city.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CityRequest  $request
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
            $insert = City::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('city.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('city.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('city.create');
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
     * @param  \App\Models\MasterData\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::getDataByCompany()->pluck('country_name', 'id')->all();
        return view('contents.master_datas.city.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\CityRequest  $request
     * @param  \App\Models\MasterData\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('city.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('city.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('city.edit', $city->id);
            }

            $update = $city->update($request->all());

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
     * @param  \App\Models\MasterData\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('city.index');
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
            City::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('city.index');
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchData(Request $request)
    {
        $results = City::getAvailableData()
            ->select(\DB::raw("(cities.id ||'/'|| countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as slug"), 
                \DB::raw("(countries.country_name || '-' || cities.city_name || '-' || cities.city_code) as text"))
            ->where('cities.city_name', 'ilike', '%'.$request->search.'%')
            ->get();

        return response()->json(['message' => 'Success', 'items' => $results]);
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchDataNormal(Request $request)
    {
        $results = City::getAvailableData()
            ->select("cities.city_code as slug", \DB::raw("(cities.city_name || '-' || cities.city_code) as text"))
            ->where('cities.city_name', 'ilike', '%'.$request->search.'%')
            ->get();

        return response()->json(['message' => 'Success', 'items' => $results]);
    }

    /**
     * Search data by country
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchByCountry(Request $request)
    {
        $results = City::getAvailableData()
            ->where('cities.country_id', $request->country_id)
            ->get();

        return json_encode($results);
    }

    public function searchDataCity(Request $request)
    {
        $results = City::getAvailableData()
            ->select('cities.id', 'cities.city_name as text')
            ->where('cities.city_name', 'ilike', '%'.$request->search.'%')
            ->get();

        return response()->json(['message' => 'Success', 'items' => $results]);
    }
}
