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

    function totalSales(){
        var unitPrice=Number($('#unit_price').val());
        var qty=Number($('#qty').val());
        var gst=Number($('#gst').val());
        console.log('UNIT Price',unitPrice);
        console.log('QTY',qty);
        console.log('gst',gst);
        if (unitPrice>=0 && qty>=0 && gst>=0){
            var totalSales=(unitPrice*qty)+((unitPrice*qty)*gst);
            $('#total_sales').val(totalSales);
        }
    }
</script>