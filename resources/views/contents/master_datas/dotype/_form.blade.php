<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('do_type_name', trans('Do Type Name'), ['class' => 'control-label']) !!}
            {!! Form::text('do_type_name', old('do_type_name') , ['class' => 'form-control', 'placeholder' => 'Input the Do Type Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('do_type_code', trans('Do Type Code'), ['class' => 'control-label']) !!}
            {!! Form::text('do_type_code', old('do_type_code') , ['class' => 'form-control', 'placeholder' => 'Input the Do Type Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('do_type_status', trans('Do Type Status'), ['class' => 'control-label']) !!}
            {!! Form::text('do_type_status', old('do_type_status') , ['class' => 'form-control', 'placeholder' => 'Input the Do Type Status']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\DoTypeRequest', '#form-dotype') !!}
<script>
    $(function(){
        spinnerLoad($('#form-dotype'));
    });
</script>
@endsection