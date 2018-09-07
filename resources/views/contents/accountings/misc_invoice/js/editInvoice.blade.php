<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'checklist',className:'checklist', name: 'checklist',orderable:false,searchable:false},
            { data: 'product_code', name: 'product_code'},
            { data: 'description', name: 'description'},
            { data: 'qty', name: 'qty'},
            { data: 'unit_price', name: 'unit_price'},
            { data: 'total_sales', name: 'total_sales'},
            { data: 'gst', name: 'gst'},
            { data: 'action', name: 'action',className:'row-actions'},
        ];

        var detailDatas = {
            'type': 'misc-invoice-detail',
            'invoice_id':"{{$invoice->id}}"
        };

        initDatatable($('#invoicedetail-detail'), "{{route('accounting.misc-invoice.detail-invoice')}}", detailColumns, detailDatas);

        $('#form-invoicedetail-detail').submit(function(e) {
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
            url: "{{route('accounting.misc-invoice.detail-invoices-delete')}}",
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
            url: "{{route('accounting.misc-invoice.detail-invoices-bulk-delete')}}",
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

    $(document).on('click', '#bulk-delete', function() {
        var lengthChecked = $('td .checklist:checked').length;
        var ids = [];
        if (lengthChecked <= 0) {
            alert('Please checklist one or more data');
            return false;
        }
        
        $('td .checklist').each(function(i, obj) {
            if ($('td .checklist').eq(i).is(':checked')) {
                var id = $('td.row-actions').eq(i).find('.deleteDataInvoiceDetail').attr('data-id');
                ids.push(id);
            }
        });

        if (ids.length > 0) {
            $.ajax({
                url: "{{route('accounting.misc-invoice.detail-invoices-bulk-delete')}}",
                method: "POST",
                dataType: "JSON",
                data: {'ids':ids,'is_temp':false},
                success: function(data) {
                    console.log(data);
                    $('#invoicedetail-detail').DataTable().ajax.reload();
                }
            })
            return false;
        } else {
            alert('Something went wrong!');
            return false;
        }
    });

    $(document).on('click', 'th .checklist', function() {
        if ($(this).is(':checked')) {
            $('td .checklist').prop('checked', true);
        } else {
            $('td .checklist').prop('checked', false);
        }
    });

    $(document).on('click', 'td .checklist', function() {
        var lengthChecked = $('td .checklist:checked').length;
        var lengthCeckbox = $('td .checklist').length;

        if (lengthChecked == lengthCeckbox) {
            $('th .checklist').prop('checked', true);
        } else {
            $('th .checklist').prop('checked', false);
        }
    });
</script>