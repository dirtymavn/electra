<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterData\ProductCategory;
use App\DataTables\MasterData\ProductCategoryDataTable;
use App\Http\Requests\MasterData\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,product-category.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,product-category.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,product-category.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,product-category.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCategoryDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.product_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = ProductCategory::active()->pluck('category_name', 'id')->all();
        return view('contents.master_datas.product_category.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\ProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
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
            $insert = ProductCategory::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('product-category.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('product-category.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('product-category.create');
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
     * @param  \App\Models\MasterData\ProductCategory  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\ProductCategory  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $category = ProductCategory::find($id);
        $parents = ProductCategory::active()->whereNotIn('id', [ $id ])->pluck('category_name', 'id')->all();
        return view('contents.master_datas.product_category.edit')->with(['category' => $category, 'parents' => $parents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\ProductCategoryRequest  $request
     * @param  \App\Models\MasterData\ProductCategory  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $category = ProductCategory::find($id);
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('product-category.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('product-category.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('product-category.edit', $category->id);
            }

            $update = $category->update($request->all());

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
     * @param  \App\Models\MasterData\ProductCategory  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::find($id)->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('product-category.index');
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
            ProductCategory::whereIn('id', $ids)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('product-category.index');
    }

    /**
     * Export PDF
     * @return void
     */
    public function export_excel()
    {
        $type = ProductCategory::select('*')->get();
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
        $categories = ProductCategory::all();
        $pdf = \PDF::loadView('contents.master_datas.product_category.pdf', compact('categories'));
        return $pdf->download('product-category.pdf');
    }
}
