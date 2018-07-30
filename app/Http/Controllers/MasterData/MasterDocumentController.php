<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterData\Document\MasterDocument;
use App\Models\MasterData\Document\MasterQueueMessage;
use App\Models\Temporary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\MasterData\MasterDocumentDataTable;
use App\Http\Requests\MasterData\DocumentRequest;
use App\Models\MasterData\Branch;
use App\Models\Role;

class MasterDocumentController extends Controller
{
    public function __construct()
    {
        // middleware
        $this->middleware('sentinel_access:admin.company,document.read', ['only' => ['index']]);
        $this->middleware('sentinel_access:admin.company,document.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel_access:admin.company,document.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel_access:admin.company,document.destroy', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MasterDocumentDataTable $dataTable)
    {
        return $dataTable->render('contents.master_datas.master_document.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))
            ->whereType('data-document')
            ->delete();

        $branchs = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $roles = Role::whereCompanyId(user_info('company_id'))
                ->where('slug', '<>', user_info('roles')[0]->slug)
                ->pluck('name', 'slug')->all();
        return view('contents.master_datas.master_document.create', compact('branchs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\DocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
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
            $insert = MasterDocument::create($request->all());

            if ($insert) {
                $redirect = redirect()->route('document.index');
                if (@$request->is_draft == 'true') {
                    $redirect = redirect()->route('document.edit', $insert->id)->withInput();
                } elseif (@$request->is_publish_continue == 'true') {
                    $redirect = redirect()->route('document.create');
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
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // clear temporary data
        \DB::table('temporaries')->whereUserId(user_info('id'))
            ->whereType('data-document')
            ->delete();

        $document = MasterDocument::find($id);

        foreach ($document->queues as $queue) {
            $data = [
                'queue_message' => $queue->queue_message,
                'due_date' => $queue->due_date,
                'subject' => $queue->subject,
                'target_role' => $queue->target_role,
                'spesific_role' => $queue->spesific_role,
                'queue_branch_id' => $queue->branch_id,
                'status' => $queue->status,
            ];

            Temporary::create([
                'type' => 'data-document',
                'user_id' => user_info('id'),
                'data' => json_encode($data)
            ]);
        }

        $branchs = Branch::getAvailableData()->pluck('branch_name', 'company_branchs.id')->all();
        $roles = Role::whereCompanyId(user_info('company_id'))
                ->where('slug', '<>', user_info('roles')[0]->slug)
                ->pluck('name', 'slug')->all();

        return view('contents.master_datas.master_document.edit')->with(['document' => $document, 'branchs' => $branchs, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MasterData\DocumentRequest  $request
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, $id)
    {
        $document = MasterDocument::find($id);

        \DB::beginTransaction();
        try {
            if (@$request->is_draft == 'false') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published');
                $redirect = redirect()->route('document.index');
            } elseif (@$request->is_publish_continue == 'true') {
                $request->merge(['is_draft' => false]);
                $msgSuccess = trans('message.published_continue');
                $redirect = redirect()->route('document.create');
            } else {
                $msgSuccess = trans('message.update.success');
                $redirect = redirect()->route('document.edit', $document->id);
            }

            $update = MasterDocument::find($id)->update($request->all());

            if ($update) {
                $queues =  $document->queues;
                foreach ($queues as $value) {
                    $value->delete();
                }
                $documents = \DB::table('temporaries')->whereType('data-document')
                ->whereUserId(user_info('id'))
                ->get();
                if (count($documents) > 0) {
                    foreach ($documents as $val) {
                        $value = json_decode($val->data);

                        $rate = new MasterQueueMessage;
                        $rate->attached_document = $id;
                        $rate->queue_message = $value->queue_message;
                        $rate->due_date = $value->due_date;
                        $rate->subject = $value->subject;
                        $rate->target_role = $value->target_role;
                        $rate->spesific_role = $value->spesific_role;
                        $rate->branch_id = $value->queue_branch_id;
                        $rate->status = $value->status;

                        $rate->save();
                    }
                }
                flash()->success($msgSuccess);
                \DB::commit();
                return $redirect;

            }
        } catch (\Exception $e) {
            \DB::rollback();
            flash()->success(trans('message.error') . ' : ' . $e->getMessage().$e->getFile().$e->getLine());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = MasterDocument::find($id);
        $document->delete();
        flash()->success(trans('message.delete.success'));

        return redirect()->route('document.index');
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
            MasterDocument::whereIn('id', $ids)->delete();
            flash()->success(trans('message.delete.success'));
        } else {
            flash()->success(trans('message.delete.error'));
        }

        return redirect()->route('document.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
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

        return datatables()->of($datas)
        ->addColumn('action', function ($document) use($request) {
            return '<a href="javascript:void(0)" class="editData" title="Edit" data-element="'.$request->type.'" data-id="' . $document['id'] . '" data-button="edit"><i class="os-icon os-icon-ui-49"></i></a>
            <a href="javascript:void(0)" class="danger deleteData" data-element="'.$request->type.'" title="Delete" data-id="' . $document['id'] . '" data-button="delete"><i class="os-icon os-icon-ui-15"></i></a>';
        })
        ->rawColumns(['action', 'queue_message'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function documentStore(Request $request)
    {
        \DB::beginTransaction();
        try {
            if (@$request->queue_id) {
                // Delete temporaries
                \DB::table('temporaries')->whereId($request->queue_id)->delete();
            }
            \DB::table('temporaries')->insert([
                'type' => 'data-document',
                'user_id' => user_info('id'),
                'data' => json_encode($request->except(['_token', 'queue_id']))
            ]);

            \DB::commit();

            return response()->json(['result' => true],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Delete resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataDelete(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->delete(); 
        if ($findTemp) {
            return response()->json(['result' => true], 200);
        }
        return response()->json(['result' => false], 200);
    }

    /**
     * Get detail resource in storage temporary.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataDetail(Request $request)
    {
        $findTemp = \DB::table('temporaries')->whereId($request->id)->first();
        $findTemp->data = json_decode($findTemp->data);
        return response()->json(['result' => true, 'data' => $findTemp], 200);   
    }
}
