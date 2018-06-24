@extends('layouts.app')

@section('title', 'Audit Trail')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item">Audit Trail</li>
</ul>
@endsection

@section('page_title', 'Audit Trail Lists')

@section('content')
@include('flash::message')

<div class="table-responsive">
    {!! $dataTable->table(['class' => 'datatable table table-striped responsive no-wrap', 'cellspacing'=>"0", 'width'=>"100%"]) !!}
</div>

@endsection
@section('script')
{!! Html::script('https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js') !!}
{!! Html::script('https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js') !!}
{!! $dataTable->scripts() !!}
@endsection
