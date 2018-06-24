@extends('layouts.app')

@section('title', 'Create Itinerary')

@section('style')
<style>
    .os-tabs-controls {
        margin-bottom: 0px;
    }
</style>
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('itin.index')}}">Itinerary</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Itinerary')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'itin.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-itin',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.outbounds.itin._form_fixed')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('itin.index')}}" class="btn btn-grey">Cancel</a>
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
    var url = "{{route('itin.store')}}";
    $('#form-itin').attr('action', url + '?is_draft=true');
    $('#form-itin').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = "{{route('itin.store')}}";
    $('#form-itin').attr('action', url + '?is_publish_continue=true');
    $('#form-itin').submit();
});
</script>
@endsection