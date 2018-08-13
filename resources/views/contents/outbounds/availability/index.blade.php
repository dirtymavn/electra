@extends('layouts.app')

@section('title', 'Availability')

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/switch-custom.css')}}">
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item">Availability</li>
</ul>
@endsection

@section('page_title', 'Availability Lists')

@section('content')
@include('flash::message')
<?php /*<div class="row">
    <div class="col-sm-2">
        @if(user_info()->hasAnyAccess(['admin.company', 'tourfolder.create']))
            <a href="{{ route('tourfolder.create')}}" class="btn btn-primary" id="btn-submit">
                <i class="fa fa-plus m-right-10"></i> Add Availability
            </a>
        @endif
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-sm-2">
        @if(user_info()->hasAnyAccess(['admin.company', 'tourfolder.destroy']))
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
                <a class="dropdown-item" href="{{ route('export.tourfolder.excel') }}">Export XLS</a>
                <a class="dropdown-item" href="{{ route('export.tourfolder.pdf') }}">Export PDF</a>
            </div>
        </div>
    </div>
</div>*/?>
<style type="text/css">

</style>
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>
<form method="get">
<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Departure form</label>
            <div class="col-sm-8">
                <input name="datefrom" class="single-daterange form-control" placeholder="Departure" type="text" value="{{ Request::input('datefrom') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> To</label>
            <div class="col-sm-8">
                <input name="dateto" class="single-daterange form-control" placeholder="To" type="text" value="{{ Request::input('dateto') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Number of day</label>
            <div class="col-sm-8">
                <input name="dayfrom" class="form-control" placeholder="Enter day" type="number"  min="0" value="{{ Request::input('dayfrom') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> To</label>
            <div class="col-sm-8">
                <input name="dayto" class="form-control" placeholder="Enter day" type="number" min="0" value="{{ Request::input('dayto') }}">
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Price range</label>
            <div class="col-sm-8">
                <input name="pricefrom" class="form-control" type="range" name="price-min" id="price-min" value="{{ Request::input('pricefrom') }}" min="0">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> To</label>
            <div class="col-sm-8">
                <input name="priceto" class="form-control" type="range" name="price-min" id="price-min" value="{{ Request::input('priceto') }}" min="0" >
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Country</label>
            <div class="col-sm-8">
                <select class="form-control" name="country" >
                    <option>Select Country</option>
                    @foreach ($datacountries as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> City</label>
            <div class="col-sm-8">
                <select class="form-control" name="city">
                    <option value="">Select City</option>
                    @foreach ($datacities as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Tour code</label>
            <div class="col-sm-8">
                <select class="form-control" name="tourcode">
                    <option>Select Tour code</option>
                    @foreach ($datatourcode as $key => $value)
                    <option value="{{ $key }}" <?php if($key == Request::input('tourcode')){ echo 'selected';}?>>{{ $value }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Name</label>
            <div class="col-sm-8">
                <input class="form-control" placeholder="Enter name" type="text" name="nama" value="{{ Request::input('nama') }}">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Tour category</label>
            <div class="col-sm-8">
                <select class="form-control" name="tourcategory">
                    <option value="">- Choose -</option>
                    <option value="asia" <?php if(Request::input('tourcategory') == "asia"){ echo 'selected';} ?>>asia</option>
                    <option value="europe" <?php if(Request::input('tourcategory') == "europe"){ echo 'selected';} ?>>europe</option>
                    <option value="local" <?php if(Request::input('tourcategory') == "local"){ echo 'selected';} ?>>local</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Tour type</label>
            <div class="col-sm-8">
                <select class="form-control" name="tourtype">
                    <option value="">- Choose -</option>
                    <option value="elderly" <?php if(Request::input('tourtype') == "elderly"){ echo 'selected';} ?>>elderly</option>
                    <option value="shopping" <?php if(Request::input('tourtype') == "shopping"){ echo 'selected';} ?>>shopping</option>
                    <option value="ski" <?php if(Request::input('tourtype') == "ski"){ echo 'selected';} ?>>ski</option>
                    <option value="all" <?php if(Request::input('tourtype') == "all"){ echo 'selected';} ?>>all</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Airline</label>
            <div class="col-sm-8">
                <select class="form-control" name="airline">
                    <option value="">Select Airline</option>
                    @foreach ($dataairline as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-8"></div>

    <div class="col-md-12">
        <div class="form-buttons-w text-right">
            <button class="btn btn-primary" type="submit"><i class="os-icon os-icon-ui-46"></i> Cari</button>
        </div>
    </div>
</div>
</form>
<br>

<div class="table-responsive">
    
<table class="table table-lightborder">
    <thead>
        <tr>
            <th>No</th>
            <th>Tour code</th>
            <th>Tour name</th>
            <th>Airline</th>
            <th>Departure</th>
            <th>Number of days</th>
            <th>Desc Booking status</th>
            <th>Confirm</th>
            <th>waiting/available</th>
            <th>Price</th>
            <th>Status tour folder</th>
            <th>Country</th>
            <th>City</th>
            <th>Tour category</th>
            <th>Tour type</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($listdata) && count($listdata)>0) { ?>
            <?php foreach ($listdata as $key => $value) {?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td>{{ $value->tour_code }}</td>
                    <td>{{ $value->tour_name }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $value->number_of_days }}</td>
                    <td>{{ $value->status }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $value->price }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $value->tour_category }}</td>
                    <td>{{ $value->tour_type }}</td>
                    <td>{{ date('d-m-Y',strtotime($value->departure_date)) }}</td>
                    <td>{{ date('d-m-Y',strtotime($value->return_date)) }}</td>
                    <td><a target="_blank" href="{{ url("outbound/tourfolder/{$value->idtour}/edit") }}">Link</a></td>
                </tr>
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="17"><center>No Data</center></td>
            </tr>
        <?php } ?>
        
    </tbody>
</table>
</div>

@include('partials.delete-modal')
@endsection
@section('script')


<script>
    $(document).ready(function() {
        spinnerLoad($('#form-master-tourfolder'));
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
            bulkDelete("{{ route('tourfolder.bulk-delete') }}", ids);
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
