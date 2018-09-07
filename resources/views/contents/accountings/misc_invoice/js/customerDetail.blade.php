<script>
    function detailCustomer(evt){
        var id = evt;
        console.log(id);
        $.ajax({
            url: "{{route('accounting.misc-invoice.customer_detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'customer_id':id},
            success: function(data) {
                var value = data.data;
                $('#tc_id').val(value.tc_id);
                $('#sales_id').val(value.sales_id);
                $('#attention').val(value.attention);
            }
        })
    }
</script>