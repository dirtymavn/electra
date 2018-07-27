<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('module_name', trans('Module Name'), ['class' => 'control-label']) !!}
            {!! Form::text('module_name', old('module_name') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('module_label', trans('Module Label'), ['class' => 'control-label']) !!}
            {!! Form::text('module_label', old('module_label') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Label']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('module_code', trans('Module Code'), ['class' => 'control-label']) !!}
            {!! Form::text('module_code', old('module_code') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Code']) !!}
        </div>
    </div>
    <div class="col-sm-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#transport">Core Report</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cost">Core Report</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#misc">Company Module</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="transport">
                    {{-- @include('contents.master_datas.inventory.parts.transport') --}}
                </div>
                <div class="tab-pane" id="cost">
                    {{-- @include('contents.master_datas.inventory.parts.cost') --}}
                </div>
                <div class="tab-pane" id="misc">
                    {{-- @include('contents.master_datas.inventory.parts.misc') --}}
                </div>
                
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\InventoryRequest', '#form-core') !!}
<script>
    $(function(){
        spinnerLoad($('#form-core'));
    });
</script>
@endsection