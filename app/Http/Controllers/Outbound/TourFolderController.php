<?php

namespace App\Http\Controllers\Outbound;

use App\Models\Outbound\TrxTourFolder\TourFolder;
use App\Models\Outbound\TrxTourFolder\TourfolderDetail;
use App\Models\Outbound\TrxTourFolder\TourfolderService;
use App\Models\Outbound\TrxTourFolder\TourfolderRate;
use App\Models\Outbound\TrxTourFolder\TourfolderItinerary;
use App\Models\Outbound\TrxTourFolder\TourfolderGuide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Outbound\TourFolderDataTable;
use App\Http\Requests\Outbound\TourFolderRequest;
use App\Models\MasterData\Branch;
use App\Models\MasterData\Currency\Currency;
use App\Models\MasterData\Supplier\MasterSupplier;
use App\Models\MasterData\Outbound\Guide\MasterTourGuide;
use App\Models\MasterData\Inventory\MasterInventory as Inventory;
use App\Models\MasterData\Airline;
use App\Models\Temporary;

class TourFolderController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,tourfolder.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,tourfolder.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,tourfolder.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,tourfolder.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TourFolderDataTable $dataTable)
    {
        return $dataTable->render('contents.outbounds.tour_folder.index');
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

        return view('contents.outbounds.tour_folder.create', compact('newCode','dataairline','databranch','datacurrency','suppliers','dataguide','datainventory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Outbound\TourFolderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourFolderRequest $request)
    {
        \DB::beginTransaction();
        try {

            $newCode = TourFolder::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'tour_code' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'tour_code' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
            $insert = TourFolder::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('tourfolder.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('tourfolder.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('tourfolder.create');
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
     * @param  \App\Models\Outbound\TourFolder  $TourFolder
     * @return \Illuminate\Http\Response
     */
    public function show(TourFolder $TourFolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outbound\TourFolder  $TourFolder
     * @return \Illuminate\Http\Response
     */
    public function edit(TourFolder $Tourfolder)
    {

        \DB::table('temporaries')->whereUserId(user_info('id'))->delete();
        $parent = $Tourfolder->toArray();

        foreach ($Tourfolder->TourfolderService as $key => $value) {
            $data = [
                'id_tour_folder' => $Tourfolder->id,
                'id_product' => $value->id_product,
                'service_type' => $value->service_type,
                'charge_method' => $value->charge_method,
                'id_currency' => $value->id_currency,
                'id_supplier' => $value->id_supplier,
                'notes' => $value->notes
            ];
            Temporary::create([
                'type' => 'tourfolderservice-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($Tourfolder->tourfolderGuide as $key => $value) {
            $data = [
                'id_tour_guide' => $Tourfolder->id,
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
                'type' => 'tourfolderguide-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($Tourfolder->TourfolderItinerary as $key => $value) {
            $data = [
                'id_tour_folder' => $Tourfolder->id,
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
                'type' => 'tourfolderitinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        foreach ($Tourfolder->TourfolderRate as $key => $value) {
            $data = [
                'id_tour_folder' => $Tourfolder->id,
                'customer_type' => $value->customer_type,
                'price_type' => $value->price_type,
                'group_size' => $value->group_size,
                'price' => $value->price,
                'discount' => $value->discount
            ];
            Temporary::create([
                'type' => 'tourfolderrate-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $tourDetail = $Tourfolder->tourfolderDetail->toArray();
        unset($tourDetail['id']);
        
        $arrayMerge = array_merge($parent,$tourDetail);
        
        $Tourfolder = (object)$arrayMerge;

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

        return view('contents.outbounds.tour_folder.edit', compact('Tourfolder','newCode','dataairline','databranch','datacurrency','suppliers','dataguide','datainventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Outbound\TourFolderRequest  $request
     * @param  \App\Models\Outbound\TourFolder  $TourFolder
     * @return \Illuminate\Http\Response
     */
    public function update(TourFolderRequest $request, TourFolder $tourfolder)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('tourfolder.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('tourfolder.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('tourfolder.edit', $tourfolder->id);
            }

            $update = $tourfolder->update($request->all());

            if ($update) {
                $input = $request->all();
                $input['id_tour_folder'] = $tourfolder->id;

                $datatourdetail = $tourfolder->tourfolderDetail;
                $datatourdetail->update($input);


                $datatourservice =  $tourfolder->TourfolderService;
                foreach ($datatourservice as $value) {
                    $value->delete();
                }
                $Tourfolderservice = \DB::table('temporaries')->whereType('tourfolderservice-detail')
                ->whereUserId(user_info('id'))
                ->get();
                if (count($Tourfolderservice) > 0) {
                foreach ($Tourfolderservice as $Tourfolderservicevalue) {
                        $TourfolderserviceData = json_decode($Tourfolderservicevalue->data);

                        $tourservice = new TourfolderService;
                        $tourservice->id_tour_folder = $tourfolder->id;
                        $tourservice->id_product = $TourfolderserviceData->id_product;
                        $tourservice->service_type = $TourfolderserviceData->service_type;
                        $tourservice->charge_method = $TourfolderserviceData->charge_method;
                        $tourservice->id_currency = $TourfolderserviceData->id_currency;
                        $tourservice->id_supplier = $TourfolderserviceData->id_supplier;
                        $tourservice->notes = $TourfolderserviceData->notes;
                        $tourservice->company_id = user_info('company_id');
                        $tourservice->save();
                    }
                }

                $datatourrate =  $tourfolder->TourfolderRate;
                foreach ($datatourrate as $value) {
                    $value->delete();
                }
                $Tourfolderrate = \DB::table('temporaries')->whereType('tourfolderrate-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Tourfolderrate) > 0) {
                    foreach ($Tourfolderrate as $Tourfolderratevalue) {
                        $TourfolderrateData = json_decode($Tourfolderratevalue->data);

                        $tourrate = new TourfolderRate;
                        $tourrate->id_tour_folder = $tourfolder->id;
                        $tourrate->customer_type = $TourfolderrateData->customer_type;
                        $tourrate->price_type = $TourfolderrateData->price_type;
                        $tourrate->group_size = $TourfolderrateData->group_size;
                        $tourrate->price = $TourfolderrateData->price;
                        $tourrate->discount = $TourfolderrateData->discount;
                        $tourrate->company_id = user_info('company_id');
                        $tourrate->save();
                    }
                }


                $datatouritinerary =  $tourfolder->TourfolderItinerary;
                foreach ($datatouritinerary as $value) {
                    $value->delete();
                }
                $Tourfolderitinerary = \DB::table('temporaries')->whereType('tourfolderitinerary-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Tourfolderitinerary) > 0) {
                    foreach ($Tourfolderitinerary as $Tourfolderitineraryvalue) {
                        $TourfolderitineraryData = json_decode($Tourfolderitineraryvalue->data);

                        $touritinerary = new TourfolderItinerary;
                        $touritinerary->id_tour_folder = $tourfolder->id;
                        $touritinerary->day = $TourfolderitineraryData->day;
                        $touritinerary->itinerary_code = $TourfolderitineraryData->itinerary_code;
                        $touritinerary->city = $TourfolderitineraryData->city;
                        $touritinerary->description = $TourfolderitineraryData->description;
                        $touritinerary->operator = $TourfolderitineraryData->operator;
                        $touritinerary->breakfast = $TourfolderitineraryData->breakfast;
                        $touritinerary->lunch = $TourfolderitineraryData->lunch;
                        $touritinerary->dinner = $TourfolderitineraryData->dinner;
                        $touritinerary->accomodation = $TourfolderitineraryData->accomodation;
                        $touritinerary->notes = $TourfolderitineraryData->notes;
                        $touritinerary->transport_detail = $TourfolderitineraryData->transport_detail;
                        $touritinerary->company_id = user_info('company_id');
                        $touritinerary->save();
                    }
                }

                $datatourguide =  $tourfolder->tourfolderGuide;
                foreach ($datatourguide as $value) {
                    $value->delete();
                }
                $Tourfolderguide = \DB::table('temporaries')->whereType('tourfolderguide-detail')
                    ->whereUserId(user_info('id'))
                    ->get();
                if (count($Tourfolderguide) > 0) {
                    foreach ($Tourfolderguide as $Tourfolderguidevalue) {
                        $TourfolderguideData = json_decode($Tourfolderguidevalue->data);

                        $tourguide = new TourfolderGuide;
                        $tourguide->id_tour_folder = $tourfolder->id;
                        $tourguide->from_date = $TourfolderguideData->from_date;
                        $tourguide->to_date = $TourfolderguideData->to_date;
                        $tourguide->guide_number = $TourfolderguideData->guide_number;
                        $tourguide->title = $TourfolderguideData->title;
                        $tourguide->name = $TourfolderguideData->name;
                        $tourguide->notes = $TourfolderguideData->notes;
                        $tourguide->cash_advance = $TourfolderguideData->cash_advance;
                        $tourguide->cash_return = $TourfolderguideData->cash_return;
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
     * @param  \App\Models\Outbound\TourFolder  $TourFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TourFolder::destroy($id);
        flash()->success(trans('message.delete.success'));

        return redirect()->route('tourfolder.index');
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
            TourFolder::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('tourfolder.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = TourFolder::select('*')->get();
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
        $types = TourFolder::all();
        $pdf = \PDF::loadView('contents.outbounds.tour_folder.pdf', compact('types'));
        return $pdf->download('tourfolder.pdf');
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
        
        if ($request->type == 'tourfolderitinerary-detail') {
            $classEdit = 'editDataTourfolderitinerary';
            $classDelete = 'deleteDataTourfolderitinerary';
        } elseif ($request->type == 'tourfolderrate-detail') {
            $classEdit = 'editDataTourfolderrate';
            $classDelete = 'deleteDataTourfolderrate';
        } elseif ($request->type == 'tourfolderguide-detail') {
            $classEdit = 'editDataTourfolderguide';
            $classDelete = 'deleteDataTourfolderguide';
        } elseif ($request->type == 'tourfolderservice-detail') {
            $classEdit = 'editDataTourfolderservice';
            $classDelete = 'deleteDataTourfolderservice';
        }

        return datatables()->of($datas)
            ->addColumn('action', function ($TourFolder) use($classEdit, $classDelete) {
                return '<a href="javascript:void(0)" class="'.$classEdit.'" title="Edit" data-id="' . $TourFolder['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
                            <a href="javascript:void(0)" class="danger '.$classDelete.'" title="Delete" data-id="' . $TourFolder['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function TourfolderDetailDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete();
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    public function TourfolderDetailGetDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }

    public function tourfolderPopupTourfolderservice(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->tourfolderservice_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->tourfolderservice_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'tourfolderservice-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'tourfolderservice_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function tourfolderPopupTourfolderitinerary(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->tourfolderitinerary_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->tourfolderitinerary_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'tourfolderitinerary-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'tourfolderitinerary_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function tourfolderPopupTourfolderrate(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->tourfolderrate_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->tourfolderrate_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'tourfolderrate-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'tourfolderrate_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    public function tourfolderPopupTourfolderguide(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->tourfolderguide_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->tourfolderguide_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'tourfolderguide-detail',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'tourfolderguide_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
