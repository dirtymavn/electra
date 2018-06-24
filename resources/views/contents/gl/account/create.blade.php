@extends('layouts.app')

@section('title', 'Create Account (COA)')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('account.index')}}">Account (COA)</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Account (COA)')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'account.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-account',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.gl.account._form')  
                <input type="hidden" id="is_draft" name="is_draft">
                <input type="hidden" id="is_publish_continue" name="is_publish_continue">
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('account.index')}}" class="btn btn-grey">Cancel</a>
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
    var url = $('#form-account').attr('action');
    $("#is_draft").val(true);
    $('#form-account').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = $('#form-account').attr('action');
    $("#is_publish_continue").val(true);
    $('#form-account').submit();
});
</script>
@endsection