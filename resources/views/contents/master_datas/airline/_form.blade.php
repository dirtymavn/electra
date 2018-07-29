<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('airline_name', trans('Airline Name'), ['class' => 'control-label']) !!}
            {!! Form::text('airline_name', old('airline_name') , ['class' => 'form-control', 'placeholder' => 'Input the Airline Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('airline_code', trans('Airline Code'), ['class' => 'control-label']) !!}
            {!! Form::text('airline_code', old('airline_code') , ['class' => 'form-control', 'placeholder' => 'Input the Airline Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('airline_class', trans('Airline Class'), ['class' => 'control-label']) !!}
            {{-- {!! Form::text('airline_class', old('airline_class') , ['class' => 'form-control', 'placeholder' => 'Input the Airline Class']) !!} --}}
            {!! Form::select('airline_class', ['low-cost' => 'Low Cost', 'fullboard' => 'Full Board'], old('airline_class'), ['class' => 'form-control', 'placeholder' => 'Choose Airline Class']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\AirlineRequest', '#form-airline') !!}
<script>
    $(function(){
        spinnerLoad($('#form-airline'));
    });
</script>
@endsection