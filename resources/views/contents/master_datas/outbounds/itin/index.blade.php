@extends('layouts.app')

@section('title', 'Itinerary')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item">Itinerary</li>
</ul>
@endsection

@section('page_title', 'Itinerary Lists')

@section('content')
@include('flash::message')
<div class="row">
    <div class="col-sm-2">
        @if(user_info()->hasAnyAccess(['admin.company', 'itin.create']))
            <a href="{{ route('itin.create')}}" class="btn btn-primary" id="btn-submit">
                <i class="fa fa-plus m-right-10"></i> Add Itinerary
            </a>
        @endif
    </div>
    <div class="col-sm-2">
        @if(user_info()->hasAnyAccess(['admin.company', 'itin.destroy']))
            <button class="btn btn-danger" id="bulk-delete">
                <i class="fa fa-trash m-right-10"></i> Bulk Delete
            </button>
        @endif
    </div>
    <div class="col-sm-3">
        <div class="dropdown">
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('export.itin.excel') }}">Export XLS</a>
                <a class="dropdown-item" href="{{ route('export.itin.pdf') }}">Export PDF</a>
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

<script>
    $(document).ready(function() {
        spinnerLoad($('#form-itin'));
    });

    $(document).on('click', '#bulk-delete', function() {
        var lengthChecked = $('td .checklist:checked').length;
        var ids = [];
        if (lengthChecked <= 0) {
            alert('Please checklist one or more data');
            return false;
        }
        
        $('td .checklist').each(function(i, obj) {
            if ($('td .checklist').eq(i).is(':checked')) {
                var href = $('td.row-actions').eq(i).find('.deleteData').data('href');
                var id = href.split('/')[6];
                ids.push(id);
            }
        });
        
        if (ids.length > 0) {
            bulkDelete("{{ route('itin.bulk-delete') }}", ids);
        } else {
            alert('Something went wrong!');
            return false;
        }
    });

    $(document).on('click', 'th .checklist', function() {
        if ($(this).is(':checked')) {
            $('td .checklist').prop('checked', true);
        } else {
            $('td .checklist').prop('checked', false);
        }
    });

    $(document).on('click', 'td .checklist', function() {
        var lengthChecked = $('td .checklist:checked').length;
        var lengthCeckbox = $('td .checklist').length;

        if (lengthChecked == lengthCeckbox) {
            $('th .checklist').prop('checked', true);
        } else {
            $('th .checklist').prop('checked', false);
        }
    });
</script>
@endsection
