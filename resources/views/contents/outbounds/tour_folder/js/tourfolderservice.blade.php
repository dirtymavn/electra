<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'service_type', name: 'service_type'},
            { data: 'charge_method', name: 'charge_method'},
            { data: 'action', name: 'action'}
        ];

        var detailDatas = {
            'type': 'tourfolderservice-detail'
        };

        initDatatable($('#tourfolderservice-detail'), "{{route('tourfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-tourfolderservice-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('tourfolder.tourfolderservice-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-tourfolderservice').modal('hide');
                    $('#tourfolderservice-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-tourfolderservice', function(e) {
        $('#form-tourfolderservice-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-tourfolderservice').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-tourfolderservice-accept', function() {
        $('#form-tourfolderservice-detail').submit();
    })

    $(document).on('click', '.deleteDataTourfolderservice', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#tourfolderservice-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataTourfolderservice', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#service_type').val(value.service_type);
                $('#charge_method').val(value.charge_method);
                $("#tourfolderservice_id").val(data.data.id)

                $('#form-tourfolderservice').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    console.log($('#tourfolderservice-detail'))
</script>