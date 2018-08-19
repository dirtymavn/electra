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
use App\DataTables\Fit\AvailabilityDataTable;
use App\Http\Requests\Fit\FitFolderRequest;
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


class FitAvailabilityController extends Controller
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
            $conditional .= " AND (a.departure_date >= '".$expdatefrom[2]."-".$expdatefrom[0]."-".$expdatefrom[1]."' AND a.return_date < '".$expdateto[2]."-".$expdateto[0]."-".$expdateto[1]."') ";
        }

        if($request->get('dayfrom') !='' AND $request->get('dayto') !=''){
            $conditional .= "AND (b.number_of_days >= '".$request->get('dayfrom')."' AND b.number_of_days <= '".$request->get('dayto')."') ";
        }

        if($request->get('pricefrom') !=''  AND $request->get('priceto') !=''){
            $conditional .= "AND (e.price >= '".$request->get('pricefrom')."' AND e.price <= '".$request->get('priceto')."') ";
        }

        if($request->get('city') !=''){
            $conditional .= "AND d.city = '".$request->get('city')."'";
        }

        if($request->get('tourcode') !=''){
            $conditional .= "AND a.id = '".$request->get('tourcode')."'";
        }

        if($request->get('nama') !=''){
            $conditional .= "AND a.fit_name LIKE '%".$request->get('nama')."%'";
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
                                SELECT a.*,b.*,c.*,d.*,e.*,f.*,a.id as idtour,g.*,h.*,i.* FROM trx_fit_folder a
                                LEFT JOIN trx_fit_folder_detail b ON(b.id_fit_folder = a.id)
                                LEFT JOIN trx_fit_folder_guide c ON(c.id_fit_folder = a.id)
                                LEFT JOIN trx_fit_folder_itinerary d ON(d.id_fit_folder = a.id)
                                LEFT JOIN trx_fit_folder_rate e ON(e.id_fit_folder = a.id)
                                LEFT JOIN trx_fit_folder_service f ON(f.id_fit_folder = a.id)
                                LEFT JOIN airlines g ON(g.id = b.id_airlines)
                                LEFT JOIN cities h ON(h.id = d.city)
                                LEFT JOIN countries i ON(i.id = h.country_id)
                                WHERE (1=1)
                                ".$conditional."
                            ");
        // dd($listdata);
        $datatourcode = FitFolder::getAvailableData()->pluck('fit_code', 'id')->all();
        $datacities = City::getDataAvailable()->pluck('city_name', 'id')->all();
        $datacountries = Country::getDataByCompany()->pluck('country_name', 'id')->all();
        $dataairline = Airline::getAvailableData()->pluck('airlines.airline_name', 'airlines.id')->all();
        return view('contents.fits.availability.index', compact('listdata', 'querystringArray', 'dataairline', 'datacountries','datacities', 'datatourcode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Outbound\FitFolderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FitFolderRequest $request)
    {
       
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
    public function edit(FitFolder $FitFolder)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Outbound\FitFolderRequest  $request
     * @param  \App\Models\Outbound\FitFolder  $FitFolder
     * @return \Illuminate\Http\Response
     */
    public function update(FitFolderRequest $request, FitFolder $FitFolder)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outbound\FitFolder  $FitFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(FitFolder $FitFolder)
    {
        
    }

    /**
     * Remove the many resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        
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
        $pdf = \PDF::loadView('contents.fits.availability.pdf', compact('types'));
        return $pdf->download('availability.pdf');
    }
}
