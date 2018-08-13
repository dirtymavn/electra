<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'document_type', name: 'document_type'},
            { data: 'document_uri', name: 'document_uri'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'visadocument-detail'
        };

        initDatatable($('#visadocument-detail'), "{{route('visa.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-visadocument-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('visa.visadocument-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-visadocument').modal('hide');
                    $('#visadocument-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-visadocument', function(e) {
        $('#form-visadocument-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-visadocument').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-visadocument-accept', function() {
        $('#form-visadocument-detail').submit();
    })

    $(document).on('click', '.deletedatavisadocument', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('visa.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#visadocument-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editdatavisadocument', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('visa.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#document_type').val(value.document_type);
                $('#document_uri').val(value.document_uri);
                $("#visadocument_id").val(data.data.id)

                $('#form-visadocument').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>