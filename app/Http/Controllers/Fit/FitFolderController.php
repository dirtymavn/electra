<?php

namespace App\Http\Controllers\Fit;

use App\Models\Fit\TrxFitFolder\FitFolder;
use App\Models\Fit\TrxFitFolder\FitfolderDetail;
use App\Models\Fit\TrxFitFolder\FitfolderService;
use App\Models\Fit\TrxFitFolder\FitfolderRate;
use App\Models\Fit\TrxFitFolder\FitfolderItinerary;
use App\Models\Fit\TrxFitFolder\FitfolderGuide;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Fit\FitFolderDataTable;
use App\Http\Requests\Fit\FitFolderRequest;
use App\Models\MasterData\Branch;
use App\Models\MasterData\Currency\Currency;
use App\Models\MasterData\Supplier\MasterSupplier;
use App\Models\MasterData\Outbound\Guide\MasterTourGuide;
use App\Models\MasterData\Inventory\MasterInventory as Inventory;
use App\Models\MasterData\Airline;
use App\Models\Temporary;

class FitFolderController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,fitfolder.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,fitfolder.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,fitfolder.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,fitfolder.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FitFolderDataTable $dataTable)
    {
        return $dataTable->render('contents.fits.tour_folder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $newCode = '';
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')->all();
        $databranch = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $datainventory = Inventory::getAvailableData()->pluck('inventory_type_id', 'master_inventory.id');
        $datacurrency = Currency::getAvailableData()->pluck('currency_name', 'currency.id');
        $suppliers = MasterSupplier::getAvailableData()->pluck('master_supplier.name', 'master_supplier.id')
            ->all();

        if (count($suppliers) == 0) {
            $suppliers = ['' => '- Not Available -'];
        }
        $dataguide = MasterTourGuide::getAvailableData()->pluck('master_tour_guides.guide_code', 'master_tour_guides.id')
            ->all();

        if (count($dataguide) == 0) {
            $dataguide = ['' => '- Not Available -'];
        }

        return view('contents.fits.tour_folder.create', compact('newCode','dataairline','databranch','datacurrency','suppliers','dataguide','datainventory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Outbound\FitFolderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FitFolderRequest $request)
    {
        \DB::beginTransaction();
        try {

            $newCode = FitFolder::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'fit_code' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'fit_code' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
            $insert = FitFolder::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('fitfolder.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('fitfolder.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('fitfolder.create');
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
     * @param  \App\Models\Outbound\FitFolder  $FitFolder
     * @return \Illuminate\Http\Response
     */
    public function show(FitFolder $FitFolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outbound\FitFolder  $FitFolder
     * @return \Illuminate\Http\Response
     */
    public function edit(FitFolder $fitfolder)
    {
        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $parent = $fitfolder->toArray();

        foreach ($fitfolder->fitfolderService as $key => $value) {
            $data = [
                'id_fit_folder' => $fitfolder->id,
                'id_product' => $value->id_product,
                'service_type' => $value->service_type,
                'charge_method' => $value->charge_method,
                'id_currency' => $value->id_currency,
                'id_supplier' => $value->id_supplier,
                'notes' => $value->notes
            ];
            Temporary::create([
                'type' => 'fitfolderservice-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($fitfolder->fitfolderGuide as $key => $value) {
            $data = [
                'id_tour_guide' => $fitfolder->id,
                'from_date' => $value->from_date,
                'to_date' => $value->to_date,
                'guide_number' => $value->guide_number,
                'title' => $value->title,
                'name' => $value->name,
                'notes' => $value->notes,
                'cash_advance' => $value->cash_advance,
                'cash_return' => $value->cash_return
            ];
            Temporary::create([
                'type' => 'fitfolderguide-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($fitfolder->fitfolderItinerary as $key => $value) {
            $data = [
                'id_fit_folder' => $fitfolder->id,
                'day' => $value->day,
                'itinerary_code' => $value->itinerary_code,
                'city' => $value->city,
                'description' => $value->description,
                'operator' => $value->operator,
                'breakfast' => $value->breakfast,
                'lunch' => $value->lunch,
                'dinner' => $value->dinner,
                'accomodation' => $value->accomodation,
                'notes' => $value->notes,
                'transport_detail' => $value->transport_detail
            ];
            Temporary::create([
                'type' => 'fitfolderitinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($fitfolder->fitfolderRate as $key => $value) {
            $data = [
                'id_fit_folder' => $fitfolder->id,
                'customer_type' => $value->customer_type,
                'price_type' => $value->price_type,
                'group_size' => $value->group_size,
                'price' => $value->price,
                'discount' => $value->discount
            ];
            Temporary::create([
                'type' => 'fitfolderrate-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $tourDetail = $fitfolder->fitfolderDetail->toArray();
        unset($tourDetail['id']);
        
        $arrayMerge = array_merge($parent,$tourDetail);
        
        $fitfolder = (object)$arrayMerge;

        $newCode = '';
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')->all();
        $databranch = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $datainventory = Inventory::getAvailableData()->pluck('inventory_type_id', 'master_inventory.id');
        $datacurrency = Currency::getAvailableData()->pluck('currency_name', 'currency.id');
        $suppliers = MasterSupplier::getAvailableData()->pluck('master_supplier.name', 'master_supplier.id')
            ->all();

        if (count($suppliers) == 0) {
            $suppliers = ['' => '- Not Available -'];
        }
        $dataguide = MasterTourGuide::getAvailableData()->pluck('master_tour_guides.guide_code', 'master_tour_guides.id')
            ->all();

        if (count($dataguide) == 0) {
            $dataguide = ['' => '- Not Available -'];
        }
        
        return view('contents.fits.tour_folder.edit', compact('fitfolder','newCode','dataairline','databranch','datacurrency','suppliers','dataguide','datainventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Outbound\FitFolderRequest  $request
     * @param  \App\Models\Outbound\FitfOlder  $TourFolder
     * @return \Illuminate\Http\Response
     */
    public function update(FitFolderRequest $request, FitFolder $fitfolder)
    {

        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('fitfolder.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('fitfolder.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('fitfolder.edit', $fitfolder->id);
            }

            $update = $fitfolder->update($request->all());

            if ($update) {
                $input = $request->all();
                $input['id_fit_folder'] = $fitfolder->id;

                $datatourdetail = $fitfolder->fitfolderDetail;
                $datatourdetail->update($input);


                $datatourservice =  $fitfolder->fitfolderService;
                foreach ($datatourservice as $value) {
                    $value->delete();
                }
                $Fitfolderservice = \DB::table('temporaries')->whereType('fitfolderservice-detail')
                ->whereUserId(user_info('id'))
                ->get();
                if (count($Fitfolderservice) > 0) {
                foreach ($Fitfolderservice as $Fitfolderservicevalue) {
                        $FitfolderserviceData = json_decode($Fitfolderservicevalue->data);

                        $tourservice = new FitfolderService;
                        $tourservice->id_fit_folder = $fitfolder->id;
                        $tourservice->id_product = $FitfolderserviceData->id_product;
                        $tourservice->service_type = $FitfolderserviceData->service_type;
                        $tourservice->charge_method = $FitfolderserviceData->charge_method;
                        $tourservice->id_currency = $FitfolderserviceData->id_currency;
                        $tourservice->id_supplier = $FitfolderserviceData->id_supplier;
                        $tourservice->notes = $FitfolderserviceData->notes;
                        $tourservice->company_id = user_info('company_id');
                        $tourservice->save();
                    }
                }

                $datatourrate =  $fitfolder->FitfolderRate;
                foreach ($datatourrate as $value) {
                    $value->delete();
                }
                $Fitfolderrate = \DB::table('temporaries')->whereType('fitfolderrate-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Fitfolderrate) > 0) {
                    foreach ($Fitfolderrate as $Fitfolderratevalue) {
                        $FitfolderrateData = json_decode($Fitfolderratevalue->data);

                        $tourrate = new FitfolderRate;
                        $tourrate->id_fit_folder = $fitfolder->id;
                        $tourrate->customer_type = $FitfolderrateData->customer_type;
                        $tourrate->price_type = $FitfolderrateData->price_type;
                        $tourrate->group_size = $FitfolderrateData->group_size;
                        $tourrate->price = $FitfolderrateData->price;
                        $tourrate->discount = $FitfolderrateData->discount;
                        $tourrate->company_id = user_info('company_id');
                        $tourrate->save();
                    }
                }


                $datatouritinerary =  $fitfolder->FitfolderItinerary;
                foreach ($datatouritinerary as $value) {
                    $value->delete();
                }
                $Fitfolderitinerary = \DB::table('temporaries')->whereType('fitfolderitinerary-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Fitfolderitinerary) > 0) {
                    foreach ($Fitfolderitinerary as $Fitfolderitineraryvalue) {
                        $FitfolderitineraryData = json_decode($Fitfolderitineraryvalue->data);

                        $touritinerary = new FitfolderItinerary;
                        $touritinerary->id_fit_folder = $fitfolder->id;
                        $touritinerary->day = $FitfolderitineraryData->day;
                        $touritinerary->itinerary_code = $FitfolderitineraryData->itinerary_code;
                        $touritinerary->city = $FitfolderitineraryData->city;
                        $touritinerary->description = $FitfolderitineraryData->description;
                        $touritinerary->operator = $FitfolderitineraryData->operator;
                        $touritinerary->breakfast = $FitfolderitineraryData->breakfast;
                        $touritinerary->lunch = $FitfolderitineraryData->lunch;
                        $touritinerary->dinner = $FitfolderitineraryData->dinner;
                        $touritinerary->accomodation = $FitfolderitineraryData->accomodation;
                        $touritinerary->notes = $FitfolderitineraryData->notes;
                        $touritinerary->transport_detail = $FitfolderitineraryData->transport_detail;
                        $touritinerary->company_id = user_info('company_id');
                        $touritinerary->save();
                    }
                }

                $datatourguide =  $fitfolder->fitfolderGuide;
                foreach ($datatourguide as $value) {
                    $value->delete();
                }
                $Fitfolderguide = \DB::table('temporaries')->whereType('fitfolderguide-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Fitfolderguide) > 0) {
                    foreach ($Fitfolderguide as $Fitfolderguidevalue) {
                        $FitfolderguideData = json_decode($Fitfolderguidevalue->data);

                        $tourguide = new FitfolderGuide;
                        $tourguide->id_fit_folder = $fitfolder->id;
                        $tourguide->from_date = $FitfolderguideData->from_date;
                        $tourguide->to_date = $FitfolderguideData->to_date;
                        $tourguide->guide_number = $FitfolderguideData->guide_number;
                        $tourguide->title = $FitfolderguideData->title;
                        $tourguide->name = $FitfolderguideData->name;
                        $tourguide->notes = $FitfolderguideData->notes;
                        $tourguide->cash_advance = $FitfolderguideData->cash_advance;
                        $tourguide->cash_return = $FitfolderguideData->cash_return;
                        $tourguide->company_id = user_info('company_id');
                        $tourguide->save();
                    }
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
     * @param  \App\Models\Outbound\FitFolder  $FitFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FitFolder::destroy($id);
        flash()->success(trans('message.delete.success'));

        return redirect()->route('fitfolder.index');
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
            FitFolder::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('fitfolder.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = FitFolder::select('*')->get();
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
        $types = FitFolder::all();
        $pdf = \PDF::loadView('contents.fits.tour_folder.pdf', compact('types'));
        return $pdf->download('fitfolder.pdf');
    }

    public function detailData(Request $request)
    {
        $datas = [];
        $results = \DB::table('temporaries')->whereType($request->type)
            ->whereUserId(user_info('id'))
            ->select('id','data')
            ->get();

        if (count($results) > 0) {
            foreach ($results as $result) {
                $value = collect(json_decode($result->data))->toArray();
                
                $value['id'] = $result->id;

                array_push($datas, $value);
            }
        }

        $datas = collect($datas);
        
        if ($request->type == 'fitfolderitinerary-detail') {
            $classEdit = 'editDataFitfolderitinerary';
            $classDelete = 'deleteDataFitfolderitinerary';
        } elseif ($request->type == 'fitfolderrate-detail') {
            $classEdit = 'editDataFitfolderrate';
            $classDelete = 'deleteDataFitfolderrate';
        } elseif ($request->type == 'fitfolderguide-detail') {
            $classEdit = 'editDataFitfolderguide';
            $classDelete = 'deleteDataFitfolderguide';
        } elseif ($request->type == 'fitfolderservice-detail') {
            $classEdit = 'editDataFitfolderservice';
            $classDelete = 'deleteDataFitfolderservice';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($FitFolder) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $FitFolder['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $FitFolder['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function FitfolderDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function FitfolderDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function fitfolderPopupFitfolderservice(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->fitfolderservice_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->fitfolderservice_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'fitfolderservice-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'fitfolderservice_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function fitfolderPopupFitfolderitinerary(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->fitfolderitinerary_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->fitfolderitinerary_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'fitfolderitinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'fitfolderitinerary_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function fitfolderPopupFitfolderrate(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->fitfolderrate_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->fitfolderrate_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'fitfolderrate-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'fitfolderrate_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function fitfolderPopupFitfolderguide(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->fitfolderguide_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->fitfolderguide_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'fitfolderguide-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'fitfolderguide_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
