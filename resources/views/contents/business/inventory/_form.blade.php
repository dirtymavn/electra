<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('trx_sales_id', trans('Trx Sales'), ['class' => 'control-label']) !!}
            {!! Form::select('trx_sales_id', ['' => "Choose Trx Sales"], old('trx_sales_id'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('inventory_type', trans('Inventory Type'), ['class' => 'control-label']) !!}
            {!! Form::text('inventory_type', old('inventory_type') , ['class' => 'form-control', 'placeholder' => 'Input the Code']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('voucher_no', trans('Voucher No'), ['class' => 'control-label']) !!}
            {!! Form::text('voucher_no', old('voucher_no') , ['class' => 'form-control', 'placeholder' => 'Input the Voucher']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
            {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('qty', trans('Qty'), ['class' => 'control-label']) !!}
            {!! Form::number('qty', old('qty') , ['class' => 'form-control', 'placeholder' => 'Input the Qty']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('booked_qty', trans('Booked Qty'), ['class' => 'control-label']) !!}
            {!! Form::number('booked_qty', old('booked_qty') , ['class' => 'form-control', 'placeholder' => 'Input the Booked Qty']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('sold_qty', trans('Sold Qty'), ['class' => 'control-label']) !!}
            {!! Form::number('sold_qty', old('sold_qty') , ['class' => 'form-control', 'placeholder' => 'Input the Sold Qty']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('received_date', trans('Received Date'), ['class' => 'control-label']) !!}
            {!! Form::text('received_date', old('received_date') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('guest_name', trans('Guest Name'), ['class' => 'control-label']) !!}
            {!! Form::text('guest_name', old('guest_name') , ['class' => 'form-control', 'placeholder' => 'Input the Guest Name']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('iata_no', trans('Iata No'), ['class' => 'control-label']) !!}
            {!! Form::text('iata_no', old('iata_no') , ['class' => 'form-control', 'placeholder' => 'Input the Iata No']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tour_code', trans('Tour Code'), ['class' => 'control-label']) !!}
            {!! Form::text('tour_code', old('tour_code') , ['class' => 'form-control', 'placeholder' => 'Input the Tour Code']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('coupon_no', trans('Coupon No'), ['class' => 'control-label']) !!}
            {!! Form::text('coupon_no', old('coupon_no') , ['class' => 'form-control', 'placeholder' => 'Input the Tour Code']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('nights', trans('Night'), ['class' => 'control-label']) !!}
            {!! Form::text('nights', old('nights') , ['class' => 'form-control', 'placeholder' => 'Input the Night']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('rooms', trans('Tour Code'), ['class' => 'control-label']) !!}
            {!! Form::text('rooms', old('rooms') , ['class' => 'form-control', 'placeholder' => 'Input the Room']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#transport">Transport</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cost">Cost</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#misc">Route Misc</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pkg">Route PKG</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#car">Route Car</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#car_tf">Route Car Transfer</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#car_air">Route Car Air</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#hotel">Route Hotel</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="cost">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
                                        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('category', trans('Category'), ['class' => 'control-label']) !!}
                                                {!! Form::select('category', ['' => "Choose Category"], old('category'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('city_code', trans('City Code'), ['class' => 'control-label']) !!}
                                                {!! Form::select('city_code', ['' => "Choose City Code"], old('city_code'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
                                                {!! Form::select('type', ['' => "Choose Type"], old('type'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('airline', trans('Airline'), ['class' => 'control-label']) !!}
                                        {!! Form::select('airline', ['' => "Choose Airline"], old('airline'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality', trans('Nationality'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality', ['' => "Choose Nationality"], old('nationality'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Description', 'rows' => 5]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('min_cap', trans('Min. Cap.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('min_cap', old('min_cap') , ['class' => 'form-control', 'placeholder' => 'Input the Min. Cap.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('max_cap', trans('Max. Cap.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('max_cap', old('max_cap') , ['class' => 'form-control', 'placeholder' => 'Input the Max. Cap.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('validity_from', trans('Validity From'), ['class' => 'control-label']) !!}
                                        {!! Form::date('validity_from', old('validity_from'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('validity_end', trans('Validity End'), ['class' => 'control-label']) !!}
                                        {!! Form::date('validity_end', old('validity_end'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('depature', trans('Depature'), ['class' => 'control-label']) !!}
                                        {!! Form::select('depature', ['' => "Choose Depature", '1' => 'Daily', '2' => 'Only on day of week', '3' => 'Only on the following date'], old('depature'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('no_of_day', trans('No. of Days'), ['class' => 'control-label']) !!}
                                        {!! Form::text('no_of_day', old('no_of_day') , ['class' => 'form-control', 'placeholder' => 'Input the No. of Days']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('cutoff_day', trans('Cutoff Days'), ['class' => 'control-label']) !!}
                                        {!! Form::text('cutoff_day', old('cutoff_day') , ['class' => 'form-control', 'placeholder' => 'Input the Cutoff Days']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('only_on_week', trans('The Day of Week'), ['class' => 'control-label']) !!}
                                        {!! Form::select('only_on_week[]', ['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'], old('only_on_week'), ['class' => 'form-control', 'multiple' => true, 'id' => 'only_on_week']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('only_on_date', trans('Following Date'), ['class' => 'control-label']) !!}
                                        {!! Form::select('only_on_date[]', ['25/01/18' => '25/01/18'], old('only_on_date'), ['class' => 'form-control', 'multiple' => true, 'id' => 'only_on_date']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => 5]) !!}
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

@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Master\CompanyRequest', '#form-company') !!}
<script>
    $(document).ready(function() {
        initSelect2($('#only_on_week'), 'Select The Day of Week');
        initSelect2($('#only_on_date'), 'Select The Following Date');
    });
</script>
@endsection