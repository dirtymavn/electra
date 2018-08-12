<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'service_code', name: 'service_code'},
            { data: 'service_description', name: 'service_description'},
            { data: 'quantity', name: 'quantity'},
            { data: 'quantity_order', name: 'quantity_order'},
            { data: 'order_date', name: 'order_date'},
            { data: 'total_sales', name: 'total_sales'},
            { data: 'action', name: 'action'}
        ];

        var detailDatas = {
            'type': 'hotelbookingservice-detail'
        };

        initDatatable($('#hotelbookingservice-detail'), "{{route('hotel-booking.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotelbookingservice-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('hotel-booking.hotelbookingservice-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotelbookingservice').modal('hide');
                    $('#hotelbookingservice-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotelbookingservice', function(e) {
        $('#form-hotelbookingservice-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotelbookingservice').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-hotelbookingservice-accept', function() {
        $('#form-hotelbookingservice-detail').submit();
    })

    $(document).on('click', '.deletedatahotelbookingservice', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-booking.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotelbookingservice-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editdatahotelbookingservice', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('hotel-booking.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#service_code').val(value.service_code);
                $('#service_description').val(value.service_description);
                $('#quantity').val(value.quantity);
                $('#quantity_order').val(value.quantity_order);
                $('#order_date').val(value.order_date);
                $('#total_sales').val(value.total_sales);
                $("#hotelbookingservice_id").val(data.data.id)

                $('#form-hotelbookingservice').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>