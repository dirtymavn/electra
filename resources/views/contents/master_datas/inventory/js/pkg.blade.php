<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'package_name', name: 'package_name'},
            { data: 'pkg_start_date', name: 'pkg_start_date'},
            { data: 'pkg_end_date', name: 'pkg_end_date'},
            { data: 'pkg_status', name: 'pkg_status', className: 'dt-center'},
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

    $(document).on('click', '.deleteDataPkg', function() {
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

    $(document).on('click', '.editDataPkg', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#package_name').val(value.package_name);
                $('#pkg_start_date').val(value.pkg_start_date);
                $('#pkg_end_date').val(value.pkg_end_date);
                $('#pkg_status').val(value.pkg_status);
                $("#pkg_id").val(data.data.id)

                $('#form-pkg').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>