<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('Company Name'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Company Name']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', trans('Address'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('address', old('address') , ['class' => 'form-control', 'placeholder' => 'Input the Address', 'rows' => '3']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', trans('Phone'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('phone', old('phone') , ['class' => 'form-control', 'placeholder' => 'Input the Phone']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('npwp') ? 'has-error' : ''}}">
    {!! Form::label('npwp', trans('NPWP'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('npwp', old('npwp') , ['class' => 'form-control', 'placeholder' => 'Input the NPWP']) !!}
    </div>
</div>


@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Master\CompanyRequest', '#form-company') !!}
@endsection