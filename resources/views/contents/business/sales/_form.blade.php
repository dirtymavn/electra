<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sales_no', trans('Sales No'), ['class' => 'control-label']) !!}
            {!! Form::text('sales_no', old('sales_no') , ['class' => 'form-control', 'placeholder' => 'Input the Code']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('customer_id', trans('Customer'), ['class' => 'control-label']) !!}
            {!! Form::text('customer_id', old('customer_id') , ['class' => 'form-control', 'placeholder' => 'Input the Customer']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('trip_date', trans('Trip Date'), ['class' => 'control-label']) !!}
            {!! Form::date('trip_date', old('trip_date') , ['class' => 'form-control', 'placeholder' => 'Input the Trip Date']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('deadline', trans('Deadline'), ['class' => 'control-label']) !!}
            {!! Form::date('deadline', old('deadline') , ['class' => 'form-control', 'placeholder' => 'Input the Deadline']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('your_ref', trans('Your Ref'), ['class' => 'control-label']) !!}
            {!! Form::text('your_ref', old('your_ref') , ['class' => 'form-control', 'placeholder' => 'Input the Your Ref']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('our_ref', trans('Our Ref'), ['class' => 'control-label']) !!}
            {!! Form::text('our_ref', old('our_ref') , ['class' => 'form-control', 'placeholder' => 'Input the Our Ref']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('tc_id', trans('TC'), ['class' => 'control-label']) !!}
            {!! Form::text('tc_id', old('tc_id') , ['class' => 'form-control', 'placeholder' => 'Input the TC']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('invoice_no', trans('Invoice No'), ['class' => 'control-label']) !!}
            {!! Form::text('invoice_no', old('invoice_no') , ['class' => 'form-control', 'placeholder' => 'Input the Invoice No']) !!}
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
            {!! Form::number('ticket_amt', old('ticket_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket AMT']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('rebate', trans('Rebate'), ['class' => 'control-label']) !!}
            {!! Form::text('rebate', old('rebate') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#detail">Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#credit">Credit Card</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#billing">Sales Billing</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="detail">
                    @include('contents.business.sales.parts.detail')
                </div>
                <div class="tab-pane" id="credit">
                    @include('contents.business.sales.parts.credit')
                </div>
                <div class="tab-pane" id="billing">
                    @include('contents.business.sales.parts.billing')
                </div>
            </div>
        </div>
    </div>
</div>
