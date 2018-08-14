@extends('layouts.app')

@section('title', 'Enquiry')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item">Enquiry</li>
</ul>
@endsection

@section('page_title', 'Enquiry Lists')

@section('content')
@include('flash::message')
<form method="get">
<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Hotel name</label>
            <div class="col-sm-8">
                <input class="form-control" placeholder="Enter Hotel name" type="text" name="nama" value="{{ Request::input('nama') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Hotel chain</label>
            <div class="col-sm-8">
                <input class="form-control" placeholder="Enter Hotel chain" type="text" name="namechain" value="{{ Request::input('namechain') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Hotel Capacity</label>
            <div class="col-sm-8">
                <input class="form-control" placeholder="Enter Hotel Capacity" type="text" name="room_capacity" value="{{ Request::input('room_capacity') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Property type</label>
            <div class="col-sm-8">
              <select class="form-control" name="property_type" id="id_property_type">
                  <option value="">Select Property</option>
                  @foreach (propertytype() as $key => $value)
                  <option value="{{ $key }}" <?php if(Request::input('property_type') == $key){ echo 'selected';} ?>>{{ $value }}</option>
                  @endforeach
              </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Service name</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Enter Service" type="text" name="service_name" value="{{ Request::input('service_name') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Room type</label>
            <div class="col-sm-8">
              <input class="form-control" placeholder="Enter room type" type="text" name="room_type" value="{{ Request::input('room_type') }}">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-buttons-w text-right">
            <button class="btn btn-primary" type="submit"><i class="os-icon os-icon-ui-46"></i> Search</button>
        </div>
    </div>
</div>
</form>
<br>

<div class="table-responsive">
  <table class="table table-lightborder" >
      <thead>
          <tr>
              <th>No</th>
              <th>Hotel name</th>
              <th>Hotel chain name</th>
              <th>Capacity</th>
              <th>Property type</th>
              <th>Hotel service</th>
              <th>Room type</th>
          </tr>
      </thead>
      <tbody>
          @if (count($listdata) > 0)
              @foreach ($listdata as $value)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $value->namahotel }}</td>
                    <td>{{ $value->namachain }}</td>
                    <td>{{ $value->room_capacity }}</td>
                    <td>{{ getpropertytype($value->property_type) }}</td>
                    <td>{{ $value->service_name }}</td>
                    <td>{{ $value->room_type }}</td>
                </tr>
              @endforeach
          @else
              <tr>
                  <td colspan="7"><center>No Data</center></td>
              </tr>
          @endif
      </tbody>
  </table>
</div>

@include('partials.delete-modal')
@endsection
@section('script')


<script>
    $(document).ready(function() {
        spinnerLoad($('#form-hotel-booking'));
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
            bulkDelete("{{ route('hotel-booking.bulk-delete') }}", ids);
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
