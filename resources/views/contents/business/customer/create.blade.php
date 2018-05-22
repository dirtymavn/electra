@extends('layouts.app')

@section('title', 'Create Customer')

@section('style')
<link href="http://13.229.205.203/sabre/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" /> -->
<link href="http://13.229.205.203/sabre/kendo/styles/web/kendo.common.min.css" rel="stylesheet" type="text/css" />
<link href="http://13.229.205.203/sabre/kendo/styles/web/kendo.common-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="http://13.229.205.203/sabre/kendo/styles/web/kendo.bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Customer')

@section('content')
    {!! Form::open([
            'route' =>  'customer.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-customer',
            'enctype' => 'multipart/form-data',
        ]) !!}
        
                @include('contents.business.customer._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('customer.index')}}" class="btn btn-white">Cancel</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </div>              
    </form>
@endsection

@section('script')
<script src="http://13.229.205.203/sabre/kendo/dist/js/kendo.custom.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        $("#dt-picker-from").kendoDatePicker({});

        $("#dt-picker-to").kendoDatePicker({});

        var data = [
            {text: "", value: "0"},
            {text: "", value: "1"},
            {text: "", value: "2"}
        ];

        $("#seat-type").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "credit_term_wrapper");

        $("#meal-type").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "credit_term_wrapper");

        $("#credit-term-type").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "credit_term_wrapper");

        $("#payment-type").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "products_wrapper");

        $("#invoice-delivery-method").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "invoice_delivery_wrapper");

        $("#recall-comm-method").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "recall_comm_wrapper");

        $("#dropdown-customer-no").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "recall_comm_wrapper");

        $("#dropdown-team-id").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "recall_comm_wrapper");

        $("#dropdown-customer-name").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0
        }).closest(".k-widget")
            .attr("id", "recall_comm_wrapper");

        $("#dropdown-sales-id").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0,
        }).closest(".k-widget")
            .attr("id", "recall_comm_wrapper");

        $("#rebate-amout-type").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0,
        }).closest(".k-widget")
            .attr("id", "rebate_method_wrapper");

        $("#rebate-method").kendoDropDownList({
            dataTextField: "text",
            dataValueField: "value",
            height: 100,
            dataSource: data,
            index: 0,
        }).closest(".k-widget").attr("id", "rebate_method_wrapper");
    });
</script>
@endsection