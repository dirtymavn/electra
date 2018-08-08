<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('pnr', trans('Pnr'), ['class' => 'control-label']) !!}
            {!! Form::text('pnr', old('pnr') , ['class' => 'form-control', 'placeholder' => 'Input Pnr']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_airport_from', trans('Airport From'), ['class' => 'control-label']) !!}
            {!! Form::select('id_airport_from', ['' => 'Choose airport'] + @$dataairport, old('id_airport_from'), ['class' => 'form-control id_airport_from']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_ariport_to', trans('Airport To'), ['class' => 'control-label']) !!}
            {!! Form::select('id_ariport_to', ['' => 'Choose airport'] + @$dataairport, old('id_ariport_to'), ['class' => 'form-control id_ariport_to']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_airlines', trans('Airlines'), ['class' => 'control-label']) !!}
            {!! Form::select('id_airlines', ['' => 'Choose airline'] + @$dataairline, old('id_airlines'), ['class' => 'form-control id_airlines']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('flight_number', trans('Flight number'), ['class' => 'control-label']) !!}
            {!! Form::text('flight_number', old('flight_number') , ['class' => 'form-control', 'placeholder' => 'Input flight number Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('class', trans('Class'), ['class' => 'control-label']) !!}
            {!! Form::text('class', old('class') , ['class' => 'form-control', 'placeholder' => 'Input Class']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::text('status', old('status') , ['class' => 'form-control', 'placeholder' => 'Input Status']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('departure_date', trans('Departure date'), ['class' => 'control-label']) !!}
            {!! Form::date('departure_date', old('departure_date') , ['class' => 'form-control', 'placeholder' => 'Input departure date']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('arrival_date', trans('Arrival date'), ['class' => 'control-label']) !!}
            {!! Form::date('arrival_date', old('arrival_date') , ['class' => 'form-control', 'placeholder' => 'Input arrival date']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('allotment', trans('Allotment'), ['class' => 'control-label']) !!}
            {!! Form::number('allotment', old('allotment') , ['class' => 'form-control', 'placeholder' => 'Input allotment']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('reserve', trans('Reserve'), ['class' => 'control-label']) !!}
            {!! Form::textarea('reserve', null, [ 'class' => 'form-control', 'placeholder' => 'Reserve', 'rows' => '3x2' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sold', trans('Sold'), ['class' => 'control-label']) !!}
            {!! Form::textarea('sold', null, [ 'class' => 'form-control', 'placeholder' => 'Sold', 'rows' => '3x2' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('available', trans('Available'), ['class' => 'control-label']) !!}
            {!! Form::textarea('available', null, [ 'class' => 'form-control', 'placeholder' => 'Available', 'rows' => '3x2' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('reserve_tour', trans('Reserve tour'), ['class' => 'control-label']) !!}
            {!! Form::textarea('reserve_tour', null, [ 'class' => 'form-control', 'placeholder' => 'Reserve tour', 'rows' => '3x2' ]) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\AirAllotmentRequest', '#form-airallotment') !!}
<script>
    $(function(){
        spinnerLoad($('#form-airallotment'));
        initSelect2Remote($('.id_airport_from'), "{{ route('airport.search-data') }}", "Choose Airport", 0);
        initSelect2Remote($('.id_ariport_to'), "{{ route('airport.search-data') }}", "Choose Airport", 0);
        initSelect2Remote($('.id_airlines'), "{{ route('airline.search-data') }}", "Choose Airline", 0);
    });
</script>
@endsection