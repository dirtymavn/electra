@extends('layouts.app')

@section('title', 'Edit Master Document')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('document.index')}}">Master Document</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Master Document')

@section('content')
    @include('flash::message')
    {!! Form::model($document, [
            'route'     =>['document.update', $document->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-document',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.master_document._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('document.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="button" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        @if($document->is_draft)
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
    submitForm("{{route('document.update', $document->id)}}", $('#form-document'), 'update');
</script>
@endsection