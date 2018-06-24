@extends('layouts.app')

@section('title', 'Create Period End')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('periodend.index')}}">Period End</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Period End')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'periodend.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-periodend',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.gl.periodend._form')  
                <input type="hidden" id="is_draft" name="is_draft">
                <input type="hidden" id="is_publish_continue" name="is_publish_continue">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('periodend.index')}}" class="btn btn-grey">Cancel</a>
                        <button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Publish</button>
                        <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>

    @stack('models')
@endsection

@section('script')
<script>
$(document).on('click', '#btn-submit-draft', function() {
    var url = $('#form-periodend').attr('action');
    $("#is_draft").val(true);
    $('#form-periodend').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = $('#form-periodend').attr('action');
    $("#is_publish_continue").val(true);
    $('#form-periodend').submit();
});
</script>
@endsection