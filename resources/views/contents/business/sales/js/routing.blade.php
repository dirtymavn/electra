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