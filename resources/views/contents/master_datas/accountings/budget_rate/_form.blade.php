<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('acc_period_mo', trans('Acc. Period Mo.'), ['class' => 'control-label']) !!}
            {!! Form::month('acc_period_mo', old('acc_period_mo') , ['class' => 'form-control', 'placeholder' => 'Input the Fiscal Year']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('from_currency', trans('From Currency'), ['class' => 'control-label']) !!}
            {{-- {!! Form::text('from_currency', old('from_currency') , ['class' => 'form-control', 'placeholder' => 'Input the From Currency']) !!} --}}
            {!! Form::select('from_currency', @$currency, old('from_currency'), ['class' => 'form-control', 'placeholder' => 'Choose From Currency']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('to_currency', trans('To Currency'), ['class' => 'control-label']) !!}
            {{-- {!! Form::text('to_currency', old('to_currency') , ['class' => 'form-control', 'placeholder' => 'Input the To Currency']) !!} --}}
            {!! Form::select('to_currency', @$currency, old('to_currency'), ['class' => 'form-control', 'placeholder' => 'Choose To Currency']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('exchange_rate', trans('Exchange Rate'), ['class' => 'control-label']) !!}
            {!! Form::text('exchange_rate', old('exchange_rate') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Exchange Rate']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\Accounting\BudgetRateRequest', '#form-budgetrate') !!}
<script>
    $(function(){
        spinnerLoad($('#form-budgetrate'));
    });
</script>
@endsection