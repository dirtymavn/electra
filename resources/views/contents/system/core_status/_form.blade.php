<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status_name', trans('Status Name'), ['class' => 'control-label']) !!}
            {!! Form::text('status_name', old('status_name') , ['class' => 'form-control', 'placeholder' => 'Input the Status Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status_code', trans('Status Code'), ['class' => 'control-label']) !!}
            {!! Form::text('status_code', old('status_code') , ['class' => 'form-control', 'placeholder' => 'Input the Status Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status_order', trans('Status Order'), ['class' => 'control-label']) !!}
            {!! Form::number('status_order', old('status_order') , ['class' => 'form-control', 'placeholder' => 'Input the Status Order']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status_approval_flag', trans('Status Approval'), ['class' => 'control-label']) !!}
            {!! Form::select('status_approval_flag', ['1' => 'Yes', '0' => 'No'], old('status_approval_flag'), ['class' => 'form-control', 'placeholder' => 'Choosee Status Approval']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\System\CoreStatusRequest', '#form-status') !!}
<script>
    $(function(){
        spinnerLoad($('#form-status'));
    });
</script>
@endsection