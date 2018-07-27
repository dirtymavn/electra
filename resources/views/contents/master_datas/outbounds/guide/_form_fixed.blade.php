<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('guide_code', trans('Code'), ['class' => 'control-label']) !!}
            {!! Form::text('guide_code', $newCode , ['class' => 'form-control', 'placeholder' => 'Input the Code', 'readonly' => true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('guide_status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('guide_status', ['active' => "Active", 'non-active' => 'Non Active'], old('guide_status'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('supplier_no', trans('Supplier'), ['class' => 'control-label']) !!}
            {!! Form::select('supplier_no', ['' => "Choose Supplier"] + @$suppliers, old('supplier_no'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('guide_name_first', trans('First Name'), ['class' => 'control-label']) !!}
            {!! Form::text('guide_name_first', old('guide_name_first') , ['class' => 'form-control', 'placeholder' => 'Input the First Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('guide_name_last', trans('Last Name'), ['class' => 'control-label']) !!}
            {!! Form::text('guide_name_last', old('guide_name_last') , ['class' => 'form-control', 'placeholder' => 'Input the Last Name']) !!}
        </div>
        <div class="form-group">
            <label>&nbsp;</label>
            <button type="button" class="btn btn-info form-control btn-visa">Visa</button>
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
                                        {!! Form::label('mobile', trans('Mobile Phone'), ['class' => 'control-label']) !!}
                                        {!! Form::text('mobile', old('mobile') , ['class' => 'form-control', 'placeholder' => 'Input the Mobile Phone']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('office_addr', trans('Office Address'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('office_addr', old('office_addr') , ['class' => 'form-control', 'placeholder' => 'Input the Office Address', 'rows' => '4']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('start_date', trans('Start Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('start_date', old('start_date') , ['class' => 'form-control', 'placeholder' => 'Input the Start Date']) !!}
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
                                        {!! Form::label('home_addr', trans('Home Address'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('home_addr', old('home_addr') , ['class' => 'form-control', 'placeholder' => 'Input the Home Address', 'rows' => '4']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('expertise', trans('Expertise'), ['class' => 'control-label']) !!}
                                        {!! Form::text('expertise', old('expertise') , ['class' => 'form-control', 'placeholder' => 'Input the Expertise']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('religion', trans('Religion'), ['class' => 'control-label']) !!}
                                        {!! Form::select('religion', ['' => "Choose Religion"] + @$religions, old('religion'), ['class' => 'form-control']) !!}
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
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('gender', trans('Gender'), ['class' => 'control-label']) !!}
                                        {!! Form::select('gender', ['' => "Choose Gender", 'male' => 'Male', 'femal' => 'Female'], old('gender'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('marital_status', trans('Marital Status'), ['class' => 'control-label']) !!}
                                        {!! Form::select('marital_status', ['' => "Choose Marital Status", 'single' => 'Single', 'married' => 'Married', 'divorced' => 'Divorced'], old('marital_status'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('country_of_birth', trans('Country'), ['class' => 'control-label']) !!}
                                        {!! Form::select('country_of_birth', ['' => "Choose Country"] + @$countries, old('country_of_birth'), ['class' => 'form-control']) !!}
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
                                        {!! Form::label('id_no', trans('IC/ID No.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('id_no', old('id_no') , ['class' => 'form-control', 'placeholder' => 'Input the IC/ID No.']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality_1', trans('Nationality #1'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality_1', ['' => "Choose Nationality #1"] + @$nationalities, old('nationality_1'), ['class' => 'form-control nationality']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality_2', trans('Nationality #2'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality_2', ['' => "Choose Nationality #2"] + @$nationalities, old('nationality_2'), ['class' => 'form-control nationality']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('license_expiry_date', trans('License Expired'), ['class' => 'control-label']) !!}
                                        {!! Form::date('license_expiry_date', old('license_expiry_date') , ['class' => 'form-control', 'placeholder' => 'Input the License Expired']) !!}
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
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('passport1', trans('Passport #1'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport1', old('passport1'), ['class' => 'form-control', 'placeholder' => 'Input the Passport #1']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passport1_issue_date', trans('Issue Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('passport1_issue_date', old('passport1_issue_date') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passport1_issue_place', trans('Issue Place'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport1_issue_place', old('passport1_issue_place'), ['class' => 'form-control', 'placeholder' => 'Input the Issue Place']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passport1_expiry_date', trans('Expiry Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('passport1_expiry_date', old('passport1_expiry_date') , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('passport2', trans('Passport #2'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport2', old('passport2'), ['class' => 'form-control', 'placeholder' => 'Input the Passport #2']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passport2_issue_date', trans('Issue Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('passport2_issue_date', old('passport2_issue_date') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passport2_issue_place', trans('Issue Place'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport2_issue_place', old('passport2_issue_place'), ['class' => 'form-control', 'placeholder' => 'Input the Issue Place']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passport2_expiry_date', trans('Expiry Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('passport2_expiry_date', old('passport2_expiry_date') , ['class' => 'form-control']) !!}
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

<div id="form-visa" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">VISA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('country', trans('Country'), ['class' => 'control-label']) !!}
                            {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Input the Country']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('purpose', trans('Purpose'), ['class' => 'control-label']) !!}
                            {!! Form::text('purpose', old('purpose'), ['class' => 'form-control', 'placeholder' => 'Input the Purpose']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('entries_no', trans('Entries No.'), ['class' => 'control-label']) !!}
                            {!! Form::text('entries_no', old('entries_no'), ['class' => 'form-control', 'placeholder' => 'Input the Entries No.']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('visa_no', trans('Visa No.'), ['class' => 'control-label']) !!}
                            {!! Form::text('visa_no', old('visa_no'), ['class' => 'form-control', 'placeholder' => 'Input the Visa No.']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('visa_date', trans('Visa Date'), ['class' => 'control-label']) !!}
                            {!! Form::text('visa_date', old('visa_date'), ['class' => 'form-control', 'placeholder' => 'Input the Visa Date']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('visa_expiry', trans('Visa Expiry'), ['class' => 'control-label']) !!}
                            {!! Form::date('visa_expiry', old('visa_expiry'), ['class' => 'form-control', 'placeholder' => 'Input the Visa Expiry']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('visa_remark', trans('Visa Remark'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('visa_remark', old('visa_remark'), ['class' => 'form-control', 'placeholder' => 'Input the Visa Remark', 'rows' => '4']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('issue_country', trans('Issue Country'), ['class' => 'control-label']) !!}
                            {!! Form::text('issue_country', old('issue_country'), ['class' => 'form-control', 'placeholder' => 'Input the Issue Country']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="form-visa-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> OK
                </a>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<!-- <script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script> -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\Outbound\GuideRequest', '#form-guide') !!}
<script>
    $(function(){
        spinnerLoad($('#form-guide'));
        // @if(@$guide->id)
        //     console.log("{{ $guide->supplier_no }}");
        //     $('#supplier_no').select2().val("{{ $guide->supplier_no }}").trigger('change');
        // @endif
        initSelect2Remote($('#supplier_no'), "{{ route('supplier.search-data') }}", "Choose Supplier", 0, true);
        initSelect2Remote($('#country_of_birth'), "{{ route('country.search-data') }}", "Choose Country", 0);
        initSelect2Remote($('.nationality'), "{{ route('country.search-data-nationality') }}", "Choose Nationality", 0);
    });
    
    $(document).on('click', '.btn-visa', function(e) {
        $('#form-visa').modal('show');
        e.preventDefault();
    });
</script>
@endsection