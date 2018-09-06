<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'product_code', name: 'product_code'},
            { data: 'description', name: 'description'},
            { data: 'qty', name: 'qty'},
            { data: 'unit_price', name: 'unit_price'},
            { data: 'total_sales', name: 'total_sales'},
            { data: 'gst', name: 'gst'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'misc-invoice-detail'
        };

        initDatatable($('#invoicedetail-detail'), "{{route('accounting.misc-invoice.detail-invoice')}}", detailColumns, detailDatas);

        $('#form-invoicedetail-detail').submit(function(e) {
            console.log('Submit');
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('accounting.misc-invoice.detail-invoice-store')}}",
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
            url: "{{route('accounting.misc-invoice.detail-invoice-delete')}}",
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
            url: "{{route('accounting.misc-invoice.detail-invoice-show')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#product_code').val(value.product_code);
                $('#description').val(value.description);
                $('#qty').val(value.qty);
                $("#invoicedetail_id").val(data.data.id)
                $("#unit_price").val(data.data.unit_price)
                $("#total_sales").val(data.data.total_sales)

                $('#form-invoicedetail').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>