<script>
    $(document).ready(function() {
        var columns = [
            { data: 'optional_product_description', name: 'optional_product_description'},
            { data: 'optional_supplier_no', name: 'optional_supplier_no'},
            { data: 'optional_product_code', name: 'optional_product_code'},
            { data: 'optional_reference_no', name: 'optional_reference_no'},
            { data: 'optional_currency', name: 'optional_currency'},
            { data: 'optional_cost', name: 'optional_cost'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datas = {
            'type': 'itinerary-optional'
        };

        initDatatable($('#itinerary-optional'), "{{route('itin.get-detail-data')}}", columns, datas);

        $('#form-itinerary-optional').submit(function(e) {
            e.preventDefault();
            $('div.spinner').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-optional.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-optional').modal('hide');
                    $('#itinerary-optional').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('div.spinner').hide();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-optional', function(e) {
        $('#form-itinerary-optional').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-optional').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteDataOptional', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('itin.itinerary-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#itinerary-optional').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataOptional', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('itin.itinerary-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $('#optional_product_description').val(value.optional_product_description);
                $('#optional_supplier_no').select2().val(value.optional_supplier_no).trigger('change');
                initSelect2Remote($('#optional_supplier_no'), "{{ route('supplier.search-data') }}", "Choose Supplier", 0, true);
                $('#optional_product_code').val(value.optional_product_code);
                $('#optional_reference_no').val(value.optional_reference_no);
                $('#optional_currency').select2().val(value.optional_currency).trigger('change');
                initSelect2Remote($('#optional_currency'), "{{ route('currencyrate.search-data') }}", "Choose Currency", 0, true);
                $('#optional_cost').val(value.optional_cost);
                $('#itinerary_optional_id').val(data.data.id);
                $('#form-optional').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>