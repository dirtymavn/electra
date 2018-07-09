<div class="steps-w">
    <div class="step-triggers smaller">
        <a class="step-trigger active" href="#stepContent1">Sales Detail </a>
        <a class="step-trigger" href="#stepContent2">Routing </a>
        <a class="step-trigger" href="#stepContent3">Mis </a>
        <a class="step-trigger" href="#stepContent4">Cost </a>
        <a class="step-trigger" href="#stepContent5">Price </a>
        <a class="step-trigger" href="#stepContent6">Segments </a>
    </div>
    <div class="step-contents">
        <div class="step-content active" id="stepContent1">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
                        {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code', 'id' => 'product_code']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('passenger_class_code', trans('Passenger Class Code'), ['class' => 'control-label']) !!}
                        {!! Form::text('passenger_class_code', old('passenger_class_code') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Class Code', 'id' => 'hotel_name']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('is_group_flag', trans('Is Group Flag'), ['class' => 'control-label']) !!}
                        {!! Form::select('is_group_flag', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_group_flag'), ['class' => 'form-control', 'placeholder' => 'Choose Group Flag']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('is_supperss_flag', trans('Is Supperss Flag'), ['class' => 'control-label']) !!}
                        {!! Form::select('is_supperss_flag', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_supperss_flag'), ['class' => 'form-control', 'placeholder' => 'Choose Supperss Flag']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('is_pax_sup', trans('Is Pax Sup'), ['class' => 'control-label']) !!}
                        {!! Form::select('is_pax_sup', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_pax_sup'), ['class' => 'form-control', 'placeholder' => 'Choose Pax Sup']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('is_group_item', trans('Is Group Item'), ['class' => 'control-label']) !!}
                        {!! Form::select('is_group_item', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_group_item'), ['class' => 'form-control', 'placeholder' => 'Choose Group Item']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('pnr_no', trans('Pnr No'), ['class' => 'control-label']) !!}
                        {!! Form::text('pnr_no', old('pnr_no') , ['class' => 'form-control', 'placeholder' => 'Input the Pnr No', 'id' => 'pnr_no']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('dk_no', trans('DK No'), ['class' => 'control-label']) !!}
                        {!! Form::text('dk_no', old('dk_no') , ['class' => 'form-control', 'placeholder' => 'Input the DK No', 'id' => 'dk_no']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('airline_form', trans('Airline Form'), ['class' => 'control-label']) !!}
                        {!! Form::text('airline_form', old('airline_form') , ['class' => 'form-control', 'placeholder' => 'Input the Airline Form', 'id' => 'airline_form']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('sales_type', trans('Sales Type'), ['class' => 'control-label']) !!}
                        {!! Form::text('sales_type', old('sales_type') , ['class' => 'form-control', 'placeholder' => 'Input the Sales Type', 'id' => 'sales_type']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('confirm_by', trans('Confirm By'), ['class' => 'control-label']) !!}
                        {!! Form::text('confirm_by', old('confirm_by') , ['class' => 'form-control', 'placeholder' => 'Input the Confirm By', 'id' => 'confirm_by']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('confirm_date', trans('Confirm Date'), ['class' => 'control-label']) !!}
                        {!! Form::date('confirm_date', old('confirm_date') , ['class' => 'form-control', 'placeholder' => 'Input the Confirm Date', 'id' => 'confirm_date']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('mpd_no', trans('MPD No'), ['class' => 'control-label']) !!}
                        {!! Form::text('mpd_no', old('mpd_no') , ['class' => 'form-control', 'placeholder' => 'Input the MPD No', 'id' => 'mpd_no']) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('sales_detail_remark', trans('Sales Detail Remark'), ['class' => 'control-label']) !!}
                        {!! Form::textarea('sales_detail_remark', old('sales_detail_remark') , ['class' => 'form-control', 'placeholder' => 'Input the Sales Detail Remark','rows' => '3x6', 'id' => 'sales_detail_remark']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="step-content" id="stepContent2">
            @include('contents.business.sales.parts.detail_routing')
        </div>
        <div class="step-content" id="stepContent3">
            @include('contents.business.sales.parts.mis')
        </div>
        <div class="step-content" id="stepContent4">
            @include('contents.business.sales.parts.cost')
        </div>
        <div class="step-content" id="stepContent5">
            @include('contents.business.sales.parts.price')
        </div>
        <div class="step-content" id="stepContent6">
            @include('contents.business.sales.parts.passenger')
        </div>
    </div>
</div>

@section('sales_js')
@include('contents.business.sales.js.routing')
@include('contents.business.sales.js.mis')
@include('contents.business.sales.js.cost')
@endsection