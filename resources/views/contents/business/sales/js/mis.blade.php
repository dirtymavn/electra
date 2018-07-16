<script>
    var misColumns = [
            { data: 'lowest_fare_rejection', name: 'lowest_fare_rejection'},
            { data: 'destination_id', name: 'destination_id'},
            { data: 'deal_code', name: 'deal_code'},
            { data: 'region_code_id', name: 'region_code_id'},
            { data: 'realised_saving_code', name: 'realised_saving_code'},
            { data: 'iata_no', name: 'iata_no'},
            { data: 'fare_type_id', name: 'fare_type_id'},

            { data: 'action', name: 'action'},
        ];

    $(document).ready(function() {
    
        $('#form-mis-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.mis-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-mis').modal('hide');
                    $('#mis-detail').DataTable().ajax.reload();
                    $('#form-sales-trx').modal('hide');
                    setTimeout(function() {
                        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });
    });

    $(document).on('click', '.btn-add-mis', function(e) {
        $('#form-mis-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-mis').modal({backdrop: 'static', keyboard: false});
        $("#mis_id").val(id)
        e.preventDefault();
    });

    $(document).on('click', '#form-mis-accept', function() {
        $('#form-mis-detail').submit();
    })

    $(document).on('click', '#form-mis-cancel', function() {
        $('#form-mis').modal('hide');
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
                $('#mis-detail').DataTable().ajax.reload();
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

                $('#form-mis').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    function Mis(add = true) {
        if (add) {
            return {
                'type': 'mis-detail',
                'parent_id': $('#mis_id').val()
            };    
        } else {
            return {
                'type': 'mis-detail',
                'parent_id': $('#detail_id').val()
            };
        }
        
    }
</script>