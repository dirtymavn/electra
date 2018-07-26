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
            'type': 'core-report'
        };

        initDatatable($('#core-report'), "{{route('core.get-detail-data')}}", columns, datas);

        $('#form-core-report').submit(function(e) {
            e.preventDefault();
            $('div.spinner').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('core.core-report.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-optional').modal('hide');
                    $('#core-report').DataTable().ajax.reload();
                },
                error: function(data) {
                    $('div.spinner').hide();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-optional', function(e) {
        $('#form-core-report').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-optional').modal({backdrop: 'static', keyboard: false});
        e.preventDefault();
    });

    $(document).on('click', '.deleteDataOptional', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('core.core-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#core-report').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataOptional', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('core.core-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;

                

                
                $('#itinerary_optional_id').val(data.data.id);
                $('#form-optional').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>