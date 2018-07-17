<script>
    var passengerColumns = [
            { data: 'passenger_name', name: 'passenger_name'},
            { data: 'ticket_no', name: 'ticket_no'},
            { data: 'conj_ticket_no', name: 'conj_ticket_no'},

            { data: 'action', name: 'action'},
        ];

    $(document).ready(function() {
    
        $('#form-passenger-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.passenger-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-passenger').modal('hide');
                    $('#passenger-detail').DataTable().ajax.reload();
                    $('#form-sales-trx').modal('hide');
                    setTimeout(function() {
                        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });
    });

    $(document).on('click', '.btn-add-passenger', function(e) {
        $('#form-passenger-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-passenger').modal({backdrop: 'static', keyboard: false});
        $("#passenger_id").val(id)
        e.preventDefault();
    });

    $(document).on('click', '#form-passenger-accept', function() {
        $('#form-passenger-detail').submit();
    })

    $(document).on('click', '#form-passenger-cancel', function() {
        $('#form-passenger').modal('hide');
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
                $('#passenger-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataPassenger', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $("#passenger_name").val(value.passenger_name)
                $("#ticket_no").val(value.ticket_no)
                $("#conj_ticket_no").val(value.conj_ticket_no)

                $('#form-passenger').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    function Passenger(add = true) {
        if (add) {
            return {
                'type': 'passenger-detail',
                'parent_id': $('#passenger_id').val()
            };    
        } else {
            return {
                'type': 'passenger-detail',
                'parent_id': $('#detail_id').val()
            };
        }
        
    }
</script>