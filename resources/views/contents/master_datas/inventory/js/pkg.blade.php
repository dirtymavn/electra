<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'package_name', name: 'package_name'},
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date'},
            { data: 'status', name: 'status', className: 'dt-center'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'pkg-detail'
        };

        initDatatable($('#pkg-detail'), "{{route('inventory.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-pkg-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('inventory.pkg-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-pkg').modal('hide');
                    $('#pkg-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-pkg', function(e) {
        $('#form-pkg-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-pkg').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-pkg-accept', function() {
        $('#form-pkg-detail').submit();
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#pkg-detail').DataTable().ajax.reload();
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
                $("#status").val(value.status)
                $("#pkg_id").val(data.data.id)

                $('#form-pkg').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>