<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('region_name', trans('region Name'), ['class' => 'control-label']) !!}
            {!! Form::text('region_name', old('region_name') , ['class' => 'form-control', 'placeholder' => 'Input the region Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('region_code', trans('Region Code'), ['class' => 'control-label']) !!}
            {!! Form::text('region_code', old('region_code') , ['class' => 'form-control', 'placeholder' => 'Input the Region Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('region_description', trans('Region Description'), ['class' => 'control-label']) !!}
            {!! Form::textarea('region_description', old('region_description') , ['class' => 'form-control', 'placeholder' => 'Input the Region Description', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Active'), ['class' => 'control-label']) !!}
            {!! Form::select('status', ['1' => 'Yes', '0' => 'No'], old('status'), ['class' => 'form-control']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\RegionRequest', '#form-region') !!}
<script>
    $(function(){
        spinnerLoad($('#form-region'));
    });
</script>
@endsection