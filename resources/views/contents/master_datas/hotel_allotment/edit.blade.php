@extends('layouts.app')

@section('title', 'Edit Air Allotment')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('hotel-allotment.index')}}">Air Allotment</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Air Allotment')

@section('content')
    @include('flash::message')
    {!! Form::model($hotelallotment, [
            'route'     =>['hotel-allotment.update', $hotelallotment->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-hotelallotment',
            'enctype' => 'multipart/form-data'
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.hotel_allotment._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('hotel-allotment.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        {{-- @if($hotelallotment->is_draft)
                            <button type="button" class="btn btn-primary" id="btn-publish">Publish</button>
                            <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                        @endif --}}
                    </div>
                </div>              
            </div>
        </div>
    {!! Form::close() !!}
    @stack('models')
@endsection

@section('script')
<script>
    submitForm("{{route('hotel-allotment.update', $hotelallotment->id)}}", $('#form-hotelallotment'), 'update');
</script>
@endsection