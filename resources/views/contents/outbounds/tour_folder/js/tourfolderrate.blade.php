<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'customer_type', name: 'customer_type'},
            { data: 'price_type', name: 'price_type'},
            { data: 'group_size', name: 'group_size'},
            { data: 'price', name: 'price'},
            { data: 'discount', name: 'discount'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'tourfolderrate-detail'
        };

        initDatatable($('#tourfolderrate-detail'), "{{route('tourfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-tourfolderrate-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('tourfolder.tourfolderrate-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-tourfolderrate').modal('hide');
                    $('#tourfolderrate-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-tourfolderrate', function(e) {
        $('#form-tourfolderrate-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-tourfolderrate').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-tourfolderrate-accept', function() {
        $('#form-tourfolderrate-detail').submit();
    })

    $(document).on('click', '.deleteDataTourfolderrate', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#tourfolderrate-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataTourfolderrate', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('tourfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#customer_type').val(value.customer_type);
                $('#price_type').val(value.price_type);
                $('#price').val(value.price);
                $('#discount').val(value.discount);
                $("#tourfolderrate_id").val(data.data.id)

                $('#form-tourfolderrate').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>