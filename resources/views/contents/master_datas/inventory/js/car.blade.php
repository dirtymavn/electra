<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'from', name: 'from'},
            { data: 'to', name: 'to'},
            { data: 'company', name: 'company'},
            { data: 'class', name: 'class'},
            { data: 'departure', name: 'departure'},
            { data: 'arrival', name: 'arrival'},
            { data: 'car_status', name: 'car_status'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'car-detail'
        };

        initDatatable($('#car-detail'), "{{route('inventory.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-car-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('inventory.car-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-car').modal('hide');
                    $('#car-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-car', function(e) {
        $('#form-car-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-car').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-car-accept', function() {
        $('#form-car-detail').submit();
    })

    $(document).on('click', '.deleteDataCar', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#car-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataCar', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#from').val(value.from);
                $('#to').val(value.to);
                $('#company').val(value.company);
                $('#class').val(value.class);
                $('#departure').val(value.departure);
                $('#arrival').val(value.arrival);
                $('#car_status').val(value.car_status);
                $("#car_id").val(data.data.id)

                $('#form-car').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>