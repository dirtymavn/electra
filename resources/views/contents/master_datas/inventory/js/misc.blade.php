<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date'},
            { data: 'start_desc', name: 'start_desc'},
            { data: 'end_desc', name: 'end_desc'},
            { data: 'misc_status', name: 'misc_status', className: 'dt-center'},
            { data: 'description', name: 'description'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'misc-detail'
        };

        initDatatable($('#misc-detail'), "{{route('inventory.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-misc-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('inventory.misc-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-detail').modal('hide');
                    $('#misc-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-detail', function(e) {
        $('#form-misc-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-detail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-detail-accept', function() {
        $('#form-misc-detail').submit();
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#misc-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.detail')}}",
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
                $("#misc_status").val(value.misc_status)
                $("#misc_id").val(data.data.id)

                $('#form-detail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>