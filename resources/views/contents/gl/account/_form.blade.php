<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('id_branch', trans('ID Branch'), ['class' => 'control-label']) !!}
            {!! Form::select('id_branch', ['' => 'Choose Branch'], old('id_branch'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('acc_no_key', trans('Acc. No. Key'), ['class' => 'control-label']) !!}
            {!! Form::text('acc_no_key', old('acc_no_key') , ['class' => 'form-control', 'placeholder' => 'Input the Acc. No. Key']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('acc_no_interface', trans('Acc. No. Interface'), ['class' => 'control-label']) !!}
            {!! Form::text('acc_no_interface', old('acc_no_interface') , ['class' => 'form-control', 'placeholder' => 'Input the Acc. No. Interface']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('coa_status', trans('COA Status'), ['class' => 'control-label']) !!}
            {!! Form::select('coa_status', ['1' => 'Yes', '0' => 'No'], old('coa_status'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('acc_description', trans('Acc. Description'), ['class' => 'control-label']) !!}
            {!! Form::textarea('acc_description', old('acc_description') , ['class' => 'form-control', 'placeholder' => 'Input the Acc. Description', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sub_acc_id', trans('Sub Acc.'), ['class' => 'control-label']) !!}
            {!! Form::select('sub_acc_id', ['' => 'Choose Sub Acc.'], old('sub_acc_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('acc_type', trans('Acc. Type'), ['class' => 'control-label']) !!}
            {!! Form::text('acc_type', old('acc_type') , ['class' => 'form-control', 'placeholder' => 'Input the Acc. Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('rollup_key_acc_no', trans('Rollup Key Acc. No.'), ['class' => 'control-label']) !!}
            {!! Form::text('rollup_key_acc_no', old('rollup_key_acc_no') , ['class' => 'form-control', 'placeholder' => 'Input the Rollup Key Acc. No.']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('acc_liquidity', trans('Acc. Liquidity'), ['class' => 'control-label']) !!}
            {!! Form::text('acc_liquidity', old('acc_liquidity') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Acc. Liquidity']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('rollup_detail', trans('Rollup Detail'), ['class' => 'control-label']) !!}
            {!! Form::text('rollup_detail', old('rollup_detail') , ['class' => 'form-control', 'placeholder' => 'Input the Rollup Detail']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('analysis_type', trans('Analysis Type'), ['class' => 'control-label']) !!}
            {!! Form::text('analysis_type', old('analysis_type') , ['class' => 'form-control', 'placeholder' => 'Input the Analysis Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('foreign_currency_only_flag', trans('Foreign Currency Only Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('foreign_currency_only_flag', ['1' => 'Yes', '0' => 'No'], old('foreign_currency_only_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ap_ar_control_flag', trans('AP AR Control Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('ap_ar_control_flag', ['1' => 'Yes', '0' => 'No'], old('ap_ar_control_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_account_flag', trans('Tour Account Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('tour_account_flag', ['1' => 'Yes', '0' => 'No'], old('tour_account_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fx_adjustment_flag', trans('FX Adjustment Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('fx_adjustment_flag', ['1' => 'Yes', '0' => 'No'], old('fx_adjustment_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('inter_branch_acc_flag', trans('Inter Branch Acc. Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('inter_branch_acc_flag', ['1' => 'Yes', '0' => 'No'], old('inter_branch_acc_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('internal_payment_flag', trans('Internal Payment Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('internal_payment_flag', ['1' => 'Yes', '0' => 'No'], old('internal_payment_flag'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\GL\AccountRequest', '#form-account') !!}
<script>
    $(function(){
        spinnerLoad($('#form-account'));
    });
</script>
@endsection