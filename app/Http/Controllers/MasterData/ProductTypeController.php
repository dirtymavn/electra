<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\ProductTypeDataTable;
use App\Http\Requests\MasterData\ProductTypeRequest;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,product-type.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,product-type.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,product-type.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,product-type.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductTypeDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.product_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.product_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\ProductTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeRequest $request)
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
            $insert = ProductType::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('product-type.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('product-type.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('product-type.create');
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
     * @param  \App\Models\MasterData\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        return view('contents.master_datas.product_type.edit')->with(['producttype' => $productType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\ProductTypeRequest  $request
     * @param  \App\Models\MasterData\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTypeRequest $request, ProductType $productType)
    {
        \DB::beginTransaction();
        try {
            // $airline = Airline::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('product-type.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('product-type.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('product-type.edit', $productType->id);
            }

            $update = $productType->update($request->all());

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
     * @param  \App\Models\MasterData\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('product-type.index');
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
            ProductType::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('product-type.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = ProductType::select('*')->get();
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
        $types = ProductType::all();
        $pdf = \PDF::loadView('contents.master_datas.product_type.pdf', compact('types'));
        return $pdf->download('product-type.pdf');
    }
}
