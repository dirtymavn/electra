<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'title', name: 'title'},
            { data: 'pax_name', name: 'pax_name'},
            { data: 'type', name: 'type'},
            { data: 'action', name: 'action'}
        ];

        var detailDatas = {
            'type': 'hotelbookingpax-detail'
        };

        initDatatable($('#hotelbookingpax-detail'), "{{route('hotel-booking.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotelbookingpax-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('hotel-booking.hotelbookingpax-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotelbookingpax').modal('hide');
                    $('#hotelbookingpax-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotelbookingpax', function(e) {
        $('#form-hotelbookingpax-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotelbookingpax').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-hotelbookingpax-accept', function() {
        $('#form-hotelbookingpax-detail').submit();
    })

    $(document).on('click', '.deletedatahotelbookingpax', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-booking.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotelbookingpax-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editdatahotelbookingpax', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-booking.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#title').val(value.title);
                $('#pax_name').val(value.pax_name);
                $('#type').val(value.type);
                $("#hotelbookingpax_id").val(data.data.id)

                $('#form-hotelbookingpax').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>