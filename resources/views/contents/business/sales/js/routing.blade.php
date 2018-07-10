<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'city_from', name: 'city_from'},
            { data: 'city_to', name: 'city_to'},
            { data: 'airline_id', name: 'airline_id'},
            { data: 'passenger_class_id', name: 'passenger_class_id'},
            { data: 'depart_date', name: 'depart_date'},
            { data: 'arrival_date', name: 'arrival_date'},
            { data: 'stopover_count', name: 'stopover_count'},
            { data: 'flight_status', name: 'flight_status'},
            
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'routing-detail'
        };

        initDatatable($('#routing-detail'), "{{route('sales.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-routing-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.routing-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-routing').modal('hide');
                    $('#routing-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-routing', function(e) {
        $('#form-routing-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-routing').modal({backdrop: 'static', keyboard: false});
        $('#form-routing').css("z-index", "99999");

        e.preventDefault();
    });

    $(document).on('click', '#form-detail-accept', function() {
        $('#form-routing-detail').submit();
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#routing-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
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

                $('#form-routing').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>