<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'city', name: 'city'},
            { data: 'company_code', name: 'company_code'},
            { data: 'vehicle', name: 'vehicle'},
            { data: 'days_hired', name: 'days_hired'},
            { data: 'pickup_date', name: 'pickup_date'},
            { data: 'pickup_location', name: 'pickup_location'},
            { data: 'dropoff_date', name: 'dropoff_date'},
            { data: 'dropoff_location', name: 'dropoff_location'},
            { data: 'rate_type', name: 'rate_type'},
            { data: 'status', name: 'status'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'car-transfer-detail'
        };

        initDatatable($('#car-transfer-detail'), "{{route('inventory.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-car-transfer-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('inventory.car-transfer-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-car-transfer').modal('hide');
                    $('#car-transfer-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-car-transfer', function(e) {
        $('#form-car-transfer-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-car-transfer').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-car-transfer', function() {
        $('#form-car-transfer-detail').submit();
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#car-transfer-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $("#start_date").val(value.start_date)
                $("#end_date").val(value.end_date)
                $("#start_desc").val(value.start_desc)
                $("#end_desc").val(value.end_desc)
                $("#description").val(value.description)
                $("#status").val(value.status)
                $("#misc_id").val(data.data.id)

                $('#form-car-transfer').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>