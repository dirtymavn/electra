<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('number', trans('Number'), ['class' => 'control-label']) !!}
            {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => 'Input Credit Card Number']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('expire_date', trans('Expire Date'), ['class' => 'control-label']) !!}
            {!! Form::date('expire_date', old('expire_date') , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input Credit Card Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, [ 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => '3x2' ]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('state', trans('State'), ['class' => 'control-label']) !!}
            {!! Form::text('state', old('state') , ['class' => 'form-control', 'placeholder' => 'Input Credit Card State']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('city', trans('city'), ['class' => 'control-label']) !!}
            {!! Form::text('city', old('city') , ['class' => 'form-control', 'placeholder' => 'Input Credit Card City']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('zipcode', trans('zipcode'), ['class' => 'control-label']) !!}
            {!! Form::text('zipcode', old('zipcode') , ['class' => 'form-control', 'placeholder' => 'Input Credit Card Zipcode']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cvv', trans('cvv'), ['class' => 'control-label']) !!}
            {!! Form::text('cvv', old('cvv') , ['class' => 'form-control', 'placeholder' => 'Input Credit Card CVV']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CreditCardRequest', '#form-creditcard') !!}
<script>
    $(function(){
        spinnerLoad($('#form-creditcard'));
    });
</script>
@endsection