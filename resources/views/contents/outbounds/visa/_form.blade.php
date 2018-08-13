<div class="row">
    <div class="col-md-6">
        <?php /*<div class="form-group">
            {!! Form::label('passport_id', trans('Passport'), ['class' => 'control-label']) !!}
            {!! Form::select('passport_id', @$datapassport, old('passport_id'), ['placeholder' => 'Chosse Passport', 'class' => 'form-control passport_id']) !!}
        </div>*/?>
        <div class="form-group">
            {!! Form::label('visa_purpose', trans('Visa purpose'), ['class' => 'control-label']) !!}
            {!! Form::text('visa_purpose', old('visa_purpose') , ['class' => 'form-control', 'placeholder' => 'Input the purpose']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('visa_code', trans('Visa code'), ['class' => 'control-label']) !!}
            {!! Form::text('visa_code', old('visa_code') , ['class' => 'form-control', 'placeholder' => 'Input the code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('visa_no', trans('Visa no'), ['class' => 'control-label']) !!}
            {!! Form::text('visa_no', old('visa_no') , ['class' => 'form-control', 'placeholder' => 'Input the visa no']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('validity', trans('validity'), ['class' => 'control-label']) !!}
            {!! Form::text('validity', old('validity') , ['class' => 'form-control', 'placeholder' => 'Input the validity']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('length_of_stay', trans('Length of stay'), ['class' => 'control-label']) !!}
            {!! Form::text('length_of_stay', old('length_of_stay') , ['class' => 'form-control', 'placeholder' => 'Input the length of stay']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('length_of_stay', trans('Length of stay'), ['class' => 'control-label']) !!}
            {!! Form::number('length_of_stay', old('length_of_stay') , ['class' => 'form-control', 'placeholder' => 'Input the length_of_stay']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('no_of_entries', trans('No of entries'), ['class' => 'control-label']) !!}
            {!! Form::number('no_of_entries', old('no_of_entries') , ['class' => 'form-control', 'placeholder' => 'Input the no of entries']) !!}
        </div>
        
        


        
        
        
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('issue_date', trans('Issue date'), ['class' => 'control-label']) !!}
            {!! Form::date('issue_date', old('issue_date') , ['class' => 'form-control', 'placeholder' => 'Input the issue date']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('expiry_date', trans('Expiry date'), ['class' => 'control-label']) !!}
            {!! Form::date('expiry_date', old('expiry_date') , ['class' => 'form-control', 'placeholder' => 'Input the expiry date']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('selling_currency', trans('Selling currency'), ['class' => 'control-label']) !!}
            {!! Form::number('selling_currency', old('selling_currency') , ['class' => 'form-control', 'placeholder' => 'Input the Selling currency']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cost_currency', trans('Cost currency'), ['class' => 'control-label']) !!}
            {!! Form::number('cost_currency', old('cost_currency') , ['class' => 'form-control', 'placeholder' => 'Input the Cost currency']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cost', trans('Cost'), ['class' => 'control-label']) !!}
            {!! Form::number('cost', old('cost') , ['class' => 'form-control', 'placeholder' => 'Input the Cost']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('profit', trans('Profit'), ['class' => 'control-label']) !!}
            {!! Form::number('profit', old('profit') , ['class' => 'form-control', 'placeholder' => 'Input the profit']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
            {!! Form::text('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the remark']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::text('status', old('status') , ['class' => 'form-control', 'placeholder' => 'Input the status']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#visadocument">Visa Document</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="visadocument">
                    @include('contents.outbounds.visa.parts.visadocument')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Outbound\VisaRequest', '#form-visa') !!}
<script>
    $(function(){
        spinnerLoad($('#form-visa'));
    });
</script>

@include('contents.outbounds.visa.js.visadocument')
@endsection