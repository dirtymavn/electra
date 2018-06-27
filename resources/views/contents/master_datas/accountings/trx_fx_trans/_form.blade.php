<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('invoice_flag', trans('Invoice Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('invoice_flag', ['1' => 'Yes', '0' => 'No'], old('invoice_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('letter_of_guarantee_flag', trans('Letter of Guarantee Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('letter_of_guarantee_flag', ['1' => 'Yes', '0' => 'No'], old('letter_of_guarantee_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('credit_note_flag', trans('Credit Note Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('credit_note_flag', ['1' => 'Yes', '0' => 'No'], old('credit_note_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('deposit_overpayment_flag', trans('Deposit Overpayment Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('deposit_overpayment_flag', ['1' => 'Yes', '0' => 'No'], old('deposit_overpayment_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ap_deposit_flag', trans('AP Deposit Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('ap_deposit_flag', ['1' => 'Yes', '0' => 'No'], old('ap_deposit_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cash_account_flag', trans('Cash Account Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('cash_account_flag', ['1' => 'Yes', '0' => 'No'], old('cash_account_flag'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bank_account_flag', trans('Bank Account Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('bank_account_flag', ['1' => 'Yes', '0' => 'No'], old('bank_account_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('other_account_flag', trans('Other Account Flag'), ['class' => 'control-label']) !!}
            {!! Form::select('other_account_flag', ['1' => 'Yes', '0' => 'No'], old('other_account_flag'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('jv_period', trans('JV Period'), ['class' => 'control-label']) !!}
            {!! Form::text('jv_period', old('jv_period') , ['class' => 'form-control', 'placeholder' => 'Input the JV Period']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('acc_type', trans('Acc. Type'), ['class' => 'control-label']) !!}
            {!! Form::text('acc_type', old('acc_type') , ['class' => 'form-control', 'placeholder' => 'Input the Acc. Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fx_acc', trans('FX Acc.'), ['class' => 'control-label']) !!}
            {!! Form::text('fx_acc', old('fx_acc') , ['class' => 'form-control', 'placeholder' => 'Input the FX Acc.']) !!}
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
                                        <button type="button" class="btn btn-primary form-control btn-add-detail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="fx-detail" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Currency</th>
                                                        <th>Exchange Rate</th>
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
    <!-- Form FX Detail .Start -->
    <div id="form-detail" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-fx-detail', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">FX Transaction Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="trx_fx_transaction_id" id="trx_fx_transaction_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('currency', trans('Currency'), ['class' => 'control-label']) !!}
                                {!! Form::text('currency', old('currency'), ['class' => 'form-control', 'placeholder' => 'Input the Currency']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('exchange_rate', trans('Exchange Rate'), ['class' => 'control-label']) !!}
                                {!! Form::text('exchange_rate', old('exchange_rate'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Exchange Rate']) !!}
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
    <!-- Form FX Detail .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\Accounting\TrxFxTransRequest', '#form-fxtrans') !!}
<script>
    $(function(){
        spinnerLoad($('#form-fxtrans'));
    });

    $(document).ready(function() {
        var detailColumns = [
            { data: 'currency', name: 'currency'},
            { data: 'exchange_rate', name: 'exchange_rate'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var detailDatas = {
            'type': 'fxTrans-detail'
        };

        initDatatable($('#fx-detail'), "{{route('fx-trans.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-fx-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('fx-trans.fx-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-detail').modal('hide');
                    $('#fx-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-detail', function(e) {
        $('#form-fx-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-detail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fx-trans.fx-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#fx-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fx-trans.fx-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#currency').val(value.currency);
                $('#exchange_rate').val(value.exchange_rate);
                $('#trx_fx_transaction_id').val(data.data.id);
                $('#form-detail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>
@endsection