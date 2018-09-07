@extends('layouts.app')

@section('title', 'Edit Misc Invoice')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('accounting.misc-invoice.index')}}">Invoice</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Misc Invoice')

@section('content')
    @include('flash::message')
    {!! Form::model($invoice, [
            'route'     =>['accounting.misc-invoice.update', $invoice->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-invoice',
            'enctype' => 'multipart/form-data'
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.accountings.misc_invoice._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('accounting.misc-invoice.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                    </div>
                </div>              
            </div>
        </div>
    {!! Form::close() !!}
    @stack('models')
@endsection

@section('script')
<script>
    submitForm("{{route('accounting.misc-invoice.update', $invoice->id)}}", $('#form-invoice'), 'update');
</script>
@include('contents.accountings.misc_invoice.js.customerDetail')
@include('contents.accountings.misc_invoice.js.editInvoice')
@include('contents.accountings.misc_invoice.parts.invoicedetail')
@endsection