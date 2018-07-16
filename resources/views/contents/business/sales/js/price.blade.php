<script>
    var priceColumns = [
    { data: 'billing_currency_id', name: 'billing_currency_id'},
    { data: 'gst_id', name: 'gst_id'},
    { data: 'gst_percent', name: 'gst_percent'},
    { data: 'gst_amt', name: 'gst_amt'},
    { data: 'rebate_percent', name: 'rebate_percent'},
    { data: 'rebate_amt', name: 'rebate_amt'},
    { data: 'description', name: 'description'},

    { data: 'action', name: 'action'},
    ];

    $(document).ready(function() {

        $('#form-price-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.price-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-price').modal('hide');
                    $('#price-detail').DataTable().ajax.reload();
                    $('#form-sales-trx').modal('hide');
                    setTimeout(function() {
                        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });
    });

    $(document).on('click', '.btn-add-price', function(e) {
        $('#form-price-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-price').modal({backdrop: 'static', keyboard: false});
        $("#price_id").val(id)
        e.preventDefault();
    });

    $(document).on('click', '#form-price-accept', function() {
        $('#form-price-detail').submit();
    })

    $(document).on('click', '#form-price-cancel', function() {
        $('#form-price').modal('hide');
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
                $('#price-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $("#start_date").val(value.start_date)
                $("#end_date").val(value.end_date)
                $("#start_desc").val(value.start_desc)
                $("#end_desc").val(value.end_desc)
                $("#description").val(value.description)
                $("#status").val(value.status)
                $("#misc_id").val(data.data.id)

                $('#form-price').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    function Price(add = true) {
        if (add) {
            return {
                'type': 'price-detail',
                'parent_id': $('#price_id').val()
            };    
        } else {
            return {
                'type': 'price-detail',
                'parent_id': $('#detail_id').val()
            };
        }
        
    }
</script>