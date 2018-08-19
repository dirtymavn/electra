@extends('layouts.app')

@section('title', 'Create Fit folder')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('fitfolder.index')}}">Fitfolder</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Fit folder')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'fitfolder.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-fitfolder',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.fits.tour_folder._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('fitfolder.index')}}" class="btn btn-grey">Cancel</a>
                        <!-- <button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button> -->
                        <button type="button" class="btn btn-primary" id="btn-submit">Publish</button>
                        <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    </div>
                </div>              
            </div>
        </div>
        {!! Form::close() !!}
    @stack('models')
@endsection

@section('script')
<script>
    submitForm("{{route('fitfolder.store')}}", $('#form-fitfolder'), 'create');
</script>
@endsection