<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'day', name: 'day'},
            // { data: 'as_remark_flag', name: 'as_remark_flag', className: 'dt-center'},
            // { data: 'remark_seq', name: 'remark_seq'},
            { data: 'city', name: 'city'},
            { data: 'itinerary_item_code', name: 'itinerary_item_code'},
            { data: 'brief_description', name: 'brief_description'},
            { data: 'breakfast', name: 'breakfast'},
            { data: 'lunch', name: 'lunch'},
            { data: 'dinner', name: 'dinner'},
            { data: 'accomodations', name: 'accomodations'},
            { data: 'remark', name: 'remark'},
            { data: 'transport_detail', name: 'transport_detail'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'itinerary-detail'
        };

        initDatatable($('#itinerary-detail'), "{{route('itin.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-itinerary-detail').submit(function(e) {
            e.preventDefault();
            $('div.spinner').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-detail').modal('hide');
                    $('#itinerary-detail').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('div.spinner').hide();
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
                $('#city').select2().val(value.city).trigger('change');
                initSelect2Remote($('#city'), "{{ route('city.search-data-normal') }}", "Choose City", 0, true);
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