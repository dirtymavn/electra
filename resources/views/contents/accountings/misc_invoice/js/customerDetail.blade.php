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
                {{-- $('#sales-detail').DataTable().ajax.reload(); --}}
            }
        })
    }

    function dtSales() {
        $('#sales-detail').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route("accounting.invoice.sales_table") !!}',
            columns: [
                {data: 'product_code', name: 'product_code'},
                {data: 'sales_detail_remark', name: 'sales_detail_remark'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });
    }
</script>