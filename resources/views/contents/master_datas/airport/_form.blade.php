<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('city_id', trans('City'), ['class' => 'control-label']) !!}
            {!! Form::select('city_id', ['' => 'Choose City'] + @$cities, old('city_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('airport_name', trans('Airport Name'), ['class' => 'control-label']) !!}
            {!! Form::text('airport_name', old('airport_name') , ['class' => 'form-control', 'placeholder' => 'Input the Airport Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('airport_code_icao', trans('Airport Code Icao'), ['class' => 'control-label']) !!}
            {!! Form::text('airport_code_icao', old('airport_code_icao') , ['class' => 'form-control', 'placeholder' => 'Input the Airport Code Icao']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('airport_code_iata', trans('Airport Code Iata'), ['class' => 'control-label']) !!}
            {!! Form::text('airport_code_iata', old('airport_code_iata') , ['class' => 'form-control', 'placeholder' => 'Input the Airport Code Iata']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\AirportRequest', '#form-airport') !!}
<script>
    $(function(){
        spinnerLoad($('#form-airport'));
    });
</script>
@endsection