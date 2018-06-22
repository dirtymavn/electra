<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('postdate_start', trans('Post Date Start'), ['class' => 'control-label']) !!}
            {!! Form::date('postdate_start', old('postdate_start') , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('postdate_end', trans('Post Date End'), ['class' => 'control-label']) !!}
            {!! Form::date('postdate_end', old('postdate_end') , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('branch_id', trans('Branch'), ['class' => 'control-label']) !!}
            {!! Form::select('branch_id', ['' => 'Choose Branch'], old('branch_id'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#result">Result</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#detail">Detail</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="result">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('inventory_id', trans('Invetory'), ['class' => 'control-label']) !!}
                                        {!! Form::select('inventory_id', ['' => 'Choose Invetory'], old('inventory_id'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('inventory_code', trans('Inventory Code'), ['class' => 'control-label']) !!}
                                        {!! Form::text('inventory_code', old('inventory_code') , ['class' => 'form-control', 'placeholder' => 'Input the Inventory Code']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('qty', trans('Quantity'), ['class' => 'control-label']) !!}
                                        {!! Form::number('qty', old('qty') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Quantity']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('avg_price', trans('Avg. Price'), ['class' => 'control-label']) !!}
                                        {!! Form::text('avg_price', old('avg_price') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Avg. Price']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="detail">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary form-control btn-add-detail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="posting-detail" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Subject</th>
                                                        <th>Type</th>
                                                        <th>In Qty</th>
                                                        <th>In Price</th>
                                                        <th>In Total</th>
                                                        <th>Out Qty</th>
                                                        <th>Out Price</th>
                                                        <th>Out Total</th>
                                                        <th>Result Qty</th>
                                                        <th>Result Price</th>
                                                        <th>Result Total</th>
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
    <!-- Form post Detail .Start -->
    <div id="form-detail" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-posting-detail', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Posting Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="trx_posting_id" id="trx_posting_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('transaction_subject', trans('Transaction Subject'), ['class' => 'control-label']) !!}
                                {!! Form::text('transaction_subject', old('transaction_subject'), ['class' => 'form-control', 'placeholder' => 'Input the Transaction Subject']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('transaction_type', trans('Transaction Type'), ['class' => 'control-label']) !!}
                                {!! Form::text('transaction_type', old('transaction_type'), ['class' => 'form-control', 'placeholder' => 'Input the Transaction Type']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('in_qty', trans('In Qty'), ['class' => 'control-label']) !!}
                                {!! Form::text('in_qty', old('in_qty'), ['class' => 'form-control only_number', 'placeholder' => 'Input the In Qty']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('in_price', trans('In Price'), ['class' => 'control-label']) !!}
                                {!! Form::text('in_price', old('in_price'), ['class' => 'form-control only_number', 'placeholder' => 'Input the In Price']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('in_total', trans('In Total'), ['class' => 'control-label']) !!}
                                {!! Form::text('in_total', old('in_total'), ['class' => 'form-control only_number', 'placeholder' => 'Input the In Total']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('out_qty', trans('Out Qty'), ['class' => 'control-label']) !!}
                                {!! Form::text('out_qty', old('out_qty'), ['class' => 'form-control only_number', 'placeholder' => 'Output the In Qty']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('out_price', trans('Out Price'), ['class' => 'control-label']) !!}
                                {!! Form::text('out_price', old('out_price'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Out Price']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('out_total', trans('Out Total'), ['class' => 'control-label']) !!}
                                {!! Form::text('out_total', old('out_total'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Out Total']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('result_qty', trans('Result Qty'), ['class' => 'control-label']) !!}
                                {!! Form::text('result_qty', old('result_qty'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Result Qty']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('result_avg', trans('Result Avg'), ['class' => 'control-label']) !!}
                                {!! Form::text('result_avg', old('result_avg'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Result Avg']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('result_total', trans('Result Total'), ['class' => 'control-label']) !!}
                                {!! Form::text('result_total', old('result_total'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Result Total']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="form-detail-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                    </a>
                    <button id="form-detail-accept" type="submit" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Form Post Detail .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\GL\PeriodEndRequest', '#form-periodend') !!}
<script>
    $(function(){
        spinnerLoad($('#form-periodend'));
    });

    $(document).ready(function() {
        var detailColumns = [
            { data: 'transaction_subject', name: 'transaction_subject'},
            { data: 'transaction_type', name: 'transaction_type'},
            { data: 'in_qty', name: 'in_qty'},
            { data: 'in_price', name: 'in_price'},
            { data: 'in_total', name: 'in_total'},
            { data: 'out_qty', name: 'out_qty'},
            { data: 'out_price', name: 'out_price'},
            { data: 'out_total', name: 'out_total'},
            { data: 'result_qty', name: 'result_qty'},
            { data: 'result_avg', name: 'result_avg'},
            { data: 'result_total', name: 'result_total'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var detailDatas = {
            'type': 'posting-detail'
        };

        initDatatable($('#posting-detail'), "{{route('periodend.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-posting-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('periodend.posting-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-detail').modal('hide');
                    $('#posting-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-detail', function(e) {
        $('#form-posting-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-detail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('periodend.posting-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#posting-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('periodend.posting-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#transaction_subject').val(value.transaction_subject);
                $('#transaction_type').val(value.transaction_type);
                $('#in_qty').val(value.in_qty);
                $('#in_price').val(value.in_price);
                $('#in_total').val(value.in_total);
                $('#out_qty').val(value.out_qty);
                $('#out_price').val(value.out_price);
                $('#out_total').val(value.out_total);
                $('#result_qty').val(value.result_qty);
                $('#result_price').val(value.result_price);
                $('#result_avg').val(value.result_avg);
                $('#trx_posting_id').val(data.data.id);
                $('#form-detail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>
@endsection