<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'lowest_fare_rejection', name: 'lowest_fare_rejection'},
            { data: 'destination_id', name: 'destination_id'},
            { data: 'deal_code', name: 'deal_code'},
            { data: 'region_code', name: 'region_code'},
            { data: 'realised_saving_code', name: 'realised_saving_code'},
            { data: 'iata_no', name: 'iata_no'},
            { data: 'fare_type_id', name: 'fare_type_id'},

            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'mis-detail'
        };

        initDatatable($('#mis-detail'), "{{route('sales.get-detail-data')}}", detailColumns, detailDatas);

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
                    $('#form-mis').modal('hide');
                    $('#mis-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-mis', function(e) {
        $('#form-mis-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-mis').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-detail-accept', function() {
        $('#form-mis-detail').submit();
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


                $('#form-mis').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>