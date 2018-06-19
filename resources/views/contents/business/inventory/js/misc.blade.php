<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date'},
            { data: 'start_desc', name: 'start_desc'},
            { data: 'end_desc', name: 'end_desc'},
            { data: 'status', name: 'status', className: 'dt-center'},
            { data: 'description', name: 'description'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'itinerary-detail'
        };

        initDatatable($('#itinerary-detail'), "{{route('itin.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-itinerary-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-detail').modal('hide');
                    $('#itinerary-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-detail', function(e) {
        $('#form-itinerary-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-detail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-detail-accept', function() {
        $('#form-itinerary-detail').submit();
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('itin.itinerary-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#itinerary-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('itin.itinerary-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#day').val(value.day);
                $('#as_remark_flag').val(value.as_remark_flag);
                $('#remark_seq').val(value.remark_seq);
                $('#city').val(value.city);
                $('#itinerary_item_code').val(value.itinerary_item_code);
                $('#brief_description').val(value.brief_description);
                $('#breakfast').val(value.breakfast);
                $('#lunch').val(value.lunch);
                $('#dinner').val(value.dinner);
                $('#accomodations').val(value.accomodations);
                $('#remark').val(value.remark);
                $('#transport_detail').val(value.transport_detail);
                $('#itinerary_detail_id').val(data.data.id);
                $('#form-detail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>