@extends('layouts.app')

@section('title', 'Create Inventory Type')

@section('style')
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('inventory-type.index')}}">Inventory Type</a></li>
        <li class="breadcrumb-item">Create</li>
    </ul>
@endsection

@section('page_title', 'Create Inventory Type')

@section('content')
    @include('flash::message')
    {!! Form::open([
            'route' =>  'inventory-type.store',
            'class' =>  'form-horizontal',
            'id'    =>  'form-inventorytype',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.master_datas.inventory_type._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{route('inventory-type.index')}}" class="btn btn-grey">Cancel</a>
                        {{-- {{--<button type="button" class="btn btn-success" id="btn-submit-draft">Save as Draft</button>--}} --}}
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
    submitForm("{{route('inventory-type.store')}}", $('#form-inventorytype'), 'create');
</script>
@endsection