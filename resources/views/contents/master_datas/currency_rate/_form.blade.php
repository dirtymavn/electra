<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('currency_name', trans('Currency Name'), ['class' => 'control-label']) !!}
            {!! Form::text('currency_name', old('currency_name') , ['class' => 'form-control', 'placeholder' => 'Input the Currency Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('currency_code', trans('Currency Code'), ['class' => 'control-label']) !!}
            {!! Form::text('currency_code', old('currency_code') , ['class' => 'form-control', 'placeholder' => 'Input the Currency Code']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#rates">Rate</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="rates">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary form-control btn-add-currencyrate col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="data-currencyrate" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Rate</th>
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
    <!-- Form Currency Rate .Start -->
    <div id="form-currencyrate-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-data-currency', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Itinerary Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="currencyrate_id" id="currencyrate_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('rate', trans('Rate'), ['class' => 'control-label']) !!}
                                {!! Form::text('rate', old('rate') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Rate']) !!}
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
    <!-- Form Currency Rate .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CurrencyRequest', '#form-currencyrate') !!}
<script>
    $(function(){
        spinnerLoad($('#form-currencyrate'));
    });

    $(document).ready(function() {
        var columns = [
            { data: 'rate', name: 'rate'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datas = {
            'type': 'data-currency'
        };

        initDatatable($('#data-currencyrate'), "{{route('currencyrate.get-data')}}", columns, datas);

        $('#form-data-currency').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('currencyrate.rate.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-currencyrate-modal').modal('hide');
                    $('#data-currencyrate').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-currencyrate', function(e) {
        $('#form-data-currency').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        $('#form-currencyrate-modal').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('currencyrate.data.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#data-currencyrate').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        $('#form-data-currency').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('currencyrate.data.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#rate').val(value.rate);
                $('#currencyrate_id').val(data.data.id);
                $('#form-currencyrate-modal').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>
@endsection