@extends('layouts.app')

@section('title', 'Create Tour Guide')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('guide.index')}}">Tour Guide</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Tour Guide')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'guide.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-guide',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.outbounds.guide._form_fixed')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('guide.index')}}" class="btn btn-grey">Cancel</a>
                        <button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Publish</button>
                        <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
$(document).on('click', '#btn-submit-draft', function() {
    var url = $('#form-guide').attr('action');
    $('#form-guide').attr('action', url + '?is_draft=true');
    $('#form-guide').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = $('#form-guide').attr('action');
    $('#form-guide').attr('action', url + '?is_publish_continue=true');
    $('#form-guide').submit();
});
</script>
@endsection