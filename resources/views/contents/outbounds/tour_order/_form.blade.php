<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('order_no', trans('Order No'), ['class' => 'control-label']) !!}
            {!! Form::text('order_no', $newCode , ['class' => 'form-control', 'placeholder' => 'Input the Order No', 'readonly' => true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('customer_id', trans('Customer'), ['class' => 'control-label']) !!}
            {!! Form::select('customer_id', ['' => 'Choose Customer'] + @$customers, old('customer_id'), ['class' => 'form-control customer_id']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('order_type', trans('Order Type'), ['class' => 'control-label']) !!}
            {!! Form::text('order_type', old('order_type') , ['class' => 'form-control', 'placeholder' => 'Input the Order Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('trip_date', trans('Trip Date'), ['class' => 'control-label']) !!}
            {!! Form::date('trip_date', old('trip_date'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('deadline', trans('Dead Line'), ['class' => 'control-label']) !!}
            {!! Form::date('deadline', old('deadline'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('your_ref', trans('Your Ref'), ['class' => 'control-label']) !!}
            {!! Form::text('your_ref', old('your_ref') , ['class' => 'form-control', 'placeholder' => 'Input the Your Ref']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('our_ref', trans('Our Ref'), ['class' => 'control-label']) !!}
            {!! Form::text('our_ref', old('our_ref') , ['class' => 'form-control', 'placeholder' => 'Input the Our Ref']) !!}
        </div>
        <div class="form-group" style="display: none;">
            {!! Form::label('tc_id', trans('TC ID'), ['class' => 'control-label']) !!}
            {!! Form::select('tc_id', ['' => '- Not Available -'], old('tc_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('master_tour_id', trans('Tour'), ['class' => 'control-label']) !!}
            {!! Form::select('master_tour_id', ['' => 'Choose Tour'] + @$tours, old('master_tour_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group" style="display: none;">
            {!! Form::label('days', trans('Days'), ['class' => 'control-label']) !!}
            {!! Form::text('days', old('days') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Days']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#main">Pack List</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="main">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary form-control btn-add-paxlist col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="paxlist" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>VIP</th>
                                                        <th>Surname</th>
                                                        <th>Given Name</th>
                                                        <!-- <th>Ptc</th> -->
                                                        <th>Title</th>
                                                        <th>Gender</th>
                                                        <th>ID No.</th>
                                                        <th>Dob</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('models')
    <!-- Form Paxlist .Start -->
    <div id="form-paxlist" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-tour-paxlist', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Pax List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="tour_paxlist_id" id="tour_paxlist_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('customer_id', trans('Customer'), ['class' => 'control-label']) !!}
                                {!! Form::select('customer_id', ['' => 'Choose Custome'] + @$customers, old('customer_id'), ['class' => 'form-control customer_id customer-paxlist']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('vip_status_flag', trans('VIP Status Flag'), ['class' => 'control-label']) !!}
                                {!! Form::select('vip_status_flag', ['1' => 'YES', '0' => 'NO'],old('vip_status_flag') , ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('surname', trans('Surname'), ['class' => 'control-label']) !!}
                                {!! Form::text('surname', old('surname') , ['class' => 'form-control', 'placeholder' => 'Input the Surname', 'readonly' => true]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('given_name', trans('Given Name'), ['class' => 'control-label']) !!}
                                {!! Form::text('given_name', old('given_name') , ['class' => 'form-control', 'placeholder' => 'Input the Given Name', 'readonly' => true]) !!}
                            </div>
                            <div class="form-group" style="display: none;">
                                {!! Form::label('ptc', trans('Ptc'), ['class' => 'control-label']) !!}
                                {!! Form::text('ptc', old('ptc') , ['class' => 'form-control', 'placeholder' => 'Input the Ptc']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
                                {!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Input the Title', 'readonly' => true]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender', trans('Gender'), ['class' => 'control-label']) !!}
                                {!! Form::text('gender', old('gender') , ['class' => 'form-control', 'placeholder' => 'Input the Gender', 'readonly' => true]) !!}
                            </div>
                            <div class="form-group" style="display: none;">
                                {!! Form::label('id_no', trans('ID No.'), ['class' => 'control-label']) !!}
                                {!! Form::text('id_no', old('id_no') , ['class' => 'form-control', 'placeholder' => 'Input the ID No.', 'readonly' => true]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('dob', trans('Dob'), ['class' => 'control-label']) !!}
                                {!! Form::date('dob', old('dob') , ['class' => 'form-control', 'placeholder' => 'Input the Dob', 'readonly' => true]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="element-wrapper">
                                <h5 class="element-header" style="margin: 0px;">Tour</h5>
                                <div class="element-box">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('return_date', trans('Return Date'), ['class' => 'control-label']) !!}
                                                {!! Form::date('return_date', old('return_date'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('deviation', trans('Deviation'), ['class' => 'control-label']) !!}
                                                {!! Form::text('deviation', old('deviation') , ['class' => 'form-control', 'placeholder' => 'Input the Deviation']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('meal', trans('Meal'), ['class' => 'control-label']) !!}
                                                {!! Form::select('meal', @$meals,old('meal') , ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                                {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('special_req', trans('Special Req.'), ['class' => 'control-label']) !!}
                                                {!! Form::textarea('special_req', old('special_req') , ['class' => 'form-control', 'placeholder' => 'Input the Special Req.', 'rows' => '4']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="os-tabs-w">
                                                <div class="os-tabs-controls">
                                                    <ul class="nav nav-tabs smaller">
                                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#accomodation">Accomodation</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#selling">Selling</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#flight">Flight</a></li>
                                                    </ul>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="tab-pane active show" id="accomodation">
                                                        <div class="element-wrapper">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('room_type', trans('Room Type'), ['class' => 'control-label']) !!}
                                                                        {!! Form::select('room_type', @$roomTypes,old('room_type') , ['class' => 'form-control']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('room_category', trans('Room Category'), ['class' => 'control-label']) !!}
                                                                        {!! Form::select('room_category', @$roomCategories,old('room_category') , ['class' => 'form-control']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('room_share', trans('Room Share'), ['class' => 'control-label']) !!}
                                                                        {!! Form::select('room_share', ['Yes' => 'Yes', 'No' => 'No'] ,old('room_share') , ['class' => 'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('room_id', trans('Room ID'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('room_id', old('room_id') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Room ID']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('adjoin_room_id', trans('Adjoin Room ID'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('adjoin_room_id', old('adjoin_room_id') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Adjoin Room ID']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="selling">
                                                        <div class="element-wrapper">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('price_type', trans('Price Type'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('price_type', old('price_type') , ['class' => 'form-control', 'placeholder' => 'Input the Price Type']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('less_total_disc', trans('Lest Total Disc.'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('less_total_disc', old('less_total_disc') , ['class' => 'form-control', 'placeholder' => 'Input the Lest Total Disc.']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('room_surcharge', trans('Room Surcharge'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('room_surcharge', old('room_surcharge') , ['class' => 'form-control', 'placeholder' => 'Input the Room Surcharge']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('tax', trans('Tax'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('tax', old('tax') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Tax']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('rebate', trans('Rebate'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('rebate', old('rebate') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Rebate']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('comm', trans('Comm'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('comm', old('comm') , ['class' => 'form-control', 'placeholder' => 'Input the Comm']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('gst', trans('GST'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('gst', old('gst') , ['class' => 'form-control', 'placeholder' => 'Input the GST']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('airline_id', trans('Airline'), ['class' => 'control-label']) !!}
                                                                        {!! Form::select('airline_id', ['' => 'Choose Airline'] + @$airlines, old('airline_id'), ['class' => 'form-control airline_id']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('ticket_no', trans('Ticket No'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ticket_no', old('ticket_no') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket No']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('register_date', trans('Register Date'), ['class' => 'control-label']) !!}
                                                                        {!! Form::date('register_date', old('register_date') , ['class' => 'form-control', 'placeholder' => 'Input the Register Date']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('currency', trans('Currency'), ['class' => 'control-label']) !!}
                                                                        {!! Form::select('currency', ['' => 'Choose Currency'] + @$currencys, old('currency'), ['class' => 'form-control']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('selling_special_req', trans('Special Req.'), ['class' => 'control-label']) !!}
                                                                        {!! Form::textarea('selling_special_req', old('selling_special_req') , ['class' => 'form-control', 'rows' => '4','placeholder' => 'Input the Special Req.']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('selling_remark', trans('Remark'), ['class' => 'control-label']) !!}
                                                                        {!! Form::textarea('selling_remark', old('selling_remark') , ['class' => 'form-control', 'rows' => '4','placeholder' => 'Input the Remark']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                {!! Form::close() !!}
                                                    <div class="tab-pane" id="flight">
                                                        <div class="element-wrapper">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-primary form-control btn-add-paxlist-flight col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-striped" id="paxlist-flight" style="width:100%;">
                                                                                <thead>
                                                                                    <tr class="text-center">
                                                                                        <th>Flight From</th>
                                                                                        <th>Flight To</th>
                                                                                        <th>Airline</th>
                                                                                        <th>Flight No</th>
                                                                                        <th>Class</th>
                                                                                        <th>Farebasis</th>
                                                                                        <th>Depart Date</th>
                                                                                        <th>Arrive Date</th>
                                                                                        <th>Status</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Form Paxlist Tour Flight .Start -->
                                                            <div id="form-paxlist-flight" class="modal fade" role="dialog">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        {!! Form::open(['id' => 'form-tour-paxlist-flight', 'method' => 'post']) !!}
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Paxlist Tour Flight</h4>
                                                                            <button type="button" class="close close-paxlist-flight"><span aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" value="" name="tour_paxlist_flight_id" id="tour_paxlist_flight_id">
                                                                            <input type="hidden" value="add" name="tour_paxlist_flight_method" id="tour_paxlist_flight_method">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('flight_from', trans('Flight From'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::select('flight_from', ['' => 'Choose Flight From'] + @$cities, old('flight_from'), ['class' => 'form-control flight-paxlist']) !!}
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('flight_to', trans('Flight To'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::select('flight_to', ['' => 'Choose Flight To'] + @$cities, old('flight_to'), ['class' => 'form-control flight-paxlist']) !!}
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('flight_airline_id', trans('Airline'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::select('flight_airline_id', ['' => 'Choose Airline'] + @$airlines, old('flight_airline_id'), ['class' => 'form-control airline_id']) !!}
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('flight_no', trans('Flight No'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::text('flight_no', old('flight_no'), ['class' => 'form-control', 'placeholder' => 'Input the Flight No']) !!}
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('class', trans('Class'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::text('class', old('class'), ['class' => 'form-control', 'placeholder' => 'Input the Class', 'readonly' => true]) !!}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('farebasis', trans('Farebasis'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::text('farebasis', old('farebasis'), ['class' => 'form-control', 'placeholder' => 'Input the Farebasis']) !!}
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('depart_date', trans('Depart Date'), ['class' => 'control-label']) !!}
                                                                                        <input type="datetime-local" name="depart_date" id="depart_date" value="{{old('depart_date')}}" class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('arrived_date', trans('Arrive Date'), ['class' => 'control-label']) !!}
                                                                                        <input type="datetime-local" name="arrived_date" id="arrived_date" value="{{old('arrived_date')}}" class="form-control" min="{{date('Y-m-d H:i')}}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                                                                                        {!! Form::select('status', [1 => 'Yes', 0 => 'No'], old('status'), ['class' => 'form-control']) !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                        <div class="modal-footer">
                                                                            <button type="button" href="#" class="btn btn-grey pull-left close-paxlist-flight"><i class="fa fa-times m-right-10"></i> Cancel</button>
                                                                            <button type="button" id="submit-paxlist-flight" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Form Paxlist Tour Flight .End -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                    </button>
                    <button type="button" id="submit-paxlist" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Paxlist .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Outbound\TourOrderRequest', '#form-tourorder') !!}
{!! JsValidator::formRequest('App\Http\Requests\Outbound\PaxListTourRequest', '#form-tour-paxlist') !!}
<script>
    $(function(){
        spinnerLoad($('#form-tourorder'));
    });

    $(document).ready(function() {
        initSelect2Remote($('.customer_id'), "{{ route('customer.search-data') }}", "Choose Customer", 0);
        initSelect2Remote($('#master_tour_id'), "{{ route('tour.search-data') }}", "Choose Tour", 0);
        initSelect2Remote($('.airline_id'), "{{ route('airline.search-data') }}", "Choose Airline", 0);
        initSelect2Remote($('#currency'), "{{ route('currencyrate.search-data') }}", "Choose Currency", 0, true);
        initSelect2Remote($('#flight_from'), "{{ route('city.search-data') }}", "Choose Flight From", 0, true);
        initSelect2Remote($('#flight_to'), "{{ route('city.search-data') }}", "Choose Flight To", 0, true);

        var columns = [
            { data: 'vip_status_flag', name: 'vip_status_flag'},
            { data: 'surname', name: 'surname'},
            { data: 'given_name', name: 'given_name'},
            // { data: 'ptc', name: 'ptc'},
            { data: 'title', name: 'title'},
            { data: 'gender', name: 'gender'},
            { data: 'id_no', name: 'id_no'},
            { data: 'dob', name: 'dob'},
            { data: 'action', name: 'action', className: 'dt-center'},
        ];

        var datas = {
            'type': 'tour-paxlist'
        };

        initDatatable($('#paxlist'), "{{route('tourorder.get-data')}}", columns, datas);

        $('#form-tour-paxlist').submit(function(e) {
            var formData = new FormData(this);
            e.preventDefault();
            $.ajax({
                url: "{{route('tourorder.paxlist.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('#form-paxlist').modal('hide');
                    $('#paxlist').DataTable().ajax.reload();
                }
            });
        });

        // submit tour flight
        $('#form-tour-paxlist-flight').submit(function(e) {
            $('div.spinner').show();
            var formData = new FormData(this);
            e.preventDefault();
            $.ajax({
                url: "{{route('tourorder.paxlist-flight.post')}}",
                method: "POST",
                processData: false,
                contentType: false,
                dataType: "JSON",
                data: formData,
                success: function(data) {
                    $('div.spinner').hide();
                    $('#paxlist-flight').DataTable().ajax.reload();
                    $('#form-paxlist-flight').modal('hide');
                    $('#form-paxlist').modal('hide');
                    setTimeout(function() {
                        $('#form-paxlist').modal({backdrop: 'static', keyboard: false});
                    }, 500)
                },
                error: function(data) {
                    $('div.spinner').hide();
                }
            });
        });
    });

    $(document).on('click', '.btn-add-paxlist', function(e) {
        $('#form-tour-paxlist').find("input[type=text], textarea, input[type=hidden], input[type=date]").val("");
        $('#form-paxlist').modal({backdrop: 'static', keyboard: false});

        var makeId = makeid();
        $('#tour_paxlist_flight_id').val(makeId);
        $('#tour_paxlist_id').val(makeId);

        initDatatable($('#paxlist-flight'), "{{route('tourorder.get-data')}}", flightColumns, FlightDatas());

        e.preventDefault();
    });

    $(document).on('click', '.deleteData', function() {
        var id = $(this).data('id');
        var element = $(this).data('element');
        deleteTempData($('#'+element), id);
        // $.ajax({
        //     url: "{{route('tourorder.data.delete')}}",
        //     method: "POST",
        //     dataType: "JSON",
        //     data: {'id':id},
        //     success: function(data) {
        //         $('#paxlist').DataTable().ajax.reload();
        //     }
        // })
    });

    function deleteTempData(element, id) {
        $.ajax({
            url: "{{route('tourorder.data.delete')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                $(element).DataTable().ajax.reload();
            }
        })
    }

    $(document).on('click', '.editData', function() {
        var id = $(this).data('id');
        var element = $(this).data('element');
        
        editTempData(element, id); 
        $('#tour_paxlist_flight_method').val('edit');
    });

    function editTempData(element, id) {
        $.ajax({
            url: "{{route('tourorder.data.detail')}}",
            method: "POST",
            dataType: "JSON",
            data: {'id':id},
            success: function(data) {
                var value = data.data.data;

                if (element == 'paxlist') {
                    $('.customer_id').select2({placeholder: 'Choose Customer', allowClear: true}).val(value.customer_id).trigger('change');
                    initSelect2Remote($('.customer_id'), "{{ route('customer.search-data') }}", "Choose Customer", 0);
                    $('#vip_status_flag').val(value.vip_status_flag);
                    $('#surname').val(value.surname);
                    $('#given_name').val(value.given_name);
                    $('#credit_card_no').val(value.credit_card_no);
                    $('#ptc').val(value.ptc);
                    $('#title').val(value.title);
                    $('#gender').val(value.gender);
                    $('#id_no').val(value.id_no);
                    $('#dob').val(value.dob);
                    $('#return_date').val(value.return_date);
                    $('#deviation').val(value.deviation);
                    $('#meal').val(value.meal);
                    $('#remark').val(value.remark);
                    $('#special_req').val(value.special_req);
                    $('#room_type').val(value.room_type);
                    $('#room_category').val(value.room_category);
                    $('#room_share').val(value.room_share);
                    $('#room_id').val(value.room_id);
                    $('#adjoin_room_id').val(value.adjoin_room_id);
                    $('#price_type').val(value.price_type);
                    $('#less_total_disc').val(value.less_total_disc);
                    $('#room_surcharge').val(value.room_surcharge);
                    $('#tax').val(value.tax);
                    $('#rebate').val(value.rebate);
                    $('#comm').val(value.comm);
                    $('#gst').val(value.gst);
                    $('#airline_id').val(value.airline_id);
                    $('#ticket_no').val(value.ticket_no);
                    $('#register_date').val(value.register_date);
                    $('#currency').val(value.currency);
                    $('#selling_special_req').val(value.selling_special_req);
                    $('#selling_remark').val(value.selling_remark);
                    $('#tour_paxlist_id').val(data.data.id);

                    initDatatable($('#paxlist-flight'), "{{route('tourorder.get-data')}}", flightColumns, FlightDatas(false));

                    $('#form-paxlist').modal({backdrop: 'static', keyboard: false});
                }

                if (element == 'paxlist-flight') {
                    $('#tour_paxlist_flight_id').val(data.data.id);
                        
                    $('#flight_from').select2({placeholder: 'Choose Flight From', allowClear: true}).val(value.flight_from_ori).trigger('change');
                    $('#flight_to').select2({placeholder: 'Choose Flight To', allowClear: true}).val(value.flight_to_ori).trigger('change');
                    $('#flight_airline_id').select2({placeholder: 'Choose Airline', allowClear: true}).val(value.flight_airline_id).trigger('change'),
                    initSelect2Remote($('.airline_id'), "{{ route('airline.search-data') }}", "Choose Airline", 0);
                    initSelect2Remote($('#flight_from'), "{{ route('city.search-data') }}", "Choose Flight From", 0, true);
                    initSelect2Remote($('#flight_to'), "{{ route('city.search-data') }}", "Choose Flight To", 0, true);
                    $('#flight_no').val(value.flight_no),
                    $('#class').val(value.class),
                    $('#farebasis').val(value.farebasis),
                    $('#depart_date').val(value.depart_date),
                    $('#arrived_date').val(value.arrived_date),
                    $('#status').val(value.status),

                    $('#form-paxlist-flight').modal({backdrop: 'static', keyboard: false});
                }

            }
        })
    }

    function associate_errors(errors, $form) {
        //remove existing error classes and error messages from form groups
        $form.find('.form-group').removeClass('has-errors').find('.help-text').text('');
        errors.foreach(function(value, index)
        {
           //find each form group, which is given a unique id based on the form field's name
            var $group = $form.find('#' + index + '-group');

            //add the error class and set the error text
            $group.addClass('has-errors').find('.help-text').text(value);
        });
    }

    // Tour Flight
    var flightColumns = [
        {data: 'flight_from_name', name: 'flight_from_name'},
        {data: 'flight_to_name', name: 'flight_to_name'},
        {data: 'flight_airline_name', name: 'flight_airline_name'},
        {data: 'flight_no', name: 'flight_no'},
        {data: 'class', name: 'class'},
        {data: 'farebasis', name: 'farebasis'},
        {data: 'depart_date', name: 'depart_date'},
        {data: 'arrived_date', name: 'arrived_date'},
        {data: 'status', name: 'status'},
        { data: 'action', name: 'action', className: 'dt-center'},
    ];

    function FlightDatas(add = true) {
        if (add) {
            return {
                'type': 'tour-paxlist-flight',
                'parent_id': $('#tour_paxlist_flight_id').val()
            };    
        } else {
            return {
                'type': 'tour-paxlist-flight',
                'parent_id': $('#tour_paxlist_id').val()
            };
        }
        
    }

    $(document).on('click', '.close-paxlist-flight', function(e) {
        $('#form-paxlist-flight').modal('hide');
        $('#form-paxlist').modal('hide');
        setTimeout(function() {
            $('#form-paxlist').modal({backdrop: 'static', keyboard: false});
        }, 500)
    });

    $(document).on('click', '.btn-add-paxlist-flight', function(e) {
        $('#form-tour-paxlist-flight').find("input[type=text], textarea, input[type=hidden]").val("");
        $('#form-paxlist-flight').modal({backdrop: 'static', keyboard: false});

        $('#tour_paxlist_flight_id').val($('#tour_paxlist_id').val());
        e.preventDefault();
    });

    $(document).on('click', '#submit-paxlist-flight', function(e) {
        $('#form-tour-paxlist-flight').submit();
    });

    $(document).on('click', '#submit-paxlist', function(e) {
        $('#form-tour-paxlist').submit();
    });


    function makeid() {
        var text = "";
        var possible = "0123456789";

        for (var i = 0; i < 4; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }


    $(document).on('click', '.btn-add-paxlist-flight', function(e) {
        $('#tour_paxlist_flight_method').val('add');
    });

    $(document).on('change', '.customer-paxlist', function() {
        var _this = $(this);
        if (_this.val() == '') {
            $('#surname').val('');
            $('#given_name').val('');
            $('#given_name').val('');
            $('#title').val('');
            $('#gender').val('');
            $('#dob').val('');
            return false;
        }

        $.ajax({
            url: "{{route('customer.get-data-by-id')}}",
            method: "get",
            dataType: "json",
            data: {id: _this.val()},
            success: function(data) {
                $('#surname').val(data.surname);
                $('#given_name').val(data.gname);
                $('#given_name').val(data.gname);
                $('#title').val(data.title);
                $('#gender').val((data.gender == 1) ? 'Male' : 'Female');
                $('#dob').val(data.dob);
            }
        });
    });

    $(document).on('change', '#flight_airline_id', function() {
        var _this = $(this);
        if (_this.val() == '') {
            $('#class').val('');
            return false;
        }

        $.ajax({
            url: "{{route('airline.get-data-by-id')}}",
            method: "get",
            dataType: "json",
            data: {id: _this.val()},
            success: function(data) {
                $('#class').val(data.airline_class);
            }
        });
    });
</script>
@endsection