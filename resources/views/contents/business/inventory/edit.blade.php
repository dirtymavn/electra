@extends('layouts.app')

@section('title', 'Create Inventory')

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
        <li class="breadcrumb-item"><a href="{{route('inventory.index')}}">Inventory</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Inventory')

@section('content')
@include('flash::message')
     {!! Form::model($inventory, [
            'route'     =>['inventory.update', $inventory->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-inventory',
            'enctype' => 'multipart/form-data',
        ]) !!}
        @include('contents.business.inventory._form')   
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a href="{{ route('inventory.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                @if($inventory->is_draft)
                    <button type="button" class="btn btn-primary" id="btn-publish">Publish</button>
                    <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                @endif
            </div>
        </div>            
    {!! Form::close() !!}
@endsection


@section('script')
<script>
$(document).on('click', '#btn-publish', function() {
    var url = $('#form-inventory').attr('action');
    $('#form-inventory').attr('action', url + '?is_draft=false');
    $('#form-inventory').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = $('#form-inventory').attr('action');
    $('#form-inventory').attr('action', url + '?is_publish_continue=true');
    $('#form-inventory').submit();
});
</script>
@endsection