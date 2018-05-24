@extends('layouts.app')

@section('title', 'Business - Customer')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer</a></li>
</ul>
@endsection

@section('page_title', 'Customers')

@section('content')
@include('flash::message')
<a href="{{ route('customer.create')}}" class="btn btn-primary" id="btn-submit">
    <i class="fa fa-plus m-right-10"></i> Add Customer
</a>
<br>

<div class="table-responsive">
    {!! $dataTable->table(['class' => 'datatable table table-striped', 'cellspacing'=>"0", 'width'=>"100%"]) !!}
</div>

@include('partials.delete-modal')
@endsection
@section('script')
{!! $dataTable->scripts() !!}
@endsection
