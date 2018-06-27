<div class="row element-voucher">
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header">Voucher - Type Not Assigned</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('voucher_no', trans('Voucher No.'), ['class' => 'control-label']) !!}
                    {!! Form::text('voucher_no', old('voucher_no') , ['class' => 'form-control', 'placeholder' => 'Input the Voucher No.']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('voucher_status', trans('Status'), ['class' => 'control-label']) !!}
                    {!! Form::select('voucher_status', ['avaliable' => 'Avaliable', 'no_avaliable' => 'No Avaliable'], old('currency_code') , ['class' => 'form-control']) !!}
                </div>  
                <div class="form-group">
                    {!! Form::label('voucher_date', trans('Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('voucher_date', old('voucher_date') , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::select('voucher_currency', ['idr' => 'IDR', 'dollar' => 'Dollar'], old('voucher_currency') , ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-9">
                            {!! Form::text('voucher_amt', old('voucher_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Nominal']) !!}
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    {!! Form::label('valid', trans('Valid'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::date('valid_from', old('valid_from') , ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-1">
                            <p>To</p>
                        </div>
                        <div class="col-md-5">
                            {!! Form::date('valid_to', old('valid_to') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('transferrable_flag', trans('Transferable'), ['class' => 'control-label']) !!}
                    {!! Form::select('transferrable_flag', ['yes' => 'Yes', 'no' => 'No'], old('transferrable_flag') , ['class' => 'form-control col-md-5']) !!}
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header">Customer</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('customer_no', trans('Customer No.'), ['class' => 'control-label']) !!}
                    {!! Form::select('customer_no', ['' => 'Choose Customer'], old('customer_no') , ['class' => 'form-control col-md-6']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('cust_name', trans('Name'), ['class' => 'control-label']) !!}
                    {!! Form::text('cust_name', old('cust_name') , ['class' => 'form-control', 'placeholder' => 'Input the Customer Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('cust_address', trans('Address'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('cust_address', old('cust_address') , ['class' => 'form-control', 'placeholder' => 'Input the Address', 'rows' => '6']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="element-wrapper">
            <div class="">
                <div class="form-group">
                    {!! Form::label('internal_desc', trans('Internal Description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('internal_desc', old('internal_desc') , ['class' => 'form-control', 'placeholder' => 'Input the Internal Description', 'rows' => '6']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('desc', trans('Description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('desc', old('desc') , ['class' => 'form-control', 'placeholder' => 'Input the Description', 'rows' => '6']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\VoucherRequest', '#form-voucher') !!}
@endsection