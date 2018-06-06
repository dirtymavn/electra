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
        <li class="breadcrumb-item"><a href="{{route('supplier.index')}}">Supplier</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Supplier')

@section('content')
    {!! Form::open([
            'route' =>  'supplier.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-supplier'
        ]) !!}
        @include('contents.business.supplier._form')  
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="{{route('supplier.index')}}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
            </div>
        </div>              
    {!! Form::close() !!}
@endsection

@section('script')

@endsection