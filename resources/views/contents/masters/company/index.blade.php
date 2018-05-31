@extends('layouts.app')

@section('title', 'Company')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
	<li class="breadcrumb-item"><a href="{{route('company.index')}}">Company</a></li>
</ul>
@endsection

@section('page_title', 'Company Lists')

@section('content')
@include('flash::message')
<div class="row">
	<div class="col-sm-2">
		<a href="{{ route('company.create')}}" class="btn btn-primary" id="btn-submit">
			<i class="fa fa-plus m-right-10"></i> Add Company
		</a>		
	</div>
	<div class="col-sm-3">
		<div class="dropdown">
			<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
				Actions
			</button>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="{{ route('export.company') }}">Export XLS</a>
				<a class="dropdown-item" href="#">Export PDF</a>
			</div>
		</div>
	</div>
</div>
<br>

<div class="table-responsive">
	{!! $dataTable->table(['class' => 'datatable table table-striped', 'cellspacing'=>"0", 'width'=>"100%"]) !!}
</div>

@include('partials.delete-modal')
@endsection
@section('script')
{!! $dataTable->scripts() !!}
@endsection
