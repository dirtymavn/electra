<?php

/*namespace App\Http\Controllers\Hotel;

use App\Models\Hotel\HotelBooking;
use App\Models\Hotel\HotelBookingDetail;
use App\Models\Hotel\HotelBookingPax;
use App\Models\Hotel\HotelBookingService;
use App\Models\MasterData\Hotel\MasterHotel;
use App\Models\MasterData\Hotel\MasterHotelService;
use App\Models\MasterData\Country;
use App\Models\Outbound\TrxTourOrder\TourOrder;
use App\Models\MasterData\Customer\MasterCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Hotel\HotelBookingDataTable;
use App\Http\Requests\Hotel\HotelBookingRequest;
use App\Models\Temporary;*/






namespace App\Http\Controllers\Hotel;

use App\Models\MasterData\Hotel\MasterHotelContact;
use App\Models\MasterData\Hotel\MasterHotelService;
use App\Models\MasterData\Hotel\MasterHotel;
use App\Models\MasterData\Hotel\HotelChain;
use App\Models\MasterData\Country;
use App\Models\MasterData\Currency\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temporary;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,enquiry.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,enquiry.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,enquiry.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,enquiry.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $conditional = "";
      if (!user_info()->inRole('super-admin')) {
          $conditional .= " AND a.company_id = ".@user_info()->company->id."";
      }

      if($request->get('nama') !=''){
          $conditional .= "AND a.name LIKE '%".$request->get('nama')."%'";
      }

      if($request->get('namechain') !=''){
          $conditional .= "AND b.name LIKE '%".$request->get('namechain')."%'";
      }

      if($request->get('room_capacity') !=''){
          $conditional .= "AND c.room_capacity LIKE '%".$request->get('room_capacity')."%'";
      }

      if($request->get('property_type') !=''){
          $conditional .= "AND c.property_type = '".$request->get('property_type')."'";
      }

      if($request->get('service_name') !=''){
          $conditional .= "AND d.service_name LIKE '%".$request->get('service_name')."%'";
      }

      if($request->get('room_type') !=''){
          $conditional .= "AND e.room_type LIKE '%".$request->get('room_type')."%'";
      }

      $listdata = DB::select("
                              SELECT
                              a.*,a.name as namahotel,
                              b.*,b.name as namachain,
                              c.*,
                              d.*,
                              e.*
                              FROM master_hotel a
                              LEFT JOIN master_hotel_chain b ON(b.id = a.id_hotel_chain)
                              LEFT JOIN master_hotel_property c ON(c.id_hotel = a.id)
                              LEFT JOIN master_hotel_service d ON(d.id_hotel = a.id)
                              LEFT JOIN master_hotel_rooms_type e ON(e.id_hotel = a.id)
                              WHERE (1=1)
                              ".$conditional."
                          ");
      // dd($listdata);
      return view('contents.hotels.enquiry.index', compact('listdata'));
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
     * @param  \App\Http\Requests\Hotel\HotelBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel\HotelBooking  $HotelBooking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel\HotelBooking  $HotelBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Hotel\HotelBookingRequest  $request
     * @param  \App\Models\Hotel\HotelBooking  $hotelbooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel\HotelBooking  $HotelBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelBooking $HotelBooking)
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
        $type = Enquiry::select('*')->get();
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
        $types = Enquiry::all();
        $pdf = \PDF::loadView('contents.hotels.enquiry.pdf', compact('types'));
        return $pdf->download('enquiry.pdf');
    }

}
