<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('booking_number', trans('Booking number'), ['class' => 'control-label']) !!}
            {!! Form::text('booking_number', $newCode, [ 'class' => 'form-control', 'id' => 'booking_number', 'placeholder' => '<Auto Number>', 'readonly' => true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_hotel', trans('Hotel'), ['class' => 'control-label']) !!}
            {!! Form::select('id_hotel', ['' => 'Choose Hotel'] + @$datahotel, old('id_hotel'), ['class' => 'form-control id_hotel']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('is_group', trans('Is group'), ['class' => 'control-label']) !!}
            {!! Form::select('is_group', ['1' => 'Yes', '0' => 'No'], old('is_group'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_code', trans('Tour code'), ['class' => 'control-label']) !!}
            {!! Form::text('tour_code', old('tour_code') , ['class' => 'form-control', 'placeholder' => 'Input the Tour code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_customer', trans('Customer'), ['class' => 'control-label']) !!}
            {!! Form::select('id_customer', ['' => 'Choose Customer'] + @$datacustomer, old('id_customer'), ['class' => 'form-control id_customer']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('deal_company', trans('Deal company'), ['class' => 'control-label']) !!}
            {!! Form::select('deal_company', ['1' => 'Yes', '0' => 'No'], old('deal_company'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('contact', trans('Contact'), ['class' => 'control-label']) !!}
            {!! Form::text('contact', old('contact') , ['class' => 'form-control', 'placeholder' => 'Input the Contact']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', trans('Phone'), ['class' => 'control-label']) !!}
            {!! Form::text('phone', old('phone') , ['class' => 'form-control', 'placeholder' => 'Input the Phone']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fax', trans('Fax'), ['class' => 'control-label']) !!}
            {!! Form::text('fax', old('fax') , ['class' => 'form-control', 'placeholder' => 'Input the Fax']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('rate', trans('Rate'), ['class' => 'control-label']) !!}
            {!! Form::select('rate', ['contract' => 'contract', 'special' => 'special', 'adhoc' => 'adhoc'], old('rate'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('check_in', trans('Check in'), ['class' => 'control-label']) !!}
            {!! Form::date('check_in', old('check_in') , ['class' => 'form-control', 'placeholder' => 'Input the Check in']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('check_out', trans('Check out'), ['class' => 'control-label']) !!}
            {!! Form::date('check_out', old('check_out') , ['class' => 'form-control', 'placeholder' => 'Input the Check out']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('booking_status', trans('Booking status'), ['class' => 'control-label']) !!}
            {!! Form::text('booking_status', old('booking_status') , ['class' => 'form-control', 'placeholder' => 'Input the Booking status']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('arrival_detail', trans('Arrival detail'), ['class' => 'control-label']) !!}
            {!! Form::text('arrival_detail', old('arrival_detail') , ['class' => 'form-control', 'placeholder' => 'Input the Arrival detail']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#hotelbookingremark">Hotel Booking Remark</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#hotelbookingdetail">Hotel Booking Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#hotelbookingpax">Hotel Booking Pax</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#hotelbookingservice">Hotel Booking Service</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="hotelbookingremark">
                    @include('contents.hotels.hotel_booking.parts.hotelbookingremark')
                </div>
                <div class="tab-pane" id="hotelbookingdetail">
                    @include('contents.hotels.hotel_booking.parts.hotelbookingdetail')
                </div>
                <div class="tab-pane" id="hotelbookingpax">
                    @include('contents.hotels.hotel_booking.parts.hotelbookingpax')
                </div>
                <div class="tab-pane" id="hotelbookingservice">
                    @include('contents.hotels.hotel_booking.parts.hotelbookingservice')
                </div>
            </div>
        </div>
    </div>
</div>


@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Hotel\HotelBookingRequest', '#form-hotelbooking') !!}
<script>
    $(function(){
        spinnerLoad($('#form-hotelbooking'));
        initSelect2Remote($('.id_hotel'), "{{ route('master-hotel.search-data') }}", "Choose hotel", 0);
        initSelect2Remote($('.id_customer'), "{{ route('customer.search-data') }}", "Choose customer", 0);
        initSelect2Remote($('.id_nationality'), "{{ route('country.search-data') }}", "Choose country", 0);
    });
</script>

@include('contents.hotels.hotel_booking.js.hotelbookingdetail')
@include('contents.hotels.hotel_booking.js.hotelbookingpax')
@include('contents.hotels.hotel_booking.js.hotelbookingservice')
@endsection