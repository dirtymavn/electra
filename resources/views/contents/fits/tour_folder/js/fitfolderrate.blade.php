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
            'type': 'fitfolderrate-detail'
        };

        initDatatable($('#fitfolderrate-detail'), "{{route('fitfolder.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-fitfolderrate-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('fitfolder.fitfolderrate-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-fitfolderrate').modal('hide');
                    $('#fitfolderrate-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-fitfolderrate', function(e) {
        $('#form-fitfolderrate-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-fitfolderrate').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-fitfolderrate-accept', function() {
        $('#form-fitfolderrate-detail').submit();
    })

    $(document).on('click', '.deleteDataFitfolderrate', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#fitfolderrate-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataFitfolderrate', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('fitfolder.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#customer_type').val(value.customer_type);
                $('#price_type').val(value.price_type);
                $('#price').val(value.price);
                $('#discount').val(value.discount);
                $("#fitfolderrate_id").val(data.data.id)

                $('#form-fitfolderrate').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>