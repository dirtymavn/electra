@extends('layouts.app')

@section('title', 'Create Profile')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Profile</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Profile')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'profile.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-profile',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.internals.profile._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('profile.index')}}" class="btn btn-grey">Cancel</a>
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
    var url = "{{route('profile.store')}}";
    $('#form-profile').attr('action', url + '?is_draft=true');
    $('#form-profile').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = "{{route('profile.store')}}";
    $('#form-profile').attr('action', url + '?is_publish_continue=true');
    $('#form-profile').submit();
});
</script>
@endsection