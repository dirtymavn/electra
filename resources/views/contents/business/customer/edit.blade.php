@extends('layouts.app')

@section('title', 'Edit Customer')

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
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Customer')

@section('content')
    @include('flash::message')
    {!! Form::model($customer, [
            'route'     =>['customer.update', $customer->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-customer',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.business.customer._form_fixed')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('customer.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        @if($customer->is_draft)
                            <button type="button" class="btn btn-primary" id="btn-publish">Publish</button>
                            <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                        @endif
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
$(document).on('click', '#btn-publish', function() {
    var url = "{{route('customer.update', $customer->id)}}";
    $('#form-customer').attr('action', url + '?is_draft=false');
    $('#form-customer').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = "{{route('customer.update', $customer->id)}}";
    $('#form-customer').attr('action', url + '?is_publish_continue=true');
    $('#form-customer').submit();
});
</script>
@endsection