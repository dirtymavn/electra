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
use App\DataTables\Outbound\AvailabilityDataTable;
use App\Http\Requests\Outbound\TourFolderRequest;
use App\Models\MasterData\Branch;
use App\Models\MasterData\Currency\Currency;
use App\Models\MasterData\Supplier\MasterSupplier;
use App\Models\MasterData\Outbound\Guide\MasterTourGuide;
use App\Models\MasterData\Inventory\MasterInventory as Inventory;
use App\Models\MasterData\Airline;
use App\Models\MasterData\Country;
use App\Models\MasterData\City;
use App\Models\Temporary;

use Illuminate\Support\Facades\DB;


class AvailabilityController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,availability.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,availability.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,availability.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,availability.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $conditional = "";

        $expdatefrom = explode('/', $request->get('datefrom'));
        $expdateto = explode('/', $request->get('dateto'));
        
        
        if (!user_info()->inRole('super-admin')) {
            $conditional .= " AND a.company_id = ".@user_info()->company->id."";
        }

        if($request->get('datefrom') !='' AND $request->get('dateto') !=''){
            $conditional .= " AND a.departure_date >= '".$expdatefrom[2]."-".$expdatefrom[0]."-".$expdatefrom[1]."' AND a.return_date < '".$expdateto[2]."-".$expdateto[0]."-".$expdateto[1]."'";
        }

        if($request->get('dayfrom') !='' AND $request->get('dayto') !=''){
            $conditional .= "AND b.number_of_days > '".$request->get('dayfrom')."' AND b.number_of_days < '".$request->get('dayto')."'";
        }

        // if($request->get('country') !=''){
        //     $conditional .= "AND a.tour_name LIKE '%".$request->get('country')."%'";
        // }

        if($request->get('city') !=''){
            $conditional .= "AND d.city = '".$request->get('city')."'";
        }

        if($request->get('tourcode') !=''){
            $conditional .= "AND a.id = '".$request->get('tourcode')."'";
        }

        if($request->get('nama') !=''){
            $conditional .= "AND a.tour_name LIKE '%".$request->get('nama')."%'";
        }

        if($request->get('tourcategory') !=''){
            $conditional .= "AND b.tour_category LIKE '%".$request->get('tourcategory')."%'";
        }

        if($request->get('tourtype') !=''){
            $conditional .= "AND b.tour_type LIKE '%".$request->get('tourtype')."%'";
        }

        if($request->get('airline') !=''){
            $conditional .= "AND b.id_airlines = '".$request->get('airline')."'";
        }

        // $listdata = DB::table('trx_tour_folder')
        // ->join('companies', 'companies.id', '=', 'trx_tour_folder.company_id')
        // ->where('tour_name','like','%'.$requestnama.'%')
        // $conditional
        // ->orderBy('id','desc')
        // ->paginate(10);



        $listdata = DB::select("
                                SELECT a.*,b.*,c.*,d.*,e.*,f.*,a.id as idtour,g.* FROM trx_tour_folder a
                                LEFT JOIN trx_tour_folder_detail b ON(b.id_tour_folder = a.id)
                                LEFT JOIN trx_tour_folder_guide c ON(c.id_tour_folder = a.id)
                                LEFT JOIN trx_tour_folder_itinerary d ON(d.id_tour_folder = a.id)
                                LEFT JOIN trx_tour_folder_rate e ON(e.id_tour_folder = a.id)
                                LEFT JOIN trx_tour_folder_service f ON(f.id_tour_folder = a.id)
                                LEFT JOIN airlines g ON(g.id = b.id_airlines)
                                WHERE (1=1)
                                ".$conditional."
                            ");
        // dd($listdata);
        $datatourcode = TourFolder::getAvailableData()->pluck('tour_code', 'id')->all();
        $datacities = City::getDataAvailable()->pluck('city_name', 'id')->all();
        $datacountries = Country::getDataByCompany()->pluck('country_name', 'id')->all();
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')->all();
        return view('contents.outbounds.availability.index', compact('listdata', 'querystringArray', 'dataairline', 'datacountries','datacities', 'datatourcode'));
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

        return view('contents.outbounds.availability.create', compact('newCode','dataairline','databranch','datacurrency','suppliers','dataguide','datainventory'));
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
                $redirect = redirect()->route('availability.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('availability.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('availability.create');
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

        return view('contents.outbounds.availability.edit', compact('Tourfolder','newCode','dataairline','databranch','datacurrency','suppliers','dataguide','datainventory'));
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
                $redirect = redirect()->route('availability.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('availability.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('availability.edit', $tourfolder->id);
            }

            $update = $tourfolder->update($request->all());

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
     * @param  \App\Models\Outbound\TourFolder  $TourFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourFolder $tourfolder)
    {
        $tourfolder->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('availability.index');
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

        return redirect()->route('availability.index');
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
        $pdf = \PDF::loadView('contents.outbounds.availability.pdf', compact('types'));
        return $pdf->download('availability.pdf');
    }
}
