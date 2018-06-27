<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'supplier_no', name: 'supplier_no'},
            { data: 'product_code', name: 'product_code'},
            { data: 'charge_method', name: 'charge_method'},
            { data: 'ref_no', name: 'ref_no'},
            { data: 'service_remark', name: 'service_remark'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datasFixed = {
            'type': 'itinerary-service-fixed'
        };

        var datasVariable = {
            'type': 'itinerary-service-variable'
        };

        initDatatable($('#itinerary-service-fixed'), "{{route('itin.get-detail-data')}}", detailColumns, datasFixed);
        initDatatable($('#itinerary-service-variable'), "{{route('itin.get-detail-data')}}", detailColumns, datasVariable);

        $('#form-itinerary-service').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-service').modal('hide');
                    $('.itinerary-service').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-service', function(e) {
        $('#form-itinerary-service').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteDataService', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('itin.itinerary-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('.itinerary-service').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataService', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('itin.itinerary-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#charge_method').val(value.charge_method);
                $('#currency').val(value.currency);
                $('#end_date').val(value.end_date);
                $('#end_description').val(value.end_description);
                $('#foc_discount_type').val(value.foc_discount_type);
                $('#foc_foc').val(value.foc_foc);
                $('#foc_pax_no').val(value.foc_pax_no);
                $('#interval_discount_amount').val(value.interval_discount_amount);
                $('#interval_discount_percent').val(value.interval_discount_percent);
                $('#interval_net_cost').val(value.interval_net_cost);
                $('#interval_pax_from').val(value.interval_pax_from);
                $('#interval_pax_to').val(value.interval_pax_to);
                $('#interval_unit_cost').val(value.interval_unit_cost);
                $('#product_code').val(value.product_code);
                $('#ptc_discount_amount').val(value.ptc_discount_amount);
                $('#ptc_discount_percent').val(value.ptc_discount_percent);
                $('#ptc_net_cost').val(value.ptc_net_cost);
                $('#ptc_pax_from').val(value.ptc_pax_from);
                $('#ptc_pax_ptc').val(value.ptc_pax_ptc);
                $('#ptc_pax_to').val(value.ptc_pax_to);
                $('#ptc_unit_cost').val(value.ptc_unit_cost);
                $('#ref_no').val(value.ref_no);
                $('#service_remark').val(value.service_remark);
                $('#route_description').val(value.route_description);
                $('#service_type').val(value.service_type);
                $('#start_date').val(value.start_date);
                $('#start_description').val(value.start_description);
                $('#status').val(value.status);
                $('#supplier_no').val(value.supplier_no);
                $('#tax_currency').val(value.tax_currency);
                $('#tax_free_foc_flag').val(value.tax_free_foc_flag);
                $('#tax_type').val(value.tax_type);
                $('#itinerary_service_id').val(data.data.id);
                $('#form-service').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>