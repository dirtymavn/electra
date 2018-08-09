<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('invoice_no', trans('Invoice no'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_no', old('invoice_no') , ['class' => 'form-control', 'placeholder' => 'Input the Invoice no']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sales_id', trans('Sales'), ['class' => 'control-label']) !!}
            {!! Form::select('sales_id', ['' => 'Choose Sales'] + @$listSales, old('sales_id'), [ 'class' => 'form-control select2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('invoice_status', trans('Invoice status'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_status', old('invoice_status') , ['class' => 'form-control', 'placeholder' => 'Input the Invoice status']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('invoice_date', trans('Invoice date'), ['class' => 'control-label']) !!}
            {!! Form::date('invoice_date', old('invoice_date') , ['class' => 'form-control', 'placeholder' => 'Input the Invoice date']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trip_date', trans('Trip date'), ['class' => 'control-label']) !!}
            {!! Form::date('trip_date', old('trip_date') , ['class' => 'form-control', 'placeholder' => 'Input the Trip date']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('customer_credit_term_id', trans('Customer credit term'), ['class' => 'control-label']) !!}
            {!! Form::select('customer_credit_term_id', ['' => 'Choose Cust Credit'] + @$listCustCredit, old('customer_credit_term_id'), [ 'class' => 'form-control select2']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('base_currency', trans('Base currency'), ['class' => 'control-label']) !!}
            {!! Form::text('base_currency', old('base_currency') , ['class' => 'form-control', 'placeholder' => 'Input the Base currency']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('base_amt', trans('Base amt'), ['class' => 'control-label']) !!}
            {!! Form::number('base_amt', old('base_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Base amt']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bill_currency', trans('Bill currency'), ['class' => 'control-label']) !!}
            {!! Form::text('bill_currency', old('bill_currency') , ['class' => 'form-control', 'placeholder' => 'Input the Bill currency']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bill_amt', trans('Bill amt'), ['class' => 'control-label']) !!}
            {!! Form::number('bill_amt', old('bill_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Bill amt']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('seattled_amt', trans('Seattled amt'), ['class' => 'control-label']) !!}
            {!! Form::number('seattled_amt', old('seattled_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Seattled amt']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fop', trans('fop'), ['class' => 'control-label']) !!}
            {!! Form::text('fop', old('fop') , ['class' => 'form-control', 'placeholder' => 'Input the fop']) !!}
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#invoicecustomer">Invoice Customer</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#invoicedetail">Invoice Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#invoicerefund">Invoice Refund</a></li>
                </ul>
            </div>
            <div class="tab-content">
                
                <div class="tab-pane active show" id="invoicecustomer">
                    @include('contents.business.invoice.parts.invoicecustomer')
                </div>
                <div class="tab-pane" id="invoicedetail">
                    @include('contents.business.invoice.parts.invoicedetail')
                </div>
                <div class="tab-pane" id="invoicerefund">
                    @include('contents.business.invoice.parts.invoicerefund')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\InvoiceRequest', '#form-invoice') !!}
<script>
    $(function(){
        spinnerLoad($('#form-invoice'));
    });
</script>

@include('contents.business.invoice.js.invoicedetail')
@include('contents.business.invoice.js.invoicerefund')
@endsection