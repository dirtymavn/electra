<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'day', name: 'day'},
            { data: 'itinerary_code', name: 'itinerary_code'},
            { data: 'description', name: 'description'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'fitfolderitinerary-detail'
        };

        initDatatable($('#fitfolderitinerary-detail'), "{{route('fitfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-fitfolderitinerary-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('fitfolder.fitfolderitinerary-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-fitfolderitinerary').modal('hide');
                    $('#fitfolderitinerary-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-fitfolderitinerary', function(e) {
        $('#form-fitfolderitinerary-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-fitfolderitinerary').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-fitfolderitinerary-accept', function() {
        $('#form-fitfolderitinerary-detail').submit();
    })

    $(document).on('click', '.deleteDataFitfolderitinerary', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#fitfolderitinerary-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataFitfolderitinerary', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#day').val(value.day);
                $('#itinerary_code').val(value.itinerary_code);
                $('#description').val(value.description);
                $("#fitfolderitinerary_id").val(data.data.id)

                $('#form-fitfolderitinerary').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>