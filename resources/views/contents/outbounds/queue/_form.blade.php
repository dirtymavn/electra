<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('document_type', trans('Document Type'), ['class' => 'control-label']) !!}
            {!! Form::text('document_type', old('document_type') , ['class' => 'form-control', 'placeholder' => 'Input the Document Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('document_uri', trans('Document URI'), ['class' => 'control-label']) !!}
            {!! Form::text('document_uri', old('document_uri') , ['class' => 'form-control', 'placeholder' => 'Input the Document URI']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('branch_id', trans('Branch'), ['class' => 'control-label']) !!}
            {!! Form::select('branch_id', ['' => 'Choose Branch'] + @$branchs, old('branch_id'), ['class' => 'form-control branch-id']) !!}
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#main">Queue Message</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="main">
                    <div class="element-wrapper">
                        <div class="element-box">

                           <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary form-control btn-add-document col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                </div>
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="data-document" style="width:100%;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Due Date</th>
                                                    <th>Subject</th>
                                                    <th>Target Role</th>
                                                    <!-- <th>Spesific Role</th> -->
                                                    <th>Status</th>
                                                    <th>Queue Message</th>
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
<div id="form-document-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-data-document', 'method' => 'post']) !!}
            <div class="modal-header">
                <h4 class="modal-title">Queue Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" name="queue_id" id="queue_id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('subject', trans('Subject'), ['class' => 'control-label']) !!}
                            {!! Form::text('subject', old('subject') , ['class' => 'form-control', 'placeholder' => 'Input the Subject']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('due_date', trans('Due Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('due_date', old('due_date') , ['class' => 'form-control', 'placeholder' => 'Input the Due Date']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('queue_branch_id', trans('Branch'), ['class' => 'control-label']) !!}
                            {!! Form::select('queue_branch_id', ['' => 'Choose Branch'] + @$branchs, old('queue_branch_id'), ['class' => 'form-control branch-id branch-modal']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('target_role', trans('Target Role'), ['class' => 'control-label']) !!}
                            {!! Form::select('target_role', ['' => 'Choose Role'] + @$roles, old('target_role') , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'],old('status') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none;">
                        <div class="form-group">
                            {!! Form::label('spesific_role', trans('Spesific Role'), ['class' => 'control-label']) !!}
                            {!! Form::number('spesific_role', old('spesific_role') , ['class' => 'form-control', 'placeholder' => 'Input the Spesific Role']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('queue_message', trans('Queue Message'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('queue_message', old('queue_message') , ['class' => 'form-control ckeditor', 'placeholder' => 'Input the Queue Message', 'rows' => '3x6']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\MasterData\DocumentRequest', '#form-outboundqueue') !!}
<script>
    $(function(){
        spinnerLoad($('#form-outboundqueue'));
        initSelect2Remote($('.branch-id'), "{{ route('branch.search-data') }}", "Choose Branch", 0);
        initSelect2Remote($('#target_role'), "{{ route('role.search-data') }}", "Choose Role", 0, true);
    });

    $(document).ready(function() {
        var columns = [
        { data: 'due_date', name: 'due_date'},
        { data: 'subject', name: 'subject'},
        { data: 'target_role', name: 'target_role'},
        // { data: 'spesific_role', name: 'spesific_role'},
        { data: 'status', name: 'status'},
        { data: 'queue_message', name: 'queue_message'},
        { data: 'action', name: 'action', className: 'dt-center'},
        ];
        
        var datas = {
            'type': 'data-outboundqueue'
        };

        initDatatable($('#data-document'), "{{route('outboundqueue.get-data')}}", columns, datas);

        $('#form-data-document').submit(function(e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('outboundqueue.rate.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-document-modal').modal('hide');
                    $('#data-document').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-document', function(e) {
        $('#form-data-document').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        CKEDITOR.instances['queue_message'].setData('');
        $('#form-document-modal').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('outboundqueue.data.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#data-document').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        $('#form-data-document').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('outboundqueue.data.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                CKEDITOR.instances['queue_message'].setData(value.queue_message);
                $('#due_date').val(value.due_date);
                $('#subject').val(value.subject);
                $('#target_role').select2().val(value.target_role);
                initSelect2Remote($('#target_role'), "{{ route('role.search-data') }}", "Choose Role", 0, true);
                $('#spesific_role').val(value.spesific_role);
                $('#status').val(value.status);
                $('#queue_id').val(data.data.id);
                $('.branch-modal').select2().val(value.queue_branch_id).trigger('change');
                initSelect2Remote($('.branch-modal'), "{{ route('branch.search-data') }}", "Choose Branch", 0);
                $('#form-document-modal').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>
@endsection