<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'product_code', name: 'product_code'},
            { data: 'product_code_desc', name: 'product_code_desc'},
            { data: 'qty', name: 'qty'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'invoicedetail-detail'
        };

        initDatatable($('#invoicedetail-detail'), "{{route('invoice.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-invoicedetail-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('invoice.invoicedetail-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-invoicedetail').modal('hide');
                    $('#invoicedetail-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-invoicedetail', function(e) {
        $('#form-invoicedetail-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-invoicedetail').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-invoicedetail-accept', function() {
        $('#form-invoicedetail-detail').submit();
    })

    $(document).on('click', '.deleteDataInvoiceDetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('invoice.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#invoicedetail-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataInvoiceDetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('invoice.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#product_code').val(value.product_code);
                $('#product_code_desc').val(value.product_code_desc);
                $('#qty').val(value.qty);
                $("#invoicedetail_id").val(data.data.id)

                $('#form-invoicedetail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>