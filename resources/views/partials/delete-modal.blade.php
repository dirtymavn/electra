<div id="delete-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! trans('Confirmation') !!}</h4>
            </div>
            <div class="modal-body">
                <p id="text-body-confirm">{!! trans('label.delete_confirmation') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['id' => 'destroy', 'method' => 'delete']) !!}
                    <a id="delete-modal-cancel" href="#" class="btn btn-default pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> {!! trans('label.cancel') !!}
                    </a>
                    <button class="btn btn-success" id="submit" type="submit">
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
            $("#text-body-confirm").text("{{ trans('label.delete_confirmation') }}");
            $('#submit').attr('value','Delete');
            e.preventDefault();
        });
    });
    $('#submit').click(function () {
        modal_loader();
    });
</script>
@endsection
