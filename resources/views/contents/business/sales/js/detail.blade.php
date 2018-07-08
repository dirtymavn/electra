<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'product_code', name: 'product_code'},
            { data: 'passenger_class_code', name: 'passenger_class_code'},
            { data: 'is_group_flag', name: 'is_group_flag'},
            { data: 'is_supperss_flag', name: 'is_supperss_flag'},
            { data: 'is_pax_sup', name: 'is_pax_sup'},
            { data: 'is_group_item', name: 'is_group_item'},
            { data: 'pnr_no', name: 'pnr_no'},
            { data: 'dk_no', name: 'dk_no'},
            { data: 'airline_form', name: 'airline_form'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'sales-detail'
        };

        initDatatable($('#sales-detail'), "{{route('sales.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-sales-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.sales-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-sales-trx').modal('hide');
                    $('#sales-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-sales', function(e) {
        $('#form-sales-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-sales-trx-accept', function() {
        $('#form-sales-detail').submit();
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#sales-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                

                $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>