<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            {!! Form::label('code', trans('Code'), ['class' => 'control-label']) !!}
            {!! Form::text('code', old('code') , ['class' => 'form-control', 'placeholder' => 'Input the Code']) !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            <button type="button" class="btn btn-primary form-control" disabled="disabled">Active</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('supplier_no', trans('Supplier'), ['class' => 'control-label']) !!}
            {!! Form::select('supplier_no', ['' => "Choose Supplier"], old('supplier_no'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
            <div class="row">
                <div class="col-md-10">
                    {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary form-control">Visa</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#main">Main</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#basic">Basic</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="main">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('job_title', trans('Job Title'), ['class' => 'control-label']) !!}
                                        {!! Form::text('job_title', old('job_title') , ['class' => 'form-control', 'placeholder' => 'Input the Job Title']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('home_tel', trans('Home Tel.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('home_tel', old('home_tel') , ['class' => 'form-control', 'placeholder' => 'Input the Home Tel.']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('mobile_phone', trans('Mobile Phone'), ['class' => 'control-label']) !!}
                                        {!! Form::text('mobile_phone', old('mobile_phone') , ['class' => 'form-control', 'placeholder' => 'Input the Mobile Phone']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('office_address', trans('Office Address'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('office_address', old('office_address') , ['class' => 'form-control', 'placeholder' => 'Input the Office Address', 'rows' => '4']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('modified_date', trans('Modified Date'), ['class' => 'control-label']) !!}
                                        {!! Form::text('modified_date', old('modified_date') , ['class' => 'form-control', 'placeholder' => 'Input the Modified Date']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('modified_by', trans('Modified By'), ['class' => 'control-label']) !!}
                                        {!! Form::text('modified_by', old('modified_by') , ['class' => 'form-control', 'placeholder' => 'Input the Modified By']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                        {!! Form::email('email', old('email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('home_address', trans('Home Address'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('home_address', old('home_address') , ['class' => 'form-control', 'placeholder' => 'Input the Home Address', 'rows' => '4']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('since_date', trans('Being Tour Guide Since'), ['class' => 'control-label']) !!}
                                        <div class="row">
                                            <div class="col-md-9">
                                                {!! Form::date('since_date', old('since_date') , ['class' => 'form-control', 'placeholder' => 'Input the Being Tour Guide Since']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::text('since_year', old('since_year') , ['class' => 'form-control', 'placeholder' => 'Year of Exp.']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('expertise', trans('Expertise'), ['class' => 'control-label']) !!}
                                        {!! Form::text('expertise', old('expertise') , ['class' => 'form-control', 'placeholder' => 'Input the Expertise']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('expertise', trans('Expertise'), ['class' => 'control-label']) !!}
                                        {!! Form::select('expertise', ['' => "-"], old('expertise'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('religion', trans('Religion'), ['class' => 'control-label']) !!}
                                        {!! Form::select('religion', ['' => "-"], old('religion'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('language', trans('Language'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('language', old('language') , ['class' => 'form-control', 'placeholder' => 'Input the Language', 'rows' => '4']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="basic">
                    <div class="element-wrapper">
                        <h3 class="element-header">Basic Information</h3>
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('gender', trans('Gender'), ['class' => 'control-label']) !!}
                                        {!! Form::select('gender', ['' => "Choose Gender", 'male' => 'Male', 'femal' => 'Female'], old('gender'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('marital_status', trans('Marital Status'), ['class' => 'control-label']) !!}
                                        {!! Form::select('marital_status', ['' => "Choose Marital Status"], old('marital_status'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('country_of_birth', trans('Country'), ['class' => 'control-label']) !!}
                                        {!! Form::select('country_of_birth', ['' => "Choose Country"], old('country_of_birth'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('date_of_birth', trans('Date of Birth'), ['class' => 'control-label']) !!}
                                        {!! Form::date('date_of_birth', old('date_of_birth') , ['class' => 'form-control', 'placeholder' => 'Input the Date of Birth']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('license_no', trans('License No.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('license_no', old('license_no') , ['class' => 'form-control', 'placeholder' => 'Input the License No.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('ic_id_no', trans('IC/ID No.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('ic_id_no', old('ic_id_no') , ['class' => 'form-control', 'placeholder' => 'Input the IC/ID No.']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality_1', trans('Nationality #1'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality_1', ['' => "Choose Nationality #1"], old('nationality_1'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality_2', trans('Nationality #2'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality_2', ['' => "Choose Nationality #2"], old('nationality_2'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('license_expired', trans('License Expired'), ['class' => 'control-label']) !!}
                                        {!! Form::date('license_expired', old('license_expired') , ['class' => 'form-control', 'placeholder' => 'Input the License Expired']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="element-wrapper">
                        <h3 class="element-header">Documents</h3>
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('exit_permit_no', trans('Exit Permit No.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('exit_permit_no', old('exit_permit_no'), ['class' => 'form-control', 'placeholder' => 'Input the Exit Permit No.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('exit_permit_expired', trans('Exit Permit Expired Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('exit_permit_expired', old('exit_permit_expired') , ['class' => 'form-control', 'placeholder' => 'Input the Exit Permit Expired']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('passport_1', trans('Passport #1'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport_1', old('passport_1'), ['class' => 'form-control', 'placeholder' => 'Input the Passport #1']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('passport_2', trans('Passport #2'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport_2', old('passport_2'), ['class' => 'form-control', 'placeholder' => 'Input the Passport #2']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('issue_date_pass_1', trans('Issue Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('issue_date_pass_1', old('issue_date_pass_1') , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('issue_date_pass_2', trans('Issue Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('issue_date_pass_2', old('issue_date_pass_2') , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('issue_palace_pass_1', trans('Issue Palace'), ['class' => 'control-label']) !!}
                                        {!! Form::text('issue_palace_pass_1', old('issue_palace_pass_1'), ['class' => 'form-control', 'placeholder' => 'Input the Issue Palace']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('issue_palace_pass_2', trans('Issue Palace'), ['class' => 'control-label']) !!}
                                        {!! Form::text('issue_palace_pass_2', old('issue_palace_pass_2'), ['class' => 'form-control', 'placeholder' => 'Input the Issue Palace']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('expiry_date_pass_1', trans('Expiry Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('expiry_date_pass_1', old('expiry_date_pass_1') , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('expiry_date_pass_2', trans('Expiry Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('expiry_date_pass_2', old('expiry_date_pass_2') , ['class' => 'form-control']) !!}
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
@endsection