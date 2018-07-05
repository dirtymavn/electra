<script>
    $(document).ready(function() {
        var detailColumns = [
            { data: 'supplier_no', name: 'supplier_no'},
            { data: 'product_code', name: 'product_code'},
            { data: 'charge_method', name: 'charge_method'},
            { data: 'ref_no', name: 'ref_no'},
            { data: 'service_remark', name: 'service_remark'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datasFixed = {
            'type': 'itinerary-service-fixed'
        };

        var datasVariable = {
            'type': 'itinerary-service-variable'
        };

        initDatatable($('#itinerary-service-fixed'), "{{route('itin.get-detail-data')}}", detailColumns, datasFixed);
        initDatatable($('#itinerary-service-variable'), "{{route('itin.get-detail-data')}}", detailColumns, datasVariable);

        $('#form-itinerary-service').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-service').modal('hide');
                    $('.itinerary-service').DataTable().ajax.reload();
                }
            });
        });

        // submit service route
        $('#form-itinerary-service-route').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service-route.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#itinerary-service-route').DataTable().ajax.reload();
                    $('#form-service-route').modal('hide');
                    $('#form-service').modal('hide');
                    setTimeout(function() {
                        $('#form-service').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });

        // submit service interval
        $('#form-itinerary-service-interval').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service-interval.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#itinerary-service-interval').DataTable().ajax.reload();
                    $('#form-service-interval').modal('hide');
                    $('#form-service').modal('hide');
                    setTimeout(function() {
                        $('#form-service').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });

        // submit service ptc
        $('#form-itinerary-service-ptc').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service-ptc.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#itinerary-service-ptc').DataTable().ajax.reload();
                    $('#form-service-ptc').modal('hide');
                    $('#form-service').modal('hide');
                    setTimeout(function() {
                        $('#form-service').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });

        // submit service foc
        $('#form-itinerary-service-foc').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service-foc.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#itinerary-service-foc').DataTable().ajax.reload();
                    $('#form-service-foc').modal('hide');
                    $('#form-service').modal('hide');
                    setTimeout(function() {
                        $('#form-service').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });

        // submit service tax
        $('#form-itinerary-service-tax').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{route('itin.itinerary-service-tax.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#itinerary-service-tax').DataTable().ajax.reload();
                    $('#form-service-tax').modal('hide');
                    $('#form-service').modal('hide');
                    setTimeout(function() {
                        $('#form-service').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                }
            });
        });

    });

    $(document).on('click', '.btn-add-service', function(e) {
        $('#form-itinerary-service').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service').modal({backdrop: 'static', keyboard: false});
        var makeId = makeid();
        $('#itinerary_service_route_id').val(makeId);
        $('#itinerary_service_interval_id').val(makeId);
        $('#itinerary_service_ptc_id').val(makeId);
        $('#itinerary_service_foc_id').val(makeId);
        $('#itinerary_service_tax_id').val(makeId);
        $('#itinerary_service_id').val(makeId);

        // init data table related service
        initDatatable($('#itinerary-service-route'), "{{route('itin.get-detail-data')}}", routeColumns, RouteDatas());
        initDatatable($('#itinerary-service-interval'), "{{route('itin.get-detail-data')}}", intervalColumns, IntervalDatas());
        initDatatable($('#itinerary-service-ptc'), "{{route('itin.get-detail-data')}}", ptcColumns, PtcDatas());
        initDatatable($('#itinerary-service-foc'), "{{route('itin.get-detail-data')}}", focColumns, FocDatas());
        initDatatable($('#itinerary-service-tax'), "{{route('itin.get-detail-data')}}", taxColumns, TaxDatas());

        e.preventDefault();
    });

    $(document).on('click', '.deleteDataService', function() {
        var id = $(this).data('id');
        var element = $(this).data('element');
        deleteTempData($('#'+element), id);
    });

    function deleteTempData(element, id) {
        $.ajax({
            url: "{{route('itin.itinerary-detail.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $(element).DataTable().ajax.reload();
            }
        })
    }

    $(document).on('click', '.editDataService', function() {
        var id = $(this).data('id');
        var element = $(this).data('element');
        editTempData(element, id); 
        $('#itinerary_service_route_method').val('edit');
        $('#itinerary_service_interval_method').val('edit');
        $('#itinerary_service_ptc_method').val('edit');
        $('#itinerary_service_foc_method').val('edit');
        $('#itinerary_service_tax_method').val('edit');
    });

    function makeid() {
        var text = "";
        var possible = "0123456789";

        for (var i = 0; i < 4; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    function editTempData(element, id) {
        $.ajax({
            url: "{{route('itin.itinerary-detail.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;

                if (element == 'itinerary-service-variable' || element == 'itinerary-service-fixed') {
                    $('#itinerary_service_id').val(data.data.id);
                    $('#charge_method').val(value.charge_method);
                    $('#currency').val(value.currency);
                    $('#service_type').val(value.service_type);
                    $('#product_code').val(value.product_code);
                    $('#ref_no').val(value.ref_no);
                    $('#service_remark').val(value.service_remark);
                    $('#supplier_no').val(value.supplier_no);
                    $('#tax_currency').val(value.tax_currency);
                    $('#tax_free_foc_flag').val(value.tax_free_foc_flag);
                    $('#tax_type').val(value.tax_type);
                    $('#foc_discount_type').val(value.foc_discount_type);

                    initDatatable($('#itinerary-service-route'), "{{route('itin.get-detail-data')}}", routeColumns, RouteDatas(false));
                    initDatatable($('#itinerary-service-interval'), "{{route('itin.get-detail-data')}}", intervalColumns, IntervalDatas(false));
                    initDatatable($('#itinerary-service-ptc'), "{{route('itin.get-detail-data')}}", ptcColumns, PtcDatas(false));
                    initDatatable($('#itinerary-service-foc'), "{{route('itin.get-detail-data')}}", focColumns, FocDatas(false));
                    initDatatable($('#itinerary-service-tax'), "{{route('itin.get-detail-data')}}", taxColumns, TaxDatas(false));

                    $('#form-service').modal({backdrop: 'static', keyboard: false});
                }

                if (element == 'itinerary-service-foc') {
                    $('#itinerary_service_foc_id').val(data.data.id);
                    $('#foc_foc').val(value.foc_foc);
                    $('#foc_pax_no').val(value.foc_pax_no);
                    $('#form-service-foc').modal({backdrop: 'static', keyboard: false});
                }

                if (element == 'itinerary-service-interval') {
                    $('#itinerary_service_interval_id').val(data.data.id);
                    $('#interval_discount_amount').val(value.interval_discount_amount);
                    $('#interval_discount_percent').val(value.interval_discount_percent);
                    $('#interval_net_cost').val(value.interval_net_cost);
                    $('#interval_pax_from').val(value.interval_pax_from);
                    $('#interval_pax_to').val(value.interval_pax_to);
                    $('#interval_unit_cost').val(value.interval_unit_cost);
                    $('#form-service-interval').modal({backdrop: 'static', keyboard: false});
                }

                if (element == 'itinerary-service-ptc') {
                    $('#itinerary_service_ptc_id').val(data.data.id);
                    $('#ptc_discount_amount').val(value.ptc_discount_amount);
                    $('#ptc_discount_percent').val(value.ptc_discount_percent);
                    $('#ptc_net_cost').val(value.ptc_net_cost);
                    $('#ptc_pax_from').val(value.ptc_pax_from);
                    $('#ptc_pax_ptc').val(value.ptc_pax_ptc);
                    $('#ptc_pax_to').val(value.ptc_pax_to);
                    $('#ptc_unit_cost').val(value.ptc_unit_cost);
                    $('#form-service-ptc').modal({backdrop: 'static', keyboard: false});
                }

                if (element == 'itinerary-service-route') {
                    $('#itinerary_service_route_id').val(data.data.id);
                    $('#route_description').val(value.route_description);
                    $('#start_date').val(value.start_date);
                    $('#start_description').val(value.start_description);
                    $('#status').val(value.status);
                    $('#end_date').val(value.end_date);
                    $('#end_description').val(value.end_description);

                    $('#form-service-route').modal({backdrop: 'static', keyboard: false});
                }

                if (element == 'itinerary-service-tax') {
                    $('#itinerary_service_tax_id').val(data.data.id);
                    $('#tax_ptc').val(value.tax_ptc);
                    $('#tax_tax_amount').val(value.tax_tax_amount);
                    $('#form-service-tax').modal({backdrop: 'static', keyboard: false});
                }
            }
        })
    }

    // Route
    var routeColumns = [
        { data: 'route_description', name: 'route_description'},
        { data: 'start_date', name: 'start_date'},
        { data: 'end_date', name: 'end_date'},
        { data: 'start_description', name: 'start_description'},
        { data: 'end_description', name: 'end_description'},
        { data: 'status', name: 'status'},
        { data: 'action', name: 'action', className: 'dt-center'},
    ];

    function RouteDatas(add = true) {
        if (add) {
            return {
                'type': 'itinerary-service-route',
                'parent_id': $('#itinerary_service_route_id').val()
            };    
        } else {
            return {
                'type': 'itinerary-service-route',
                'parent_id': $('#itinerary_service_id').val()
            };
        }
        
    }

    $(document).on('click', '.close-service-route', function(e) {
        $('#form-service-route').modal('hide');
        $('#form-service').modal('hide');
        setTimeout(function() {
            $('#form-service').modal({backdrop: 'static', keyboard: false});
        }, 500)
    });

    $(document).on('click', '.btn-add-service-route', function(e) {
        $('#form-itinerary-service-route').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service-route').modal({backdrop: 'static', keyboard: false});

        $('#itinerary_service_route_id').val($('#itinerary_service_id').val());
        e.preventDefault();
    });

    $(document).on('click', '#submit-service-route', function(e) {
        $('#form-itinerary-service-route').submit();
    });


    // Cost Interval
    var intervalColumns = [
        { data: 'interval_pax_from', name: 'interval_pax_from'},
        { data: 'interval_pax_to', name: 'interval_pax_to'},
        { data: 'interval_unit_cost', name: 'interval_unit_cost'},
        { data: 'interval_discount_percent', name: 'interval_discount_percent'},
        { data: 'interval_discount_amount', name: 'interval_discount_amount'},
        { data: 'interval_net_cost', name: 'interval_net_cost'},
        { data: 'action', name: 'action', className: 'dt-center'},
    ];

    function IntervalDatas(add = true) {
        if (add) {
            return {
                'type': 'itinerary-service-interval',
                'parent_id': $('#itinerary_service_interval_id').val()
            };    
        } else {
            return {
                'type': 'itinerary-service-interval',
                'parent_id': $('#itinerary_service_id').val()
            };
        }
        
    }

    $(document).on('click', '.close-service-interval', function(e) {
        $('#form-service-interval').modal('hide');
        $('#form-service').modal('hide');
        setTimeout(function() {
            $('#form-service').modal({backdrop: 'static', keyboard: false});
        }, 500)
    });

    $(document).on('click', '.btn-add-service-interval', function(e) {
        $('#form-itinerary-service-interval').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service-interval').modal({backdrop: 'static', keyboard: false});

        $('#itinerary_service_interval_id').val($('#itinerary_service_id').val());
        e.preventDefault();
    });

    $(document).on('click', '#submit-service-interval', function(e) {
        $('#form-itinerary-service-interval').submit();
    });


    // Other Ptc
    var ptcColumns = [
        { data: 'ptc_pax_ptc', name: 'ptc_pax_ptc'},
        { data: 'ptc_pax_from', name: 'ptc_pax_from'},
        { data: 'ptc_pax_to', name: 'ptc_pax_to'},
        { data: 'ptc_unit_cost', name: 'ptc_unit_cost'},
        { data: 'ptc_discount_percent', name: 'ptc_discount_percent'},
        { data: 'ptc_discount_amount', name: 'ptc_discount_amount'},
        { data: 'ptc_net_cost', name: 'ptc_net_cost'},
        { data: 'action', name: 'action', className: 'dt-center'},
    ];

    function PtcDatas(add = true) {
        if (add) {
            return {
                'type': 'itinerary-service-ptc',
                'parent_id': $('#itinerary_service_ptc_id').val()
            };    
        } else {
            return {
                'type': 'itinerary-service-ptc',
                'parent_id': $('#itinerary_service_id').val()
            };
        }
        
    }

    $(document).on('click', '.close-service-ptc', function(e) {
        $('#form-service-ptc').modal('hide');
        $('#form-service').modal('hide');
        setTimeout(function() {
            $('#form-service').modal({backdrop: 'static', keyboard: false});
        }, 500)
    });

    $(document).on('click', '.btn-add-service-ptc', function(e) {
        $('#form-itinerary-service-ptc').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service-ptc').modal({backdrop: 'static', keyboard: false});

        $('#itinerary_service_ptc_id').val($('#itinerary_service_id').val());
        e.preventDefault();
    });

    $(document).on('click', '#submit-service-ptc', function(e) {
        $('#form-itinerary-service-ptc').submit();
    });


    // Other Foc
    var focColumns = [
        { data: 'foc_pax_no', name: 'foc_pax_no'},
        { data: 'foc_foc', name: 'foc_foc'},
        { data: 'action', name: 'action', className: 'dt-center'},
    ];

    function FocDatas(add = true) {
        if (add) {
            return {
                'type': 'itinerary-service-foc',
                'parent_id': $('#itinerary_service_foc_id').val()
            };    
        } else {
            return {
                'type': 'itinerary-service-foc',
                'parent_id': $('#itinerary_service_id').val()
            };
        }
        
    }

    $(document).on('click', '.close-service-foc', function(e) {
        $('#form-service-foc').modal('hide');
        $('#form-service').modal('hide');
        setTimeout(function() {
            $('#form-service').modal({backdrop: 'static', keyboard: false});
        }, 500)
    });

    $(document).on('click', '.btn-add-service-foc', function(e) {
        $('#form-itinerary-service-foc').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service-foc').modal({backdrop: 'static', keyboard: false});

        $('#itinerary_service_foc_id').val($('#itinerary_service_id').val());
        e.preventDefault();
    });

    $(document).on('click', '#submit-service-foc', function(e) {
        $('#form-itinerary-service-foc').submit();
    });


    // Other Tax
    var taxColumns = [
        { data: 'tax_ptc', name: 'tax_ptc'},
        { data: 'tax_tax_amount', name: 'tax_tax_amount'},
        { data: 'action', name: 'action', className: 'dt-center'},
    ];

    function TaxDatas(add = true) {
        if (add) {
            return {
                'type': 'itinerary-service-tax',
                'parent_id': $('#itinerary_service_tax_id').val()
            };    
        } else {
            return {
                'type': 'itinerary-service-tax',
                'parent_id': $('#itinerary_service_id').val()
            };
        }
        
    }

    $(document).on('click', '.close-service-tax', function(e) {
        $('#form-service-tax').modal('hide');
        $('#form-service').modal('hide');
        setTimeout(function() {
            $('#form-service').modal({backdrop: 'static', keyboard: false});
        }, 500)
    });

    $(document).on('click', '.btn-add-service-tax', function(e) {
        $('#form-itinerary-service-tax').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-service-tax').modal({backdrop: 'static', keyboard: false});

        $('#itinerary_service_tax_id').val($('#itinerary_service_id').val());
        e.preventDefault();
    });

    $(document).on('click', '#submit-service-tax', function(e) {
        $('#form-itinerary-service-tax').submit();
    });




    $(document).on('click', '#form-service-accept', function(e) {
        $('#form-itinerary-service').submit();
    });


    $(document).on('click', '.btn-add-service-route, .btn-add-service-interval, .btn-add-service-ptc, .btn-add-service-foc, .btn-add-service-tax', function(e) {
        $('#itinerary_service_route_method').val('add');
        $('#itinerary_service_interval_method').val('add');
        $('#itinerary_service_ptc_method').val('add');
        $('#itinerary_service_foc_method').val('add');
        $('#itinerary_service_tax_method').val('add');
    });
    
</script>