<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'service_name', name: 'service_name'},
            { data: 'service_desciption', name: 'service_desciption'},
            { data: 'cost', name: 'cost'},
            { data: 'sales', name: 'sales'},
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date'},
            { data: 'season', name: 'season'},
            { data: 'is_free', name: 'is_free'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'hotel-service-detail'
        };

        initDatatable($('#hotel-service-detail'), "{{route('master-hotel.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotel-service-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('master-hotel.hotel-service-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotel-service').modal('hide');
                    $('#hotel-service-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotel-service', function(e) {
        $('#form-hotel-service-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotel-service').modal({backdrop: 'static', keyboard: false});
        console.log($('#form-hotel-service'))
        e.preventDefault();
    });

    $(document).on('click', '#form-hotel-service-accept', function() {
        $('#form-hotel-service-detail').submit();
    })

    $(document).on('click', '.deleteDataHotelService', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('master-hotel.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotel-service-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataHotelService', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('master-hotel.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#service_name').val(value.service_name);
                $('#service_desciption').val(value.service_desciption);
                $('#cost').val(value.cost);
                $('#sales').val(value.sales);
                $('#start_date').val(value.start_date);
                $('#end_date').val(value.end_date);
                $('#season').val(value.season);
                $('#is_free').val(value.is_free);
                $("#hotel_contact_id").val(data.data.id)

                $('#form-hotel-service').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>