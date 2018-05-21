@extends('layouts.app')

@section('title', 'Edit company')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('company.index')}}">Company</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Company')

@section('content')
    {!! Form::model($company, [
            'route'     =>['company.update', $company->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-company',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.masters.company._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('company.index') }}" class="btn btn-white">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">{{ trans('Submit') }}</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection