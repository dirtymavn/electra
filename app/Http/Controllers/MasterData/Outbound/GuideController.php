<?php

namespace App\Http\Controllers\MasterData\Outbound;

use App\Models\MasterData\Outbound\Guide\MasterTourGuide;
use App\Models\MasterData\Outbound\Guide\TourGuideVisa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MasterData\Outbound\GuideDataTable;

class GuideController extends Controller
{
    /**
     * @var App\Models\MasterData\Outbound\Guide\MasterTourGuide
     * @var App\Models\MasterData\Outbound\Guide\TourGuideVisa
    */
    protected $guide;
    protected $guideVisa;

    /**
     * Create a new GuideController instance.
     *
     * @param \App\Models\MasterData\Outbound\Guide\MasterTourGuide  $guide
     * @param \App\Models\MasterData\Outbound\Guide\TourGuideVisa  $guideVisa
    */
    public function __construct(MasterTourGuide $guide, TourGuideVisa $guideVisa)
    {
        $this->guide = $guide;
        $this->guideVisa = $guideVisa;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GuideDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.outbounds.guide.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.master_datas.outbounds.guide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $insertGuideVisa = $this->guideVisa->create($request->all());
            if ($insertGuideVisa) {
                $request->merge(['tour_guide_visa_id' => $insertGuideVisa->id]);

                if (@$request->is_draft == 'true') {
                    $msgSuccess = trans('message.save_as_draft');
                } elseif (@$request->is_publish_continue == 'true') {
                    $request->merge(['is_draft' => false]);
                    $msgSuccess = trans('message.published_continue');
                } else {
                    $request->merge(['is_draft' => false]);
                    $msgSuccess = trans('message.published');
                }

                $insertGuide = $this->guide->create($request->all());

                if ($insertGuide) {
                    $redirect = redirect()->route('guide.index');
                    if (@$request->is_draft == 'true') {
                        $redirect = redirect()->route('guide.edit', $insertGuide->id)->withInput();
                    } elseif (@$request->is_publish_continue == 'true') {
                        $redirect = redirect()->route('guide.create');
                    }

                    flash()->success($msgSuccess);
                    \DB::commit();
                    return $redirect;
                }
            } else {
                flash()->success(trans('message.create.error'));
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error').' '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterData\Outbound\Guide\MasterTourGuide  $guide
     * @return \Illuminate\Http\Response
     */
    public function show(MasterTourGuide $guide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterData\Outbound\Guide\MasterTourGuide  $guide
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterTourGuide $guide)
    {
        $guideMain = $guide->mains()->first()->toArray();
        $guideBasic = $guide->basics()->first()->toArray();
        $guideVisaa = $guide->visa->toArray();
        $guide = $guide->toArray();

        unset($guideMain['id'], $guideBasic['id'], $guideVisaa['id']);

        $arrayMerge = array_merge($guide, $guideMain, $guideBasic, $guideVisaa);

        $guide = (object) $arrayMerge;

        return view('contents.master_datas.outbounds.guide.edit', compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterData\Outbound\Guide\MasterTourGuide  $guide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterTourGuide $guide)
    {
        if (@$request->is_draft == 'false') {
            $request->merge(['is_draft' => false]);
            $msgSuccess = trans('message.published');
            $redirect = redirect()->route('guide.index');
        } elseif (@$request->is_publish_continue == 'true') {
            $request->merge(['is_draft' => false]);
            $msgSuccess = trans('message.published_continue');
            $redirect = redirect()->route('guide.create');
        } else {
            $msgSuccess = trans('message.update.success');
            $redirect = redirect()->route('guide.edit', $guide->id);
        }

        $updateGuide = $guide->update($request->all());
        if ($updateGuide) {
            $findGuideVisa = $this->guideVisa->find($guide->tour_guide_visa_id);
            $findGuideVisa->update($request->all());

            $guideMain = $guide->mains()->first();
            $guideMain->update($request->all());

            $guideBasic = $guide->basics()->first();
            $guideBasic->update($request->all());


            flash()->success($msgSuccess);
            return $redirect;
        }

        flash()->error('<strong>Whoops! </strong> Something went wrong');        
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterData\Outbound\Guide\MasterTourGuide  $guide
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterTourGuide $guide)
    {
        $guideVisaa = $guide->visa;
        $guideVisaa->delete();
        flash()->success(trans('message.delete.success'));
        
        return redirect()->route('guide.index');
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
            $visaIds = MasterTourGuide::whereIn('id', $ids)->pluck('tour_guide_visa_id')->all();
            TourGuideVisa::whereIn('id', $visaIds)->delete();

            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('guide.index');
    }
}
