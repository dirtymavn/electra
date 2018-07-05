<div id="delete-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('Confirmation') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="text-body-confirm">{!! trans('Are you sure want to delete this data ?') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'destroy', 'method' => 'delete']) !!}
                    <a id="delete-modal-cancel" href="#" class="btn btn-white pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> {!! trans('Cancel') !!}
                    </a>
                    <button class="btn btn-success" id="submit" type="submit">
                        <i class="fa fa-check m-right-10"></i> Continue
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="reset-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('Confirmation') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="text-body-confirm-reset">{!! trans('Are you sure want to reset password this data ?') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'reset-password', 'method' => 'patch']) !!}
                    <a id="delete-modal-cancel" href="#" class="btn btn-white pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> {!! trans('Cancel') !!}
                    </a>
                    <button class="btn btn-success" id="submit-reset" type="submit">
                        <i class="fa fa-check m-right-10"></i> Continue
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="approve-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('Confirmation') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="text-body-confirm-approve">{!! trans('Are you sure want to approve this transaction ?') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'approve-transaction', 'method' => 'patch']) !!}
                    <a id="approve-modal-cancel" href="#" class="btn btn-white pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> {!! trans('Cancel') !!}
                    </a>
                    <button class="btn btn-success" id="submit-approve" type="submit">
                        <i class="fa fa-check m-right-10"></i> Continue
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="reject-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('Confirmation') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="text-body-confirm-reject">{!! trans('Are you sure want to reject this transaction ?') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'reject-transaction', 'method' => 'patch']) !!}
                    <a id="reject-modal-cancel" href="#" class="btn btn-white pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> {!! trans('Cancel') !!}
                    </a>
                    <button class="btn btn-danger" id="submit-reject" type="submit">
                        <i class="fa fa-check m-right-10"></i> Continue
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div id="bulk-delete-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('Confirmation') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="text-body-confirm">{!! trans('Are you sure want to delete ?') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'form-bulk-delete', 'method' => 'post']) !!}
                    <input type="hidden" name="ids" id="bulk-delete-id">
                    <a id="bulk-delete-modal-cancel" href="#" class="btn btn-white pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> {!! trans('Cancel') !!}
                    </a>
                    
                    <button class="btn btn-success" id="submit-bulk-delete" type="submit">
                        <i class="fa fa-check m-right-10"></i> Continue
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@section('part_script')
<script>
    $(document).ready(function() {
        $(document).on('click', '#deleteData', function(e) {
            $('#submit').attr('disabld', true);
            var url = $(this).attr('data-href');
            $('#destroy').attr('action', url );
            $('#import').attr( 'method', 'delete' );
            $('#delete-modal').modal('show');
            $("#text-body-confirm").text("{{ trans('Are you sure want to delete this data ?') }}");
            $('#submit').attr('value','Delete');
            e.preventDefault();
        });

        $(document).on('click', '#resetData', function(e) {
            $('#submit-reset').attr('disabld', true);
            var url = $(this).attr('data-href');
            $('#reset-password').attr('action', url );
            $('#import').attr( 'method', 'reset' );
            $('#reset-modal').modal('show');
            $("#text-body-confirm-reset").text("{{ trans('Are you sure want to reset password for this data ?') }}");
            $('#submit-reset').attr('value','Reset');
            e.preventDefault();
        });

        $(document).on('click', '#approveData', function(e) {
            $('#submit-approve').attr('disabld', true);
            var url = $(this).attr('data-href');
            $('#approve-transaction').attr('action', url );
            $('#approve-modal').modal('show');
            $("#text-body-confirm-approve").text("{{ trans('Are you sure want to approve this transaction ?') }}");
            $('#submit-approve').html('<i class="fa fa-check m-right-10"></i> Approve');
            e.preventDefault();
        });

        $(document).on('click', '#rejectData', function(e) {
            $('#submit-reject').attr('disabld', true);
            var url = $(this).attr('data-href');
            $('#reject-transaction').attr('action', url );
            $('#reject-modal').modal('show');
            $("#text-body-confirm-reject").text("{{ trans('Are you sure want to reject this transaction ?') }}");
            $('#submit-reject').html('<i class="fa fa-check m-right-10"></i> Reject');
            e.preventDefault();
        });

        spinnerLoad($('#destroy, #reset-password, #approve-transaction, #reject-transaction, #form-bulk-delete'));
    });
    $('#submit, #submit-to').click(function () {
        modal_loader();
    });
</script>
@endsection
