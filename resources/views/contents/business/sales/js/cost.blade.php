<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'pay_amt', name: 'pay_amt'},
            { data: 'currency_code_id', name: 'currency_code_id'},
            { data: 'supplier_reference_id', name: 'supplier_reference_id'},
            { data: 'voucher_reference_id', name: 'voucher_reference_id'},

            { data: 'action', name: 'action'},
        ];

        var detailDatas = {
            'type': 'cost-detail'
        };

        initDatatable($('#cost-detail'), "{{route('sales.get-detail-data')}}", detailColumns, detailDatas);

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
                    $('#form-cost').modal('hide');
                    $('#cost-detail').DataTable().ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-cost', function(e) {
        $('#form-cost-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-cost').modal({backdrop: 'static', keyboard: false});
        $('#form-cost').css("z-index", "99999");
        e.preventDefault();
    });

    $(document).on('click', '#form-detail-accept', function() {
        $('#form-cost-detail').submit();
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

                $('#form-cost').modal({backdrop: 'static', keyboard: false});
            }
        })
    });
</script>