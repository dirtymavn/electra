<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('do_no', trans('DO No'), ['class' => 'control-label']) !!}
            {!! Form::text('do_no', $newCode , ['class' => 'form-control', 'placeholder' => '<Auto Number>', 'readOnly' => true]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('do_type_id', trans('DO Type'), ['class' => 'control-label']) !!}
            {!! Form::select('do_type_id', ['' => 'Choose Do Type'] + @$dotypes, old('do_type_id'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('do_date', trans('DO Date'), ['class' => 'control-label']) !!}
            {!! Form::date('do_date', old('do_date') , ['class' => 'form-control', 'placeholder' => 'Input the DO Date']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('team_code', trans('Team Code'), ['class' => 'control-label']) !!}
            {!! Form::text('team_code', old('team_code') , ['class' => 'form-control', 'placeholder' => 'Input the Team Code']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sender', trans('Sender'), ['class' => 'control-label']) !!}
            {!! Form::text('sender', old('sender') , ['class' => 'form-control', 'placeholder' => 'Input the Sender']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('tel_no', trans('Tel No'), ['class' => 'control-label']) !!}
            {!! Form::text('tel_no', old('tel_no') , ['class' => 'form-control', 'placeholder' => 'Input the Tel No']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('department_code', trans('Department Code'), ['class' => 'control-label']) !!}
            {{-- {!! Form::text('department_code', old('department_code') , ['class' => 'form-control', 'placeholder' => 'Input the Department Code']) !!} --}}
            {!! Form::select('department_code', @$departmens, old('department_code'), ['class' => 'form-control', 'placeholder' => 'Choose Department']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class=""></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#customer">Delivery Order Customer</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dispatch">Delivery Order Dispatch</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="customer">
                    @include('contents.outbounds.delivery.parts.do_customer')
                </div>
                <div class="tab-pane" id="dispatch">
                    @include('contents.outbounds.delivery.parts.do_dispatch')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\DeliveryRequest', '#form-delivery') !!}
<script>
    $(function(){
        spinnerLoad($('#form-delivery'));
        initSelect2Remote($('#cust_no'), "{{ route('customer.search-data') }}", "Choose Customer", 0);
        initSelect2Remote($('#despatch_staff'), "{{ route('customer.search-data') }}", "Choose Despatch Staff", 0);
        initSelect2Remote($('#to_delivery'), "{{ route('customer.search-data') }}", "Choose To Delivery", 0);
        initSelect2Remote($('#to_collect'), "{{ route('customer.search-data') }}", "Choose To Collect", 0);
        initSelect2Remote($('#received_by'), "{{ route('customer.search-data') }}", "Choose Received By", 0);
    });
</script>

@endsection
