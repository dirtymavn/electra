{{-- <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('invoice_no', trans('Invoice No'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_no', old('invoice_no') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Code']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sales_date', trans('Sales Date'), ['class' => 'control-label']) !!}
            {!! Form::date('sales_date', old('sales_date') , ['class' => 'form-control', 'placeholder' => 'Input the Sales Date']) !!}
        </div>        
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('ticket_amt', trans('Ticket Amt'), ['class' => 'control-label']) !!}
            {!! Form::number('ticket_amt', old('ticket_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket Amt']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('rebate', trans('Rebate'), ['class' => 'control-label']) !!}
            {!! Form::number('rebate', old('rebate') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate']) !!}
        </div>
    </div>
</div>
<hr> --}}
<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            {!! Form::label('inventory_type', trans('Inventory Type'), ['class' => 'control-label']) !!}
            {!! Form::select('inventory_type_id', @$inventoryTypes, old('inventory_type_id'), ['class' => 'form-control', 'id' => 'inventory_type_id']) !!}
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
        <div class="form-group">
            {!! Form::label('received_date', trans('Received Date'), ['class' => 'control-label']) !!}
            {!! Form::date('received_date', old('received_date') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            {!! Form::label('trx_sales_id', trans('Sales'), ['class' => 'control-label']) !!}
            {!! Form::select('trx_sales_id', @$sales, old('trx_sales_id'), ['class' => 'form-control']) !!}
        </div>

        {{-- <div class="form-group">
            {!! Form::label('guest_name', trans('Guest Name'), ['class' => 'control-label']) !!}
            {!! Form::text('guest_name', old('guest_name') , ['class' => 'form-control', 'placeholder' => 'Input the Guest Name']) !!}
        </div> --}}

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
            {!! Form::text('nights', old('nights') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Night']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('rooms', trans('Room'), ['class' => 'control-label']) !!}
            {!! Form::text('rooms', old('rooms') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Room']) !!}
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
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pkg">Route Package</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#car">Route Car</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#car_tf">Route Car Transfer</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#car_air">Route Air</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#hotel">Route Hotel</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="transport">
                    @include('contents.master_datas.inventory.parts.transport')
                </div>
                <div class="tab-pane" id="cost">
                    @include('contents.master_datas.inventory.parts.cost')
                </div>
                <div class="tab-pane" id="misc">
                    @include('contents.master_datas.inventory.parts.misc')
                </div>
                <div class="tab-pane" id="pkg">
                    @include('contents.master_datas.inventory.parts.pkg')
                </div>
                <div class="tab-pane" id="car">
                    @include('contents.master_datas.inventory.parts.car')
                </div>
                <div class="tab-pane" id="car_tf">
                    @include('contents.master_datas.inventory.parts.car_transfer')
                </div>
                <div class="tab-pane" id="car_air">
                    @include('contents.master_datas.inventory.parts.air')
                </div>
                <div class="tab-pane" id="hotel">
                    @include('contents.master_datas.inventory.parts.hotel')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\InventoryRequest', '#form-inventory') !!}
<script>
    $(function(){
        spinnerLoad($('#form-inventory'));
        initSelect2Remote($('#supplier_no'), "{{ route('supplier.search-data') }}", "Choose Supplier No", 0);
        initSelect2Remote($('#inventory_type_id'), "{{ route('inventory-type.search-data') }}", "Choose inventory type", 0);
        initSelect2Remote($('#airline_no'), "{{ route('airline.search-data') }}", "Choose Airline", 0);
    });
</script>

@include('contents.master_datas.inventory.js.misc')
@include('contents.master_datas.inventory.js.pkg')
@include('contents.master_datas.inventory.js.car')
@include('contents.master_datas.inventory.js.car_transfer')
@include('contents.master_datas.inventory.js.route_air')
@include('contents.master_datas.inventory.js.route_hotel')
@endsection