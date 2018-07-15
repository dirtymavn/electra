<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
            {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('product_name', trans('Product Name'), ['class' => 'control-label']) !!}
            {!! Form::text('product_name', old('product_name') , ['class' => 'form-control', 'placeholder' => 'Input the Product Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('product_description', trans('Product Description'), ['class' => 'control-label']) !!}
            {!! Form::textarea('product_description', old('product_description') , ['class' => 'form-control', 'placeholder' => 'Input the Product Description', 'rows' => '4']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', [1 => 'Yes', 0 => 'No'], old('status'), ['class' => 'form-control']) !!}
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
                                        <button type="button" class="btn btn-primary form-control btn-add-productcode col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="data-productcode" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Code Type</th>
                                                        <th>Commission Based</th>
                                                        <th>Inventory Control</th>
                                                        <th>Package Product</th>
                                                        <th>Is Domestic</th>
                                                        <th>No Profit Approval</th>
                                                        <th>Trx Fee</th>
                                                        <th>Misc Invoice</th>
                                                        <th>Hotel Conf. Advice</th>
                                                        <th>Gst Compulsory</th>
                                                        <th>Profit Markup</th>
                                                        <th>Profit Markup Amt</th>
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
    <!-- Form Product Code .Start -->
    <div id="form-productcode-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-data-productcode', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Itinerary Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="productcode_id" id="productcode_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('code_type', trans('Code Type'), ['class' => 'control-label']) !!}
                                {!! Form::text('code_type', old('code_type') , ['class' => 'form-control', 'placeholder' => 'Input the Code Type']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('commission_based', trans('Commission Based'), ['class' => 'control-label']) !!}
                                {!! Form::select('commission_based', [1 => 'Yes', 0 => 'No'], old('commission_based'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('inventory_control', trans('Inventory Control'), ['class' => 'control-label']) !!}
                                {!! Form::select('inventory_control', [1 => 'Yes', 0 => 'No'], old('inventory_control'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('package_product', trans('Package Product'), ['class' => 'control-label']) !!}
                                {!! Form::select('package_product', [1 => 'Yes', 0 => 'No'], old('package_product'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_domestic', trans('Is Domestic'), ['class' => 'control-label']) !!}
                                {!! Form::select('is_domestic', [1 => 'Yes', 0 => 'No'], old('is_domestic'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('no_profit_approval', trans('No Profit Approval'), ['class' => 'control-label']) !!}
                                {!! Form::select('no_profit_approval', [1 => 'Yes', 0 => 'No'], old('no_profit_approval'), ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('trx_fee', trans('Trx Fee'), ['class' => 'control-label']) !!}
                                {!! Form::select('trx_fee', [1 => 'Yes', 0 => 'No'], old('trx_fee'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('misc_invoice', trans('Misc Invoice'), ['class' => 'control-label']) !!}
                                {!! Form::select('misc_invoice', [1 => 'Yes', 0 => 'No'], old('misc_invoice'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('hotel_conf_advice', trans('Hotel Conf. Advice'), ['class' => 'control-label']) !!}
                                {!! Form::select('hotel_conf_advice', [1 => 'Yes', 0 => 'No'], old('hotel_conf_advice'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('gst_compulsory', trans('GST Compulsory'), ['class' => 'control-label']) !!}
                                {!! Form::select('gst_compulsory', [1 => 'Yes', 0 => 'No'], old('gst_compulsory'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('profit_markup', trans('Profit Markup'), ['class' => 'control-label']) !!}
                                {!! Form::select('profit_markup', [1 => 'Yes', 0 => 'No'], old('profit_markup'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('profit_markup_amt', trans('Profit Markup AMT'), ['class' => 'control-label']) !!}
                                {!! Form::text('profit_markup_amt', old('profit_markup_amt') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Profit Markup AMT']) !!}
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
    <!-- Form Product Code .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\ProductCodeRequest', '#form-productcode') !!}
<script>
    $(function(){
        spinnerLoad($('#form-productcode'));
    });

    $(document).ready(function() {
        var columns = [
            { data: 'code_type', name: 'code_type'},
            { data: 'commission_based', name: 'commission_based', className: 'dt-center'},
            { data: 'inventory_control', name: 'inventory_control', className: 'dt-center'},
            { data: 'package_product', name: 'package_product', className: 'dt-center'},
            { data: 'is_domestic', name: 'is_domestic', className: 'dt-center'},
            { data: 'no_profit_approval', name: 'no_profit_approval', className: 'dt-center'},
            { data: 'trx_fee', name: 'trx_fee', className: 'dt-center'},
            { data: 'misc_invoice', name: 'misc_invoice', className: 'dt-center'},
            { data: 'hotel_conf_advice', name: 'hotel_conf_advice', className: 'dt-center'},
            { data: 'gst_compulsory', name: 'gst_compulsory', className: 'dt-center'},
            { data: 'profit_markup', name: 'profit_markup', className: 'dt-center'},
            { data: 'profit_markup_amt', name: 'profit_markup_amt'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datas = {
            'type': 'data-productcode'
        };

        initDatatable($('#data-productcode'), "{{route('productcode.get-data')}}", columns, datas);

        $('#form-data-productcode').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('productcode.rate.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-productcode-modal').modal('hide');
                    $('#data-productcode').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-productcode', function(e) {
        $('#form-data-productcode').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        $('#form-productcode-modal').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('productcode.data.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#data-productcode').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        $('#form-data-productcode').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('productcode.data.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#code_type').val(value.code_type),
                $('#commission_based').val(value.commission_based),
                $('#inventory_control').val(value.inventory_control),
                $('#package_product').val(value.package_product),
                $('#is_domestic').val(value.is_domestic),
                $('#no_profit_approval').val(value.no_profit_approval),
                $('#trx_fee').val(value.trx_fee),
                $('#misc_invoice').val(value.misc_invoice),
                $('#hotel_conf_advice').val(value.hotel_conf_advice),
                $('#gst_compulsory').val(value.gst_compulsory),
                $('#profit_markup').val(value.profit_markup),
                $('#profit_markup_amt').val(value.profit_markup_amt),
                $('#productcode_id').val(data.data.id);
                $('#form-productcode-modal').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>
@endsection