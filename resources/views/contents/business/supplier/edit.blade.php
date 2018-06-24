@extends('layouts.app')

@section('title', 'Edit supplier')

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
        <li class="breadcrumb-item"><a href="{{route('supplier.index')}}">supplier</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit supplier')

@section('content')
    @include('flash::message')
    {!! Form::model($supplier, [
            'route'     =>['supplier.update', $supplier->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-supplier',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.business.supplier._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('supplier.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        @if($supplier->is_draft)
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
    var url = "{{route('supplier.update', $supplier->id)}}";
    $('#form-supplier').attr('action', url + '?is_draft=false');
    $('#form-supplier').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = "{{route('supplier.update', $supplier->id)}}";
    $('#form-supplier').attr('action', url + '?is_publish_continue=true');
    $('#form-supplier').submit();
});
</script>
@endsection