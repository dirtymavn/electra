<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('branch_name', trans('Branch Name'), ['class' => 'control-label']) !!}
            {!! Form::text('branch_name', old('branch_name') , ['class' => 'form-control', 'placeholder' => 'Input the Branch Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('branch_code', trans('Branch Code'), ['class' => 'control-label']) !!}
            {!! Form::text('branch_code', old('branch_code') , ['class' => 'form-control', 'placeholder' => 'Input the Branch Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('branch_address', trans('Branch Address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('branch_address', old('branch_address') , ['class' => 'form-control', 'placeholder' => 'Input the Branch Address', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('branch_phone', trans('Branch Phone'), ['class' => 'control-label']) !!}
            {!! Form::text('branch_phone', old('branch_phone') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Branch Phone']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CompanyBranchRequest', '#form-branch') !!}
<script>
    $(function(){
        spinnerLoad($('#form-branch'));
    });
</script>
@endsection