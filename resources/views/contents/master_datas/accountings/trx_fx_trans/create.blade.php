@extends('layouts.app')

@section('title', 'Create FX Transfer')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('fx-trans.index')}}">FX Transfer</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create FX Transfer')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'fx-trans.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-fxtrans',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.accountings.trx_fx_trans._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('fx-trans.index')}}" class="btn btn-grey">Cancel</a>
                        {{--<button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>--}}
                        <button type="button" class="btn btn-primary" id="btn-submit">Publish</button>
                        <button type="button" class="btn btn-primary" id="btn-publish-continue">Publish & Continue</button>
                    </div>
                </div>              
            </div>
        </div>
    </form>

    @stack('models')
@endsection

@section('script')
<script>
    submitForm("{{route('fx-trans.store')}}", $('#form-fxtrans'), 'create');
</script>
@endsection