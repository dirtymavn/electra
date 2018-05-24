@extends('layouts.app')

@section('title', 'Edit Transaction')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('transaction.index')}}">Transaction</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Transaction')

@section('content')
    @include('flash::message')
    {!! Form::model($transaction, [
            'route'     =>['transaction.update', $transaction->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-transaction',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.business.transaction._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('transaction.index') }}" class="btn btn-white">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">{{ trans('Submit') }}</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection