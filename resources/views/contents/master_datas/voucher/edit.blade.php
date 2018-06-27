@extends('layouts.app')

@section('title', 'Edit Voucher')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('voucher.index')}}">Voucher</a></li>
    <li class="breadcrumb-item">Edit</li>
</ul>
@endsection

@section('page_title', 'Edit voucher')

@section('content')
@include('flash::message')
{!! Form::model($voucher, [
    'route'     =>['voucher.update', $voucher->id],
    'method'    => 'PATCH',
    'class' =>  'form-horizontal',
    'id'    =>  'form-voucher',
    'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="box">
        <div class="box-body">
            @include('contents.master_datas.voucher._form')  
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="{{ route('voucher.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                    <button type="button" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                    @if($voucher->is_draft)
                    <button type="button" class="btn btn-primary" id="btn-publish">Publish</button>
                    <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    @endif
                </div>
            </div>             
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript">
    submitForm("{{route('voucher.update', $voucher->id)}}", $('#form-voucher'), 'update');
</script>
@endsection