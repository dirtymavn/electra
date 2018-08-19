<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'service_type', name: 'service_type'},
            { data: 'charge_method', name: 'charge_method'},
            { data: 'action', name: 'action'}
        ];

        var detailDatas = {
            'type': 'fitfolderservice-detail'
        };

        initDatatable($('#fitfolderservice-detail'), "{{route('fitfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-fitfolderservice-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('fitfolder.fitfolderservice-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-fitfolderservice').modal('hide');
                    $('#fitfolderservice-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-fitfolderservice', function(e) {
        $('#form-fitfolderservice-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-fitfolderservice').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-fitfolderservice-accept', function() {
        $('#form-fitfolderservice-detail').submit();
    })

    $(document).on('click', '.deleteDataFitfolderservice', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#fitfolderservice-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataFitfolderservice', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#service_type').val(value.service_type);
                $('#charge_method').val(value.charge_method);
                $("#fitfolderservice_id").val(data.data.id)

                $('#form-fitfolderservice').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    console.log($('#fitfolderservice-detail'))
</script>