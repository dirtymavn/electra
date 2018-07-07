<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('country_name', trans('Country Name'), ['class' => 'control-label']) !!}
            {!! Form::text('country_name', old('country_name') , ['class' => 'form-control', 'placeholder' => 'Input the Country Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nationality', trans('Nationality'), ['class' => 'control-label']) !!}
            {!! Form::text('nationality', old('nationality') , ['class' => 'form-control', 'placeholder' => 'Input the Nationality']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('iata_code', trans('Iata Code'), ['class' => 'control-label']) !!}
            {!! Form::text('iata_code', old('iata_code') , ['class' => 'form-control', 'placeholder' => 'Input the Iata Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('country_callcode', trans('Country Call Code'), ['class' => 'control-label']) !!}
            {!! Form::text('country_callcode', old('country_callcode') , ['class' => 'form-control', 'placeholder' => 'Input the Country Call Code']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CountryRequest', '#form-country') !!}
<script>
    $(function(){
        spinnerLoad($('#form-country'));
    });
</script>
@endsection