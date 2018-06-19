@extends('layouts.app')

@section('title', 'Edit Budget Rate')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('budget-rate.index')}}">Budget Rate</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
@endsection

@section('page_title', 'Edit Budget Rate')

@section('content')
    @include('flash::message')
    {!! Form::model($budgetRate, [
            'route'     =>['budget-rate.update', $budgetRate->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-budgetrate',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
                @include('contents.budgets.budget_rate._form')  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('budget-rate.index') }}" class="btn btn-grey">{{trans('Cancel')}}</a>
                        <button type="submit" class="btn btn-success" id="btn-update">{{ trans('Update') }}</button>
                        @if($budgetRate->is_draft)
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
<script>
$(document).on('click', '#btn-publish', function() {
    var url = $('#form-budgetrate').attr('action');
    $('#form-budgetrate').attr('action', url + '?is_draft=false');
    $('#form-budgetrate').submit();
});
$(document).on('click', '#btn-publish-continue', function() {
    var url = $('#form-budgetrate').attr('action');
    $('#form-budgetrate').attr('action', url + '?is_publish_continue=true');
    $('#form-budgetrate').submit();
});
</script>
@endsection