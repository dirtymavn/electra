<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('do_no', trans('DO No'), ['class' => 'control-label']) !!}
            {!! Form::text('do_no', old('do_no') , ['class' => 'form-control', 'placeholder' => 'Input the DO No']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('do_type_id', trans('DO Type'), ['class' => 'control-label']) !!}
            {!! Form::text('do_type_id', old('do_type_id') , ['class' => 'form-control', 'placeholder' => 'Input the DO Type']) !!}
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
            {!! Form::text('department_code', old('department_code') , ['class' => 'form-control', 'placeholder' => 'Input the Department Code']) !!}
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
                    @include('contents.business.delivery.parts.do_customer')
                </div>
                <div class="tab-pane" id="dispatch">
                    @include('contents.business.delivery.parts.do_dispatch')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\SalesRequest', '#form-delivery') !!}
<script>
    $(function(){
        spinnerLoad($('#form-delivery'));
    });
</script>

@endsection