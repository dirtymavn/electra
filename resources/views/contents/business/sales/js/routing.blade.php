<script>
    var routingColumns = [
        { data: 'city_from_id', name: 'city_from_id'},
        { data: 'city_to_id', name: 'city_to_id'},
        { data: 'airline_id', name: 'airline_id'},
        { data: 'passenger_class_id', name: 'passenger_class_id'},
        { data: 'depart_date', name: 'depart_date'},
        { data: 'arrival_date', name: 'arrival_date'},
        { data: 'stopover_count', name: 'stopover_count'},
        { data: 'flight_status', name: 'flight_status'},

        { data: 'action', name: 'action'},
        ];

    $(document).ready(function() {
    
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
                    $('div.spinner').hide();
                    $('#form-routing').modal('hide');
                    $('#routing-detail').DataTable().ajax.reload();
                    $('#form-sales-trx').modal('hide');
                    setTimeout(function() {
                        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });
    });

    $(document).on('click', '.btn-add-routing', function(e) {
        $('#form-routing-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-routing').modal({backdrop: 'static', keyboard: false});
        $("#routing_id").val(id)
        e.preventDefault();
    });

    $(document).on('click', '#form-routing-accept', function() {
        $('#form-routing-detail').submit();
    })

    $(document).on('click', '#form-routing-cancel', function() {
        $('#form-routing').modal('hide');
        $('#form-sales-trx').modal('hide');
        setTimeout(function() {
            $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
        }, 500)
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

    $(document).on('click', '.editDataRouting', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $("#routing_id").val(data.data.id)
                $("#city_from_id").val(value.city_from_id)
                $("#city_to_id").val(value.city_to_id)
                $("#airline_id").val(value.airline_id)
                $("#passenger_class_id").val(value.passenger_class_id)
                $("#depart_date").val(value.depart_date)
                $("#arrival_date").val(value.arrival_date)
                $("#stopover_count").val(value.stopover_count)
                $("#airline_pnr").val(value.airline_pnr)
                $("#fly_hr").val(value.fly_hr)
                $("#meal_srv").val(value.meal_srv)
                $("#ssr").val(value.ssr)
                $("#sector_pair").val(value.sector_pair)
                $("#path_code").val(value.path_code)
                $("#land_sector_desc").val(value.land_sector_desc)
                $("#operating_carrier_id").val(value.operating_carrier_id)
                $("#flight_no").val(value.flight_no)
                $("#flight_status").val(value.flight_status)
                $("#equip").val(value.equip)
                $("#seat_no").val(value.seat_no)
                $("#terminal").val(value.terminal)
                $("#mileage").val(value.mileage)
                $("#land_sector_flag").val(value.land_sector_flag)
                $("#stopover").val(value.stopover)
                $("#nuc").val(value.nuc)
                $("#roe").val(value.roe)

                $('#form-routing').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    function Routing(add = true) {
        if (add) {
            return {
                'type': 'routing-detail',
                'parent_id': $('#routing_id').val()
            };    
        } else {
            return {
                'type': 'routing-detail',
                'parent_id': $('#detail_id').val()
            };
        }
        
    }
</script>