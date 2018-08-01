<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('lg_no', trans('LG No'), ['class' => 'control-label']) !!}
            {!! Form::text('lg_no', $newCode , ['class' => 'form-control', 'placeholder' => '<Auto Number>', 'readOnly' => true]) !!}
        </div>
        {{-- <div class="form-group">
            {!! Form::label('lg_type', trans('LG Type'), ['class' => 'control-label']) !!}
            {!! Form::select('lg_type', ['Yes' => 'Yes', 'No' => 'No'], old('lg_type'), ['class' => 'form-control']) !!}
        </div> --}}
        <div class="form-group">
            {!! Form::label('lg_date', trans('LG Date'), ['class' => 'control-label']) !!}
            {!! Form::date('lg_date', old('lg_date') , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('delivery_status', trans('Delivery Status'), ['class' => 'control-label']) !!}
            {!! Form::select('delivery_status', ['Complete' => 'Complete', 'Inprogress' => 'In Progress'], old('delivery_status'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('supplier_ref_no', trans('Supplier Ref No'), ['class' => 'control-label']) !!}
            {!! Form::text('supplier_ref_no', old('supplier_ref_no') , ['class' => 'form-control', 'placeholder' => 'Input the Supplier Ref No']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('supplier_id', trans('Supplier'), ['class' => 'control-label']) !!}
            {!! Form::select('supplier_id', @$suppliers, old('supplier_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('credit_term_id', trans('Credit Term'), ['class' => 'control-label']) !!}
            {!! Form::select('credit_term_id', @$creditTerms, old('credit_term_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
            {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('footer', trans('Footer'), ['class' => 'control-label']) !!}
            {!! Form::textarea('footer', old('footer') , ['class' => 'form-control', 'placeholder' => 'Input the Footer', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_voucher', trans('Tour Voucher'), ['class' => 'control-label']) !!}
            {!! Form::textarea('tour_voucher', old('tour_voucher') , ['class' => 'form-control', 'placeholder' => 'Input the Tour Voucher', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('paid_amt', trans('Paid Amount'), ['class' => 'control-label']) !!}
            {!! Form::text('paid_amt', old('paid_amt') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Paid Amount']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('base_currency_id', trans('Base Currency'), ['class' => 'control-label']) !!}
            {!! Form::select('base_currency_id', @$baseCurrencys, old('base_currency_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('base_amt', trans('Base Amount'), ['class' => 'control-label']) !!}
            {!! Form::text('base_amt', old('base_amt') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Base Amount']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bill_currency_id', trans('Bill Currency'), ['class' => 'control-label']) !!}
            {!! Form::select('bill_currency_id', @$billCurrencys, old('bill_currency_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bill_amt', trans('Bill Amount'), ['class' => 'control-label']) !!}
            {!! Form::text('bill_amt', old('bill_amt') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Bill Amount']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lg_status', trans('LG Status'), ['class' => 'control-label']) !!}
            {!! Form::select('lg_status', ['Active' => 'Active', 'Inactive' => 'Inactive'], old('lg_status'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#detail">Detail</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="detail">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary form-control btn-add-lg col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="data-lg" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Code</th>
                                                        <th>Description</th>
                                                        <th>Qty</th>
                                                        <th>Unit Cost</th>
                                                        <th>Total Amt</th>
                                                        <th>Discount</th>
                                                        <th>Tax</th>
                                                        <th>GST Amt</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('models')
    <!-- Form LG Detail .Start -->
    <div id="form-lg-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-data-lg', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">LG Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="lg_id" id="lg_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
                                {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('product_code_description', trans('Product Code Description'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('product_code_description', old('product_code_description') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code Description', 'rows' => '4']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('qty', trans('Qty'), ['class' => 'control-label']) !!}
                                {!! Form::text('qty', old('qty') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Qty']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('unit_cost', trans('Unit Cost'), ['class' => 'control-label']) !!}
                                {!! Form::text('unit_cost', old('unit_cost') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Unit Cost']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('total_amt', trans('Total Amount'), ['class' => 'control-label']) !!}
                                {!! Form::text('total_amt', old('total_amt') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Total Amount']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('discount', trans('Discount'), ['class' => 'control-label']) !!}
                                {!! Form::text('discount', old('discount') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Discount']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tax', trans('Tax'), ['class' => 'control-label']) !!}
                                {!! Form::text('tax', old('tax') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Tax']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('gst_amt', trans('GST Amount'), ['class' => 'control-label']) !!}
                                {!! Form::text('gst_amt', old('gst_amt') , ['class' => 'form-control only_number', 'placeholder' => 'Input the GST Amount']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Form LG Detail .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Accounting\LgRequest', '#form-lg') !!}
<script>
    $(function(){
        spinnerLoad($('#form-lg'));
    });

    $(document).ready(function() {
        var columns = [
            { data: 'product_code', name: 'product_code'},
            { data: 'product_code_description', name: 'product_code_description'},
            { data: 'qty', name: 'qty'},
            { data: 'unit_cost', name: 'unit_cost'},
            { data: 'total_amt', name: 'total_amt'},
            { data: 'discount', name: 'discount'},
            { data: 'tax', name: 'tax'},
            { data: 'gst_amt', name: 'gst_amt'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datas = {
            'type': 'data-lg'
        };

        initDatatable($('#data-lg'), "{{route('lg.get-data')}}", columns, datas);

        $('#form-data-lg').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('lg.detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-lg-modal').modal('hide');
                    $('#data-lg').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-lg', function(e) {
        $('#form-data-lg').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        $('#form-lg-modal').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('lg.data.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#data-lg').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        $('#form-data-lg').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('lg.data.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#product_code').val(value.product_code);
                $('#product_code_description').val(value.product_code_description);
                $('#qty').val(value.qty);
                $('#unit_cost').val(value.unit_cost);
                $('#total_amt').val(value.total_amt);
                $('#discount').val(value.discount);
                $('#tax').val(value.tax);
                $('#gst_amt').val(value.gst_amt);
                $('#lg_id').val(data.data.id);
                $('#form-lg-modal').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>
@endsection