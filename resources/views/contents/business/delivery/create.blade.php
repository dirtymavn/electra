@extends('layouts.app')

@section('title', 'Create Voucher')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
<style>
.element-voucher .element-header{
    margin-bottom: 0px;
}
</style>
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('lg.index')}}">Delivery</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Delivery')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'delivery.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-delivery',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.business.delivery._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('delivery.index')}}" class="btn btn-white">Cancel</a>
                        <button type="button" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </div>              
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('script')
@endsection