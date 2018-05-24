@extends('layouts.app')

@section('title', 'Create Transaction')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('transaction.index')}}">Transaction</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Transaction')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'transaction.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-transaction',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.business.transaction._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('transaction.index')}}" class="btn btn-white">Cancel</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection