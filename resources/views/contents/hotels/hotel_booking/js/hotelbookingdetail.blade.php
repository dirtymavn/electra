<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'id_room_type', name: 'id_room_type'},
            { data: 'id_room_category', name: 'id_room_category'},
            { data: 'room_number', name: 'room_number'},
            { data: 'night', name: 'night'},
            { data: 'price_per_night', name: 'price_per_night'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'hotelbookingdetail-detail'
        };

        initDatatable($('#hotelbookingdetail-detail'), "{{route('hotel-booking.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotelbookingdetail-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('hotel-booking.hotelbookingdetail-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotelbookingdetail').modal('hide');
                    $('#hotelbookingdetail-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotelbookingdetail', function(e) {
        $('#form-hotelbookingdetail-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotelbookingdetail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-hotelbookingdetail-accept', function() {
        $('#form-hotelbookingdetail-detail').submit();
    })

    $(document).on('click', '.deletedatahotelbookingdetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-booking.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotelbookingdetail-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editdatahotelbookingdetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-booking.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#id_room_type').val(value.id_room_type);
                $('#id_room_category').val(value.id_room_category);
                $('#room_number').val(value.room_number);
                $('#night').val(value.night);
                $('#price_per_night').val(value.price_per_night);
                $("#hotelbookingdetail_id").val(data.data.id)

                $('#form-hotelbookingdetail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>