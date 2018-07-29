@extends('layouts.app')

@section('title', 'Create Supplier')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
<style>
    .os-tabs-controls {
        margin-bottom: 0px;
    }
</style>
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
@include('flash::message')
    {!! Form::open([
            'route' =>  'supplier.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-supplier'
        ]) !!}
        @include('contents.master_datas.supplier._form')   
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="{{route('supplier.index')}}" class="btn btn-grey">Cancel</a>
                {{--<button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>--}}
                <button type="button" class="btn btn-primary" id="btn-submit">Publish</button>
                <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
            </div>
        </div>            
    {!! Form::close() !!}
@endsection

@section('script')
<script>
    submitForm("{{route('supplier.store')}}", $('#form-supplier'), 'create');
</script>
@endsection