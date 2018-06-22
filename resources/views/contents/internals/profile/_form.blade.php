<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('staff_no', trans('Staff No.'), ['class' => 'control-label']) !!}
            {!! Form::text('staff_no', old('staff_no') , ['class' => 'form-control', 'placeholder' => 'Input the Staff No.']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('staff_fullname', trans('Staff Fullname'), ['class' => 'control-label']) !!}
            {!! Form::text('staff_fullname', old('staff_fullname') , ['class' => 'form-control', 'placeholder' => 'Input the Staff Fullname']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', ['1' => 'Yes', '0' => 'No'], old('status'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
            {!! Form::text('type', old('type') , ['class' => 'form-control', 'placeholder' => 'Input the Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
            {!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Input the Title']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('home_tel', trans('Home Tel.'), ['class' => 'control-label']) !!}
            {!! Form::text('home_tel', old('home_tel') , ['class' => 'form-control', 'placeholder' => 'Input the Home Tel.']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('mobile', trans('Mobile'), ['class' => 'control-label']) !!}
            {!! Form::text('mobile', old('mobile') , ['class' => 'form-control', 'placeholder' => 'Input the Mobile']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('employment_date', trans('Employment Date'), ['class' => 'control-label']) !!}
            {!! Form::date('employment_date', old('employment_date') , ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('id_branch', trans('ID Branch'), ['class' => 'control-label']) !!}
            {!! Form::select('id_branch', ['' => 'Choose Branch'], old('id_branch'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('office_tel', trans('Office Tel.'), ['class' => 'control-label']) !!}
            {!! Form::text('office_tel', old('office_tel') , ['class' => 'form-control', 'placeholder' => 'Input the Office Tel.']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fax_no', trans('Fax No.'), ['class' => 'control-label']) !!}
            {!! Form::text('fax_no', old('fax_no') , ['class' => 'form-control', 'placeholder' => 'Input the Fax No.']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', trans('Email'), ['class' => 'control-label']) !!}
            {!! Form::text('email', old('email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('office_address', trans('Office Address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('office_address', old('office_address') , ['class' => 'form-control', 'placeholder' => 'Input the Office Address', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('home_address', trans('Home Address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('home_address', old('home_address') , ['class' => 'form-control', 'placeholder' => 'Input the Home Address', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
            {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('dr_account', trans('DR Account'), ['class' => 'control-label']) !!}
            {!! Form::text('dr_account', old('dr_account') , ['class' => 'form-control', 'placeholder' => 'Input the DR Account']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Internal\ProfileRequest', '#form-profile') !!}
<script>
    $(function(){
        spinnerLoad($('#form-profile'));
    });
</script>
@endsection