<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'date', name: 'date', format: 'MM-DD-YYYY'},
            { data: 'available_room_smooking', name: 'available_room_smooking'},
            { data: 'available_room_non_smooking', name: 'available_room_non_smooking'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'hotel-allotmentdetail-detail'
        };

        initDatatable($('#hotel-allotmentdetail-detail'), "{{route('hotel-allotment.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotel-allotmentdetail-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('hotel-allotment.hotel-allotmentdetail-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotel-allotmentdetail').modal('hide');
                    $('#hotel-allotmentdetail-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotel-allotmentdetail', function(e) {
        $('#form-hotel-allotmentdetail-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotel-allotmentdetail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-hotel-allotmentdetail-accept', function() {
        $('#form-hotel-allotmentdetail-detail').submit();
    })

    $(document).on('click', '.deleteDataHotelAllotmentDetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-allotment.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotel-allotmentdetail-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataHotelAllotmentDetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-allotment.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#date').val(value.date);
                $('#available_room_smooking').val(value.available_room_smooking);
                $('#available_room_non_smooking').val(value.available_room_non_smooking);
                $("#hotel_allotmentdetail_id").val(data.data.id)

                $('#form-hotel-allotmentdetail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>