<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sales_no', trans('Sales No'), ['class' => 'control-label']) !!}
            {!! Form::text('sales_no', $newCode , ['class' => 'form-control', 'placeholder' => '<Auto Number>', 'readonly' => true]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('customer_id', trans('Customer'), ['class' => 'control-label']) !!}
            {!! Form::select('customer_id', ['' => 'Choose Customer'], old('customer_id'), ['class' => 'form-control', 'id' => 'cust_no']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('trip_date', trans('Trip Date'), ['class' => 'control-label']) !!}
            {!! Form::date('trip_date', old('trip_date') , ['class' => 'form-control', 'placeholder' => 'Input the Trip Date']) !!}
        </div>
    </div>
    {{-- <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('deadline', trans('Deadline'), ['class' => 'control-label']) !!}
            {!! Form::date('deadline', old('deadline') , ['class' => 'form-control', 'placeholder' => 'Input the Deadline']) !!}
        </div>
    </div> --}}
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('your_ref', trans('Your Ref'), ['class' => 'control-label']) !!}
            {!! Form::text('your_ref', old('your_ref') , ['class' => 'form-control', 'placeholder' => 'Input the Your Ref']) !!}
        </div>
    </div>
    {{-- <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('our_ref', trans('Our Ref'), ['class' => 'control-label']) !!}
            {!! Form::text('our_ref', old('our_ref') , ['class' => 'form-control', 'placeholder' => 'Input the Our Ref']) !!}
        </div>
    </div> --}}
    {{-- <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('tc_id', trans('TC'), ['class' => 'control-label']) !!}
            {!! Form::text('tc_id', old('tc_id') , ['class' => 'form-control', 'placeholder' => 'Input the TC']) !!}
        </div>
    </div> --}}
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('invoice_no', trans('Invoice No'), ['class' => 'control-label']) !!}
            {!! Form::number('invoice_no', old('invoice_no') , ['class' => 'form-control', 'placeholder' => 'Input the Invoice No']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sales_date', trans('Sales Date'), ['class' => 'control-label']) !!}
            {!! Form::date('sales_date', old('sales_date') , ['class' => 'form-control', 'placeholder' => 'Input the Sales Date']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('ticket_amt', trans('Ticket AMT'), ['class' => 'control-label']) !!}
            {!! Form::text('ticket_amt', old('ticket_amt') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Ticket AMT']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('rebate', trans('Rebate'), ['class' => 'control-label']) !!}
            {!! Form::text('rebate', old('rebate') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Rebate']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#credit">Credit Card</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#billing">Sales Billing</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#detail">Detail</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#routing">Detail Routing</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#mis">Detail Mis</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cost">Detail Cost</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#price">Detail Price</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#segment">Detail Segments</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#passenger">Detail Passenger</a></li>
                     --}}
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="credit">
                    @include('contents.business.sales.parts.credit')
                </div>
                <div class="tab-pane" id="billing">
                    @include('contents.business.sales.parts.billing')
                </div>
                <div class="tab-pane" id="detail">
                    @include('contents.business.sales.parts.detail')
                </div>
                {{-- <div class="tab-pane" id="routing">
                    @include('contents.business.sales.parts.detail_routing')
                </div>
                <div class="tab-pane" id="mis">
                    @include('contents.business.sales.parts.mis')
                </div>
                <div class="tab-pane" id="cost">
                    @include('contents.business.sales.parts.cost')
                </div>
                <div class="tab-pane" id="price">
                    @include('contents.business.sales.parts.price')
                </div>
                <div class="tab-pane" id="segment">
                    @include('contents.business.sales.parts.segment')
                </div>
                <div class="tab-pane" id="segment">
                    @include('contents.business.sales.parts.segment')
                </div>
                <div class="tab-pane" id="segment">
                    @include('contents.business.sales.parts.passenger')
                </div> --}}
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\SalesRequest', '#form-sales') !!}
<script>
    $(function(){
        spinnerLoad($('#form-sales'));
        initSelect2Remote($('#cust_no'), "{{ route('customer.search-data') }}", "Choose Customer", 0);
        initSelect2Remote($('#employee_no'), "{{ route('customer.search-data') }}", "Choose Employee", 0);
    });
</script>

@include('contents.business.sales.js.detail')
@yield('sales_js')
@endsection
