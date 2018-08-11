<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'day', name: 'day'},
            { data: 'itinerary_code', name: 'itinerary_code'},
            { data: 'description', name: 'description'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'tourfolderitinerary-detail'
        };

        initDatatable($('#tourfolderitinerary-detail'), "{{route('tourfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-tourfolderitinerary-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('tourfolder.tourfolderitinerary-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-tourfolderitinerary').modal('hide');
                    $('#tourfolderitinerary-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-tourfolderitinerary', function(e) {
        $('#form-tourfolderitinerary-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-tourfolderitinerary').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-tourfolderitinerary-accept', function() {
        $('#form-tourfolderitinerary-detail').submit();
    })

    $(document).on('click', '.deleteDataTourfolderitinerary', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#tourfolderitinerary-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataTourfolderitinerary', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#day').val(value.day);
                $('#itinerary_code').val(value.itinerary_code);
                $('#description').val(value.description);
                $("#tourfolderitinerary_id").val(data.data.id)

                $('#form-tourfolderitinerary').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>