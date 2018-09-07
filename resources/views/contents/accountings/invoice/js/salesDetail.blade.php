<script>
    function detailSales(evt){
        var id = evt;
        console.log(id);
        $.ajax({
            url: "{{route('accounting.invoice.sales_detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'sales_id':id},
            success: function(data) {
                var value = data.data;
                $('#tc_id').val(value.tc_id);
                $('#customer_name').val(value.customer.customer_name);
                dtSales(id);
            }
        })
    }

    function dtSales(id) {
        var detailColumns = [
            { data: 'product_code', name: 'product_code'},
            { data: 'product_code_desc', name: 'product_code_desc'},
            { data: 'qty', name: 'qty'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'trx_sales_id': id
        };

        initDatatable($('#invoicedetail-detail'), "{{route('accounting.invoice.sales-folder-detail')}}", detailColumns, detailDatas);
    }

    $(document).on('click', '.deleteDataInvoiceDetail', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('accounting.invoice.sales-folder-delete')}}",
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
            url: "{{route('accounting.invoice.sales-folder-show')}}",
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
