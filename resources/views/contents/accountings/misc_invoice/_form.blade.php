<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('invoice_no', trans('Invoice no'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_no', $invoiceNo , ['class' => 'form-control', 'placeholder' => 'Input the Invoice no','required'=>true,'readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('invoice_date', trans('Date'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_date', $currentDate , ['class' => 'form-control', 'placeholder' => 'Input the Invoice date','required'=>true,'readonly'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', trans('Customer Address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'placeholder' => 'Input Address','required'=>true,'rows'=>5]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('misc_invoice_type', trans('Type'), ['class' => 'control-label']) !!}
            {!! Form::select('misc_invoice_type',  @$invoiceType, old('misc_invoice_type'), [ 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('customer_id', trans('Customer Name'), ['class' => 'control-label']) !!}
            {!! Form::select('customer_id',[''=>'Choose Customer']+ @$listCustomer, old('customer_id'), [ 'class' => 'form-control','required'=>true, 'onchange'=>'detailCustomer(value)']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('attention', trans('Attention'), ['class' => 'control-label']) !!}
            {!! Form::text('attention', old('attention') , ['class' => 'form-control', 'placeholder' => 'Auto','readonly'=>true,'required'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tc_id', trans('TC/ID'), ['class' => 'control-label']) !!}
            {!! Form::text('tc_id', old('tc_id') , ['class' => 'form-control', 'placeholder' => 'Auto','readonly'=>true,'required'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sales_id', trans('Sales ID'), ['class' => 'control-label']) !!}
            {!! Form::text('sales_id', old('sales_id') , ['class' => 'form-control', 'placeholder' => 'Auto','readonly'=>true,'required'=>true]) !!}
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('base_currency', trans('Base'), ['class' => 'control-label']) !!}
            {!! Form::select('base_currency', @$currency,old('base_currency'), [ 'class' => 'form-control','required'=>true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('billing_currency', trans('Billing'), ['class' => 'control-label']) !!}
            {!! Form::select('billing_currency', @$currency, old('billing_currency'),[ 'class' => 'form-control','required'=>true]) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="invoicedetail-detail" style="width:100%;">
                <thead>
                    <tr class="text-center">
                        <th width="10px" class="checklist sorting_desc" rowspan="1" colspan="1" style="width: 13px;" aria-label=""><input type="checkbox" class="checklist" id="dataTablesCheckbox"></th>
                        <th>Product No</th>
                        <th>Description</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Total Sales</th>
                        <th>GST%</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
        <button type="button" class="btn btn-danger" id="bulk-delete"><i class="fa fa-trash m-right-10"></i> Delete Selected</button>
        <button type="button" class="btn btn-primary pull-right" id="add-new" data-toggle="modal" data-target="#form-invoicedetail">Add Item</button>
        </div>
    </div>
</div>
<hr>

@section('part_script')
{{-- <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script> --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\Business\InvoiceRequest', '#form-invoice') !!} --}}
<script>
    $(function(){
        spinnerLoad($('#form-invoice'));
    });
</script>

@include('contents.accountings.misc_invoice.parts.invoicedetail')
@endsection