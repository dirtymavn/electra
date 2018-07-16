<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'route_from', name: 'route_from'},
            { data: 'route_to', name: 'route_to'},
            { data: 'airline_code', name: 'airline_code'},
            { data: 'flight_no', name: 'flight_no'},
            { data: 'class', name: 'class'},
            { data: 'farebasis', name: 'farebasis'},
            { data: 'depart_date', name: 'depart_date'},
            { data: 'arrival', name: 'arrival'},
            { data: 'departure', name: 'departure'},
            { data: 'air_status', name: 'air_status'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'route-air-detail'
        };

        initDatatable($('#air-detail'), "{{route('inventory.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-air-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('inventory.air-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-air').modal('hide');
                    $('#air-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-air', function(e) {
        $('#form-air-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-air').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-air-accept', function() {
        $('#form-air-detail').submit();
    })

    $(document).on('click', '.deleteDataAir', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#air-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataAir', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#route_from').val(value.route_from);
                $('#route_to').val(value.route_to);
                $('#airline_code').val(value.airline_code);
                $('#flight_no').val(value.flight_no);
                $('#class').val(value.class);
                $('#farebasis').val(value.farebasis);
                $('#depart_date').val(value.depart_date);
                $('#arrival').val(value.arrival);
                $('#departure').val(value.departure);
                $('#air_status').val(value.air_status);
                $('#equip').val(value.equip);
                $('#stopover_city').val(value.stopover_city);
                $('#stopover_qty').val(value.stopover_qty);
                $('#seat_no').val(value.seat_no);
                $('#airlane_pnr').val(value.airlane_pnr);
                $('#fly_duration').val(value.fly_duration);
                $('#meal_srv').val(value.meal_srv);
                $('#terminal').val(value.terminal);
                $('#ssr').val(value.ssr);
                $('#sector_pair').val(value.sector_pair);
                $('#miliage').val(value.miliage);
                $('#path_code').val(value.path_code);
                $('#land_sector_flag').val(value.land_sector_flag);
                $('#land_sector_desc').val(value.land_sector_desc);

                $("#route_air_id").val(data.data.id)

                $('#form-air').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>