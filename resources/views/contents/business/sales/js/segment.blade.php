<script>
    var segmentColumns = [
            { data: 'start_date', name: 'start_date'},
            { data: 'end_date', name: 'end_date'},
            { data: 'start_description', name: 'start_description'},
            { data: 'end_description', name: 'end_description'},
            { data: 'status', name: 'status'},
            { data: 'description', name: 'description'},
            { data: 'action', name: 'action'},
        ];

    $(document).ready(function() {
    
        $('#form-segment-detail').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('sales.segment-detail.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#form-segment').modal('hide');
                    $('#segment-detail').DataTable().ajax.reload();
                    $('#form-sales-trx').modal('hide');
                    setTimeout(function() {
                        $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });
    });

    $(document).on('click', '.btn-add-segment', function(e) {
        $('#form-segment-detail').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-segment').modal({backdrop: 'static', keyboard: false});
        $("#segment_id").val(id)
        e.preventDefault();
    });

    $(document).on('click', '#form-segment-accept', function() {
        $('#form-segment-detail').submit();
    })

    $(document).on('click', '#form-segment-cancel', function() {
        $('#form-segment').modal('hide');
        $('#form-sales-trx').modal('hide');
        setTimeout(function() {
            $('#form-sales-trx').modal({backdrop: 'static', keyboard: false});
        }, 500)
    })

    $(document).on('click', '.deleteDataSegment', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $('#segment-detail').DataTable().ajax.reload();
            }
        })
    });

    $(document).on('click', '.editDataSegment', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('sales.detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;
                $("#segment_id").val(data.data.id)
                $("#description").val(value.description)
                $("#start_date").val(value.start_date)
                $("#end_date").val(value.end_date)
                $("#start_description").val(value.start_description)
                $("#end_description").val(value.end_description)
                $("#status").val(value.status)

                $('#form-segment').modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    function Segment(add = true) {
        if (add) {
            return {
                'type': 'segment-detail',
                'parent_id': $('#segment_id').val()
            };    
        } else {
            return {
                'type': 'segment-detail',
                'parent_id': $('#detail_id').val()
            };
        }
        
    }
</script>