<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('invoice_no', trans('Invoice no'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_no', $invoiceNo , ['class' => 'form-control', 'placeholder' => 'Input the Invoice no','readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('invoice_date', trans('Date'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_date', $currentDate , ['class' => 'form-control', 'placeholder' => 'Input the Invoice date','readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trip_date', trans('Trip Date'), ['class' => 'control-label']) !!}
            {!! Form::date('trip_date', old('trip_date') , ['class' => 'form-control', 'placeholder' => 'Input the Trip date','required'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Input Address','rows'=>5]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
            {!! Form::select('type',  @$invoiceType, old('type'), [ 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sales_folder', trans('Sales Folder'), ['class' => 'control-label']) !!}
            {!! Form::select('sales_id', @$listSales, old('sales_id'), [ 'class' => 'form-control','required'=>true, 'onchange'=>'detailSales(value)']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('customer_name', trans('Customer Name'), ['class' => 'control-label']) !!}
            {!! Form::text('customer_name', old('customer_name') , ['class' => 'form-control', 'placeholder' => 'Auto','readonly'=>true,'required'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tc_id', trans('TC/ID'), ['class' => 'control-label']) !!}
            {!! Form::text('tc_id', old('tc_id') , ['class' => 'form-control', 'placeholder' => 'Auto','readonly'=>true,'required'=>true]) !!}
        </div>
        
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('base', trans('Base'), ['class' => 'control-label']) !!}
            {!! Form::select('base', ['' => 'Choose Currency'] + @$listSales, old('base'), [ 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('billing', trans('Billing'), ['class' => 'control-label']) !!}
            {!! Form::select('billing', ['' => 'Choose Currency'] + @$listSales, old('billing'), [ 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fop', trans('FOP'), ['class' => 'control-label']) !!}
            {!! Form::select('fop', @$fop, old('fop'), [ 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="sales-detail" style="width:100%;">
                <thead>
                    <tr class="text-center">
                        <th>Product No</th>
                        <th>Description</th>
                        <th>QTY</th>
                        <th>Total Sales</th>
                        <th>Unit Sales</th>
                        <th>GP%</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<hr>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\InvoiceRequest', '#form-invoice') !!}
<script>
    $(function(){
        spinnerLoad($('#form-invoice'));
    });
</script>

@include('contents.accountings.invoice.js.salesDetail')
@endsection