@extends('layouts.app')

@section('title', 'Edit Currency Rate')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('currencyrate.index')}}">Currency Rate</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Currency Rate')

@section('content')
    @include('flash::message')
    {!! Form::model($currencyrate, [
            'route'     =>['currencyrate.update', $currencyrate->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-currencyrate',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.currency_rate._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('currencyrate.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="button" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        {{-- @if($currencyrate->is_draft)
                            <button type="button" class="btn btn-primary" id="btn-publish">Publish</button>
                            <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                        @endif --}}
                    </div>
                </div>              
            </div>
        </div>
    </form>

    @stack('models')
@endsection

@section('script')
<script>
    submitForm("{{route('currencyrate.update', $currencyrate->id)}}", $('#form-currencyrate'), 'update');
</script>
@endsection