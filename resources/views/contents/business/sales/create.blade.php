@extends('layouts.app')

@section('title', 'Create Sales')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Sales</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Sales')

@section('content')
    {!! Form::open([
            'route' =>  'customer.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-customer',
            'enctype' => 'multipart/form-data',
        ]) !!}
        
                @include('contents.business.sales._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('customer.index')}}" class="btn btn-white">Cancel</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                    </div>
                </div>              
    </form>
@endsection

@section('script')

@endsection