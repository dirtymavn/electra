<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('department_name', trans('Department Name'), ['class' => 'control-label']) !!}
            {!! Form::text('department_name', old('department_name') , ['class' => 'form-control', 'placeholder' => 'Input the Department Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('department_code', trans('Department Code'), ['class' => 'control-label']) !!}
            {!! Form::text('department_code', old('department_code') , ['class' => 'form-control', 'placeholder' => 'Input the Department Code']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CompanyDepartmentRequest', '#form-department') !!}
<script>
    $(function(){
        spinnerLoad($('#form-department'));
    });
</script>
@endsection