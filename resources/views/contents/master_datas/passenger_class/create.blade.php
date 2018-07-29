@extends('layouts.app')

@section('title', 'Create Passenger Class')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('passenger.index')}}">Passenger Class</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Passenger Class')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'passenger.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-passenger',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.passenger_class._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('passenger.index')}}" class="btn btn-grey">Cancel</a>
                        {{--<button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>--}}
                        <button type="button" class="btn btn-primary" id="btn-submit">Publish</button>
                        <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
    submitForm("{{route('passenger.store')}}", $('#form-passenger'), 'create');
</script>
@endsection