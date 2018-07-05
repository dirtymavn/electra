<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('passenger_class_name', trans('Passenger Class Name'), ['class' => 'control-label']) !!}
            {!! Form::text('passenger_class_name', old('passenger_class_name') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Class Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('passenger_class_code', trans('Passenger Class Code'), ['class' => 'control-label']) !!}
            {!! Form::text('passenger_class_code', old('passenger_class_code') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Class Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('passenger_class_type', trans('Passenger Class Type'), ['class' => 'control-label']) !!}
            {!! Form::text('passenger_class_type', old('passenger_class_type') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Class Code']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\PassengerClassRequest', '#form-passenger') !!}
<script>
    $(function(){
        spinnerLoad($('#form-passenger'));
    });
</script>
@endsection