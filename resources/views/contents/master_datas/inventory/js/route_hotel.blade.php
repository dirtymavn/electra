<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'city', name: 'city'},
            { data: 'hotel_name', name: 'hotel_name'},
            { data: 'hotel_chain', name: 'hotel_chain'},
            { data: 'phone', name: 'phone'},
            { data: 'fax', name: 'fax'},
            { data: 'checkin_date', name: 'checkin_date'},
            { data: 'checkout_date', name: 'checkout_date'},
            { data: 'ref_code', name: 'ref_code'},
            { data: 'status', name: 'status'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'route-hotel-detail'
        };

        initDatatable($('#hotel-detail'), "{{route('inventory.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotel-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('inventory.hotel-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotel').modal('hide');
                    $('#hotel-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotel', function(e) {
        $('#form-hotel-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotel').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-hotel-accept', function() {
        $('#form-hotel-detail').submit();
    })

    $(document).on('click', '.deleteDataHotel', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotel-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataHotel', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('inventory.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#city').val(value.city);
                $('#hotel_name').val(value.hotel_name);
                $('#hotel_chain').val(value.hotel_chain);
                $('#phone').val(value.phone);
                $('#fax').val(value.fax);
                $('#checkin_date').val(value.checkin_date);
                $('#checkout_date').val(value.checkout_date);
                $('#status').val(value.status);
                $('#rm_type').val(value.rm_type);
                $('#rm_cat').val(value.rm_cat);
                $('#guest_prm').val(value.guest_prm);
                $('#meals').val(value.meals);
                $('#other_svc').val(value.other_svc);
                $('#ref_code').val(value.ref_code);
                $('#confirmation_code').val(value.confirmation_code);
                $('#address').val(value.address);
                $('#remark').val(value.remark);

                $("#route_hotel_id").val(data.data.id)

                $('#form-hotel').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>