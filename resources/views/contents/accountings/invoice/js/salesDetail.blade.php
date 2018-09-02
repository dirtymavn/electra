<script>
    function detailSales(evt){
        var id = evt;
        console.log(id);
        $.ajax({
            url: "{{route('accounting.invoice.sales_detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'sales_id':id},
            success: function(data) {
                var value = data.data;
                $('#tc_id').val(value.tc_id);
                $('#customer_name').val(value.customer.customer_name);
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
