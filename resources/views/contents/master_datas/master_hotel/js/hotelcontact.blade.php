<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'title', name: 'title'},
            { data: 'name', name: 'name'},
            { data: 'phone', name: 'phone'},
            { data: 'fax', name: 'fax'},
            { data: 'email', name: 'email'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'hotel-contact-detail'
        };

        initDatatable($('#hotel-contact-detail'), "{{route('master-hotel.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-hotel-contact-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('master-hotel.hotel-contact-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-hotel-contact').modal('hide');
                    $('#hotel-contact-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-hotel-contact', function(e) {
        $('#form-hotel-contact-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-hotel-contact').modal({backdrop: 'static', keyboard: false});
        console.log($('#form-hotel-contact'))
        e.preventDefault();
    });

    $(document).on('click', '#form-hotel-contact-accept', function() {
        $('#form-hotel-contact-detail').submit();
    })

    $(document).on('click', '.deleteDataHotelContact', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('master-hotel.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#hotel-contact-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataHotelContact', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('master-hotel.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#title').val(value.title);
                $('#name').val(value.name);
                $('#phone').val(value.phone);
                $('#fax').val(value.fax);
                $('#email').val(value.email);
                $("#hotel_contact_id").val(data.data.id)

                $('#form-hotel-contact').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>