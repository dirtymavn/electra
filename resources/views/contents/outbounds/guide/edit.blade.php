@extends('layouts.app')

@section('title', 'Edit Tour Guide')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('guide.index')}}">Tour Guide</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Tour Guide')

@section('content')
    @include('flash::message')
    {!! Form::model($guide, [
            'route'     =>['guide.update', $guide->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-guide',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.outbounds.guide._form_fixed')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('guide.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        @if($guide->is_draft)
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
    var url = $('#form-guide').attr('action');
    $('#form-guide').attr('action', url + '?is_draft=false');
    $('#form-guide').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = $('#form-guide').attr('action');
    $('#form-guide').attr('action', url + '?is_publish_continue=true');
    $('#form-guide').submit();
});
</script>
@endsection