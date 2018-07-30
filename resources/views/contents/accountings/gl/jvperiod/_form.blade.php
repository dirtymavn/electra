<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fiscal_year', trans('Fiscal Year'), ['class' => 'control-label']) !!}
            {!! Form::selectYear('fiscal_year', 1900, 2030, old('fiscal_year') ,[ 'class' => 'form-control' ]) !!}

        </div>
        <div class="form-group">
            {!! Form::label('period_month', trans('Period Month'), ['class' => 'control-label']) !!}
            {!! Form::selectMonth('period_month', old('period_month') ,[ 'class' => 'form-control' ]) !!}

        </div>
        <div class="form-group">
            {!! Form::label('period_status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('period_status', ['1' => 'Active', '0' => 'Inactive'], old('period_status'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('start_date', trans('Start Date'), ['class' => 'control-label']) !!}
            {!! Form::date('start_date', old('start_date') , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('end_date', trans('End Date'), ['class' => 'control-label']) !!}
            {!! Form::date('end_date', old('end_date') , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('report_date', trans('Report Date'), ['class' => 'control-label']) !!}
            {!! Form::date('report_date', old('report_date') , ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Accounting\GL\JvPeriodRequest', '#form-jvperiod') !!}
<script>
    $(function(){
        spinnerLoad($('#form-jvperiod'));
    });
</script>
@endsection