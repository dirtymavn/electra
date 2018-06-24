@extends('layouts.app')

@section('title', 'Create Customer')

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
        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Customer')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'customer.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-customer',
            'enctype' => 'multipart/form-data',
        ]) !!}
        
                @include('contents.business.customer._form_fixed')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('customer.index')}}" class="btn btn-grey">Cancel</a>
                        <button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>
                        <button type="button" class="btn btn-primary" id="btn-submit">Publish</button>
                        <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    </div>
                </div>              
    </form>
@endsection

@section('script')
<script>
    submitForm("{{route('customer.store')}}", $('#form-customer'), 'create');
</script>
@endsection