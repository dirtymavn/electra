<script>
     var costColumns = [
            { data: 'pay_amt', name: 'pay_amt'},
            { data: 'currency_code_id', name: 'currency_code_id'},
            { data: 'supplier_reference_id', name: 'supplier_reference_id'},
            { data: 'voucher_reference_id', name: 'voucher_reference_id'},

            { data: 'action', name: 'action'},
        ];

    $(document).ready(function() {
    
        $('#form-cost-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.cost-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-cost').modal('hide');
                    $('#cost-detail').DataTable().ajax.reload();
                    $('#form-sales-trx').modal('hide');
                    setTimeout(function() {
                        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });
    });

    $(document).on('click', '.btn-add-cost', function(e) {
        $('#form-cost-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-cost').modal({backdrop: 'static', keyboard: false});
        $("#cost_id").val(id)
        e.preventDefault();
    });

    $(document).on('click', '#form-cost-accept', function() {
        $('#form-cost-detail').submit();
    })

    $(document).on('click', '#form-cost-cancel', function() {
        $('#form-cost').modal('hide');
        $('#form-sales-trx').modal('hide');
        setTimeout(function() {
            $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
        }, 500)
    })

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#cost-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataCost', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $("#cost_id").val(data.data.id)
                $("#pay_amt").val(value.pay_amt)
                $("#currency_code_id").val(value.currency_code_id)
                $("#supplier_reference_id").val(value.supplier_reference_id)
                $("#voucher_reference_id").val(value.voucher_reference_id)

                $('#form-cost').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    function Cost(add = true) {
        if (add) {
            return {
                'type': 'cost-detail',
                'parent_id': $('#cost_id').val()
            };    
        } else {
            return {
                'type': 'cost-detail',
                'parent_id': $('#detail_id').val()
            };
        }
        
    }
</script>