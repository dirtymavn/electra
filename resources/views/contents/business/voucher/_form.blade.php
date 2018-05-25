<div class="row element-voucher">
    <div class="col-md-5">
        <div class="element-wrapper">
            <p class="element-header">Voucher - Type Not Assigned</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('voucher_no', trans('Voucher No.'), ['class' => 'control-label']) !!}
                    {!! Form::text('voucher_no', old('voucher_no') , ['class' => 'form-control', 'placeholder' => 'Input the Voucher No.']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-md-5">
                            <button type="button" class="form-control btn btn-primary" disabled="true">Available</button>
                        </div>
                        <div class="col-md-7">
                            {!! Form::text('status', old('status') , ['class' => 'form-control', 'placeholder' => 'Input the Status', 'disabled' => true]) !!}
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('date', old('date') , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="element-wrapper">
            <p class="element-header">Currency</p>
            <div class="element-box">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::select('currency_code', ['idr' => 'IDR', 'dollar' => 'Dollar'], old('currency_code') , ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-9">
                            {!! Form::text('currency_amount', old('currency_value') , ['class' => 'form-control', 'placeholder' => 'Input the Nominal']) !!}
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    {!! Form::label('settled_amount', trans('Settled Amount'), ['class' => 'control-label']) !!}
                    {!! Form::text('settled_amount', old('settled_amount') , ['class' => 'form-control', 'placeholder' => 'Input the Settled Amount']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('available_amount', trans('Available Amount'), ['class' => 'control-label']) !!}
                    {!! Form::text('available_amount', old('available_amount') , ['class' => 'form-control', 'placeholder' => 'Input the Available Amount']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('invoice_no', trans('Invoice No.'), ['class' => 'control-label']) !!}
                    {!! Form::text('invoice_no', old('invoice_no') , ['class' => 'form-control', 'placeholder' => 'Input the Invoice No.']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="element-wrapper">
            <p class="element-header">Customer</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('customer_no', trans('Customer No.'), ['class' => 'control-label']) !!}
                    {!! Form::select('customer_no', ['' => 'Choose Customer'], old('customer_no') , ['class' => 'form-control col-md-6']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('address', old('address') , ['class' => 'form-control', 'placeholder' => 'Input the Address', 'rows' => '6']) !!}
                </div>
            </div>
        </div>
        <div class="element-wrapper">
            <div class="element-box">
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
                            {!! Form::date('valid_end', old('valid_end') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('transaferable', trans('Transferable'), ['class' => 'control-label']) !!}
                    {!! Form::select('transferable', ['yes' => 'Yes', 'no' => 'No'], old('transferable') , ['class' => 'form-control col-md-5']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row element-voucher">
    <div class="col-md-12">
        <div class="element-wrapper">
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('internal_description', trans('Internal Description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('internal_description', old('internal_description') , ['class' => 'form-control', 'placeholder' => 'Input the Internal Description', 'rows' => '6']) !!}
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
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Master\CompanyRequest', '#form-voucher') !!}
@endsection