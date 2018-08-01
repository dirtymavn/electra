<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\SupplierDataTable;
use App\Models\MasterData\Supplier\MasterSupplier as Supplier;
use App\Models\MasterData\Currency\Currency;
use App\Models\MasterData\Country;
use App\Models\MasterData\City;

use DB;
use Excel;
use PDF;

class SupplierController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,supplier.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,supplier.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,supplier.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,supplier.destroy', ['only' => ['destroy']]);

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newCode = '';
        $types = Supplier::types();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();
        $countries = Country::getDataByCompany()->pluck('countries.country_name', 'countries.id')->all();
        $cities = ['' => '- Not Available -'];
        return view('contents.master_datas.supplier.create', compact('newCode', 'types', 'currencys', 'countries', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $newCode = Supplier::getAutoNumber();
            if (@$request->is_draft == 'true') {
                $msgSuccess = trans('message.save_as_draft');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'supplier_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
            } else {
                $request->merge(['is_draft' => false, 'supplier_no' => $newCode]);
                $msgSuccess = trans('message.published');
            }

            $request->merge(['company_id' => @user_info()->company->id, 'is_draft' => false]);
            $insert = Supplier::create( $request->all() );
            
            if ($insert) {
                $redirect = redirect()->route('supplier.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('supplier.edit', $insert->id);
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('supplier.create');
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;
            } else {
                flash()->error('Data is failed to insert');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            flash()->error('<strong>Whoops! </strong> Something went wrong '. $e->getMessage());
            \DB::rollback();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $parent = $supplier->toArray();
        // wew($parent);
        $detailParent = $supplier->detail;
        $detail = $supplier->detail->toArray();
        $contact = $supplier->detail->contact->toArray();
        $bankParent = $supplier->bank;
        $bank = $supplier->bank;
        $bank->name_bank = $bank->name;
        $bank->address_bank = $bank->address;
        $bank->remark_bank = $bank->remark;
        $bank = $bank->toArray();


        $bankDetail = $supplier->bank->bank_detail;
        $bankDetail->name_bank_detail = $bankDetail->name;
        $bankDetail->swift_bank_detail = $bankDetail->swift;
        $bankDetail->remark_bank_detail = $bankDetail->remark;
        $bankDetail = $bankDetail->toArray();

        $bankCrpd = $supplier->bank->crpd;
        $bankCrpd->name_crpd = $bankCrpd->name;
        $bankCrpd->address_crpd = $bankCrpd->address;
        $bankCrpd->remark_crpd = $bankCrpd->remark;
        $bankCrpd->swift_crpd = $bankCrpd->swift;
        $bankCrpd = $bankCrpd->toArray();
        
        unset($detail['id'], $contact['id'], $bank['id'], $bankDetail['id'], $bankCrpd['id']);
        $arrayMerge = array_merge($parent, $detail, $contact, $bank, $bankDetail, $bankCrpd);
        // dd($arrayMerge);
        
        $supplier = (object) $arrayMerge;
        $supplier->name = $parent['name'];
        $supplier->address = $parent['address'];
        $newCode = $supplier->supplier_no;
        $types = Supplier::types();
        $currencys = Currency::getAvailableData()->pluck('currency.currency_name', 'currency.currency_code')->all();
        $countries = Country::getDataByCompany()->pluck('countries.country_name', 'countries.id')->all();
        // wew($supplier);
        // $cities = City::getAvailableData()->where('cities.country_id', $supplier->country)->pluck('cities.city_name', 'cities.id')->all();
        $cities = ['' => '- Not Available -'];

        return view('contents.master_datas.supplier.edit', compact('supplier', 'newCode', 'types', 'currencys', 'countries', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        DB::beginTransaction();
        try {
            $newCode = Supplier::getAutoNumber();
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false, 'supplier_no' => $newCode]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('supplier.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false, 'supplier_no' => $newCode]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('supplier.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('supplier.edit', $supplier->id);
            }

            $insert = $supplier->update( $request->all() );
            
            if ($insert) {
                \DB::commit();
                flash()->success($msgSuccess);
                return $redirect;
            } else {
                flash()->error('Data is failed to updated');
                return redirect()->back()->withInput();
            }
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            flash()->error('Data is failed to updated '. $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Supplier\MasterSupplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $destroy = $supplier->delete();
        flash()->success('Data is successfully deleted');
        return redirect()->route('supplier.index');
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
            Supplier::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }
        return redirect()->route('supplier.index');
    }

    /**
     * Search data
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function searchData(Request $request)
    {
        $results = Supplier::getAvailableData()
            ->select('master_supplier.id', \DB::raw("(master_supplier.supplier_no||'-'||master_supplier.name) as text"), 'master_supplier.supplier_no as slug')
            ->where(function($q) use ($request) {
                return $q->where('master_supplier.name', 'ilike', '%'.$request->search.'%')
                    ->orWhere('master_supplier.supplier_no', 'ilike', '%'.$request->search.'%');
            })
            ->get();
        

        return response()->json(['message' => 'Success', 'items' => $results]);
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $supplier = Supplier::select('*')->get();
        // dd($supplier);
        Excel::create('testing-'.date('Ymd'), function($excel) use ($supplier) {
            $excel->sheet('Sheet 1', function($sheet) use ($supplier) {
                $sheet->fromArray($supplier);
            });
        })->export('xls');
    }


    /**
     * Export PDF
     * @return void
     */
    public function export_pdf()
    {
        $suppliers = Supplier::all();
        $pdf = PDF::loadView('contents.master_datas.supplier.pdf', compact('suppliers'));
        return $pdf->download('supplier.pdf');
    }
}
