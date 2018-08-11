<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'from_date', name: 'from_date'},
            { data: 'to_date', name: 'to_date'},
            { data: 'guide_number', name: 'guide_number'},
            { data: 'title', name: 'title'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'tourfolderguide-detail'
        };

        initDatatable($('#tourfolderguide-detail'), "{{route('tourfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-tourfolderguide-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('tourfolder.tourfolderguide-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-tourfolderguide').modal('hide');
                    $('#tourfolderguide-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-tourfolderguide', function(e) {
        $('#form-tourfolderguide-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-tourfolderguide').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-tourfolderguide-accept', function() {
        $('#form-tourfolderguide-detail').submit();
    })

    $(document).on('click', '.deleteDataTourfolderguide', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#tourfolderguide-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataTourfolderguide', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#from_date').val(value.from_date);
                $('#to_date').val(value.to_date);
                $('#guide_number').val(value.guide_number);
                $('#title').val(value.title);
                $("#tourfolderguide_id").val(data.data.id)

                $('#form-tourfolderguide').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>