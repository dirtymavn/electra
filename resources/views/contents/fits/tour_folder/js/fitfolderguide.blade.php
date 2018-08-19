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
            'type': 'fitfolderguide-detail'
        };

        initDatatable($('#fitfolderguide-detail'), "{{route('fitfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-fitfolderguide-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('fitfolder.fitfolderguide-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-fitfolderguide').modal('hide');
                    $('#fitfolderguide-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-fitfolderguide', function(e) {
        $('#form-fitfolderguide-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-fitfolderguide').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-fitfolderguide-accept', function() {
        $('#form-fitfolderguide-detail').submit();
    })

    $(document).on('click', '.deleteDataFitfolderguide', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#fitfolderguide-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataFitfolderguide', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#from_date').val(value.from_date);
                $('#to_date').val(value.to_date);
                $('#guide_number').val(value.guide_number);
                $('#title').val(value.title);
                $("#fitfolderguide_id").val(data.data.id)

                $('#form-fitfolderguide').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>