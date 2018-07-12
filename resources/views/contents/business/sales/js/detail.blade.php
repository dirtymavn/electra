<script>
    var id;
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
            $('div.spinner').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.sales-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-sales-trx').modal('hide');
                    $('#sales-detail').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('div.spinner').hide();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-sales', function(e) {
        $('#form-sales-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
        var makeId = makeid();
        id = makeId
        $("#sales_id").val(makeId)
        $("#routing_id").val(makeId)

        initDatatable($('#routing-detail'), "{{route('sales.get-detail-data')}}", routingColumns, Routing());
        e.preventDefault();
    });

    $(document).on('click', '#form-sales-trx-accept', function() {
        $('#form-sales-detail').submit();
    })

    $(document).on('click', '.deleteDataSales', function() {
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

    $(document).on('click', '.editDataSales', function() {
        var id = $(this).data('id');
        var element = $(this).data('element');
        editTempData(element, id); 
        $('#routing_method').val('edit');
    });

     function editTempData(element, id) {
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                if (element == 'sales-detail') {
                    $("#sales_id").val(data.data.id)
                    $("#product_code").val(value.product_code)
                    $("#passenger_class_code").val(value.passenger_class_code)
                    $("#pnr_no").val(value.pnr_no)
                    $("#dk_no").val(value.dk_no)
                    $("#airline_form").val(value.airline_form)
                    $("#sales_type").val(value.sales_type)
                    $("#confirm_date").val(value.confirm_date)
                    $("#mpd_no").val(value.mpd_no)
                    $("#sales_detail_remark").val(value.sales_detail_remark)
                    
                    initDatatable($('#routing-detail'), "{{route('sales.get-detail-data')}}", routingColumns, Routing(false));
                    $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                }
            }
        })
    }

    function makeid() {
        var text = "";
        var possible = "0123456789";

        for (var i = 0; i < 4; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }
</script>