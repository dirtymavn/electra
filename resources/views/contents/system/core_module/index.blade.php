@extends('layouts.app')

@section('title', 'Core Module')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item">Core Module</li>
</ul>
@endsection

@section('page_title', 'Core Module Lists')

@section('content')
@include('flash::message')
@if(user_info()->hasAnyAccess(['admin.company', 'core.create']))
    <a href="{{ route('core.create')}}" class="btn btn-primary" id="btn-submit">
        <i class="fa fa-plus m-right-10"></i> Add Core Module
    </a>
@endif
@if(user_info()->hasAnyAccess(['admin.company', 'core.destroy']))
    <button class="btn btn-danger" id="bulk-delete">
        <i class="fa fa-trash m-right-10"></i> Bulk Delete
    </button>
@endif
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
        spinnerLoad($('#form-currencyrate'));
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
                var id = href.split('/')[5];
                ids.push(id);
            }
        });
        
        if (ids.length > 0) {
            bulkDelete("{{ route('core.bulk-delete') }}", ids);
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
