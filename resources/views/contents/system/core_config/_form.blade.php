<div class="row">
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header">Config</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('base_currency_id', trans('Base Currency'), ['class' => 'control-label']) !!}
                    {!! Form::select('base_currency_id', ['' => '- Not Available -'],old('base_currency_id') , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('base_date', trans('Base Date'), ['class' => 'control-label']) !!}
                    {!! Form::text('base_date', old('base_date') , ['class' => 'form-control', 'placeholder' => 'Input the Base Date']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('decimal_number', trans('Decimal Number'), ['class' => 'control-label']) !!}
                    {!! Form::text('decimal_number', old('decimal_number') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Decimal Number']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header">Main</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('allow_backdate', trans('Allow Back Date'), ['class' => 'control-label']) !!}
                    {!! Form::select('allow_backdate', [1 => 'Yes', 0 => 'No'],old('allow_backdate') , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('backdate_interval', trans('Back Date Interval'), ['class' => 'control-label']) !!}
                    {!! Form::text('backdate_interval', old('backdate_interval') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Back Date Interval']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\System\CoreConfigRequest', '#form-core-config') !!}
<script>
    $(function(){
        spinnerLoad($('#form-core-config'));
    });
</script>
@endsection