<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'ticket_no', name: 'ticket_no'},
            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'invoicerefund-detail'
        };

        initDatatable($('#invoicerefund-detail'), "{{route('invoice.get-detail-data')}}", detailColumns, detailDatas);

        $('#form-invoicerefund-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('invoice.invoicerefund-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-invoicerefund').modal('hide');
                    $('#invoicerefund-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-invoicerefund', function(e) {
        $('#form-invoicerefund-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-invoicerefund').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '#form-invoicerefund-accept', function() {
        $('#form-invoicerefund-detail').submit();
    })

    $(document).on('click', '.deleteDataInvoiceRefund', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('invoice.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#invoicerefund-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataInvoiceRefund', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('invoice.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#ticket_no').val(value.ticket_no);
                $("#invoicerefund_id").val(data.data.id)

                $('#form-invoicerefund').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>