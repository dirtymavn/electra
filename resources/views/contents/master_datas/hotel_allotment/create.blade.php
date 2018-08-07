@extends('layouts.app')

@section('title', 'Create Hotel Allotment')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('hotel-allotment.index')}}">Hotel Allotment</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Hotel Allotment')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'hotel-allotment.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-hotelallotment',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.hotel_allotment._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('hotel-allotment.index')}}" class="btn btn-grey">Cancel</a>
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
    submitForm("{{route('hotel-allotment.store')}}", $('#form-hotelallotment'), 'create');
</script>
@endsection