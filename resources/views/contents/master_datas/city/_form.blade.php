<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('country_id', trans('Country'), ['class' => 'control-label']) !!}
            {!! Form::select('country_id', ['' => 'Choose Country'] + @$countries, old('status'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('city_name', trans('City Name'), ['class' => 'control-label']) !!}
            {!! Form::text('city_name', old('city_name') , ['class' => 'form-control', 'placeholder' => 'Input the City Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('city_code', trans('City Code'), ['class' => 'control-label']) !!}
            {!! Form::text('city_code', old('city_code') , ['class' => 'form-control', 'placeholder' => 'Input the City Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', ['1' => 'Yes', '0' => 'No'], old('status'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CityRequest', '#form-city') !!}
<script>
    $(function(){
        spinnerLoad($('#form-city'));
    });
</script>
@endsection