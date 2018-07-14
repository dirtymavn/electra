@extends('layouts.app')

@section('title', 'Edit Tour Order')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('tourorder.index')}}">Tour Order</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Tour Order')

@section('content')
    @include('flash::message')
    {!! Form::model($tourOrder, [
            'route'     =>['tourorder.update', $tourOrder->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-tourorder',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.outbounds.tour_order._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('tourorder.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="button" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        @if($tourOrder->is_draft)
                            <button type="button" class="btn btn-primary" id="btn-publish">Publish</button>
                            <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                        @endif
                    </div>
                </div>              
            </div>
        </div>
    </form>
    @stack('models')
@endsection

@section('script')
<script>
    submitForm("{{route('tourorder.update', $tourOrder->id)}}", $('#form-tourorder'), 'update');
</script>
@endsection