@extends('layouts.app')

@section('title', 'Create Company')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('company.index')}}">Company</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Company')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'company.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-company',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.masters.company._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('company.index')}}" class="btn btn-white">Cancel</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection