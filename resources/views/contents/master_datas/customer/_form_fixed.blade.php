<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('customer_no', trans('Customer No.'), ['class' => 'control-label']) !!}
            {!! Form::text('customer_no', old('customer_no') , ['class' => 'form-control', 'placeholder' => 'Input the Customer No.']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('customer_name', trans('Customer Name'), ['class' => 'control-label']) !!}
            {!! Form::text('customer_name', old('customer_name') , ['class' => 'form-control', 'placeholder' => 'Input the Customer Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('company_id', trans('Company Name'), ['class' => 'control-label']) !!}
            {!! Form::select('company_id', $companies, old('status'), ['class' => 'form-control', 'placeholder' => 'Select Company Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'In Active', 'suspend' => 'Suspend'], old('status'), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('salutation', trans('Salutation'), ['class' => 'control-label']) !!}
            {!! Form::select('salutation', ['mr' => 'MR.', 'mrs' => 'Mrs.'], old('salutation'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sales_id', trans('Sales ID'), ['class' => 'control-label']) !!}
            {!! Form::select('sales_id', ['' => 'Choose Sales'], old('sales_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('customer_group_id', trans('Customer Group'), ['class' => 'control-label']) !!}
            {!! Form::select('customer_group_id', ['' => 'Choose Customer Group'], old('customer_group_id'), ['class' => 'form-control']) !!}
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
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#general">General</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#disc_rate">Discount Rate</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#credit_card">Credit Card</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#termfee">Term Fee</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="main">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('servicing_branch_id', trans('Servicing Branch'), ['class' => 'control-label']) !!}
                                        {!! Form::select('servicing_branch_id', ['' => 'Choose Servicing Branch'], old('servicing_branch_id'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rpt_grp_id', trans('Rpt Grp'), ['class' => 'control-label']) !!}
                                        {!! Form::select('rpt_grp_id', ['' => 'Choose Rpt Grp'], old('rpt_grp_id'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('cust_type_id', trans('Cust. Type'), ['class' => 'control-label']) !!}
                                        {!! Form::select('cust_type_id', ['fit' => 'FIT', 'agent' => 'Agent', 'commercial' => 'Commercial'], old('cust_type_id'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('mailing_address', trans('Mailing Address'), ['class' => 'control-label']) !!}
                                        {!! Form::text('mailing_address', old('mailing_address') , ['class' => 'form-control', 'placeholder' => 'Input the Mailing Address']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('billing_address', trans('Billing Address'), ['class' => 'control-label']) !!}
                                        {!! Form::text('billing_address', old('billing_address') , ['class' => 'form-control', 'placeholder' => 'Input the Billing Address']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('office_address', trans('Office Address'), ['class' => 'control-label']) !!}
                                        {!! Form::select('office_address', ['mailing' => 'Mailing', 'billing' => 'Billing'], old('office_address') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('travel_policy', trans('Travel Policy'), ['class' => 'control-label']) !!}
                                        {!! Form::text('travel_policy', old('travel_policy') , ['class' => 'form-control', 'placeholder' => 'Input the Travel Policy']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-wrapper">
                        <h5 class="element-header">Contact</h5>
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('contact_type', trans('Contact Type'), ['class' => 'control-label']) !!}
                                        {!! Form::select('contact_type', ['contact' => 'Contact', 'passenger' => 'Passenger'], old('contact_type'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('surname', trans('Surname'), ['class' => 'control-label']) !!}
                                        {!! Form::text('surname', old('surname') , ['class' => 'form-control', 'placeholder' => 'Input the Surname']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('gname', trans('Gname'), ['class' => 'control-label']) !!}
                                        {!! Form::text('gname', old('gname') , ['class' => 'form-control', 'placeholder' => 'Input the Gname']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
                                        {!! Form::select('title', ['mr' => 'Mr.', 'mrs' => 'Mrs.', 'msl' => 'Msl.'], old('contact_type'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('office_phone', trans('Office Phone'), ['class' => 'control-label']) !!}
                                        {!! Form::number('office_phone', old('office_phone') , ['class' => 'form-control', 'placeholder' => 'Input the Office Phone']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('home_phone', trans('Home Phone'), ['class' => 'control-label']) !!}
                                        {!! Form::number('home_phone', old('home_phone') , ['class' => 'form-control', 'placeholder' => 'Input the Home Phone']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('mobile_phone', trans('Mobile Phone'), ['class' => 'control-label']) !!}
                                        {!! Form::number('mobile_phone', old('mobile_phone') , ['class' => 'form-control', 'placeholder' => 'Input the Mobile Phone']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fax_1', trans('Fax 1'), ['class' => 'control-label']) !!}
                                        {!! Form::text('fax_1', old('fax_1') , ['class' => 'form-control', 'placeholder' => 'Input the Fax 1']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fax_2', trans('Fax 2'), ['class' => 'control-label']) !!}
                                        {!! Form::text('fax_2', old('fax_2') , ['class' => 'form-control', 'placeholder' => 'Input the Fax 2']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('job_title', trans('Job Title'), ['class' => 'control-label']) !!}
                                        {!! Form::text('job_title', old('job_title') , ['class' => 'form-control', 'placeholder' => 'Input the Job Title']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email', trans('Email'), ['class' => 'control-label']) !!}
                                        {!! Form::email('email', old('email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
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
                                        {!! Form::select('gender', ['1' => 'Male', '2' => 'Female'], old('gender'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('marital_status', trans('Marital Status'), ['class' => 'control-label']) !!}
                                        {!! Form::select('marital_status', ['divorced' => 'Divorced', 'single' => 'Single', 'married' => 'Married'], old('marital_status'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('insurance_no', trans('Insurance No'), ['class' => 'control-label']) !!}
                                        {!! Form::text('insurance_no', old('insurance_no') , ['class' => 'form-control', 'placeholder' => 'Input the Insurance No']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('country_of_birth', trans('Country of Birth'), ['class' => 'control-label']) !!}
                                        {!! Form::text('country_of_birth', old('country_of_birth') , ['class' => 'form-control', 'placeholder' => 'Input the Country of Birth']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('dob', trans('Date of Birth'), ['class' => 'control-label']) !!}
                                        {!! Form::date('dob', old('dob') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('security_id', trans('Security ID'), ['class' => 'control-label']) !!}
                                        {!! Form::text('security_id', old('security_id') , ['class' => 'form-control', 'placeholder' => 'Input the Security ID']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('website', trans('Website'), ['class' => 'control-label']) !!}
                                        {!! Form::text('website', old('website') , ['class' => 'form-control', 'placeholder' => 'Input the Website']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('nickname', trans('Nickname'), ['class' => 'control-label']) !!}
                                        {!! Form::text('nickname', old('nickname') , ['class' => 'form-control', 'placeholder' => 'Input the Nickname']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ic_no_1', trans('IC No 1'), ['class' => 'control-label']) !!}
                                        {!! Form::text('ic_no_1', old('ic_no_1') , ['class' => 'form-control', 'placeholder' => 'Input the IC No 1', 'maxlength' => 40]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ic_no_1_country', trans('IC No 1 Country'), ['class' => 'control-label']) !!}
                                        {!! Form::select('ic_no_1_country', $countries, old('ic_no_1_country'), ['class' => 'form-control', 'placeholder' => 'Select the IC No 1 Country']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ic_no_2', trans('IC No 2'), ['class' => 'control-label']) !!}
                                        {!! Form::text('ic_no_2', old('ic_no_2') , ['class' => 'form-control','maxlength' => 40, 'placeholder' => 'Input the IC No 2']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ic_no_2_country', trans('IC No 2 Country'), ['class' => 'control-label']) !!}
                                        {!! Form::select('ic_no_2_country', $countries, old('ic_no_2_country'), ['class' => 'form-control', 'placeholder' => 'Select the IC No 2 Country']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality_1', trans('Nationality 1'), ['class' => 'control-label']) !!}
                                        {!! Form::text('nationality_1', old('nationality_1') , ['class' => 'form-control', 'placeholder' => 'Input the Nationality 1']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality_2', trans('Nationality 2'), ['class' => 'control-label']) !!}
                                        {!! Form::text('nationality_2', old('nationality_2') , ['class' => 'form-control', 'placeholder' => 'Input the Nationality 2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="general">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('exit_permit_no', trans('Exit Permit No'), ['class' => 'control-label']) !!}
                                        {!! Form::text('exit_permit_no', old('exit_permit_no') , ['class' => 'form-control', 'placeholder' => 'Input the Exit Permit No']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('exit_permit_exp_date', trans('Exit Permit Exp. Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('exit_permit_exp_date', old('exit_permit_exp_date') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('seat_pref', trans('Seat Pref'), ['class' => 'control-label']) !!}
                                        {!! Form::select('seat_pref', ['window' => 'Window', 'aisle' => 'Aisle', 'bulkhead' => 'Bulkhead'], old('contact_type'), ['class' => 'form-control', 'placeholder' => 'the Seat Pref']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('seat_pref_remark', trans('Seat Pref Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::text('seat_pref_remark', old('seat_pref_remark') , ['class' => 'form-control', 'placeholder' => 'Input the Seat Pref Remark']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('meal', trans('Meal'), ['class' => 'control-label']) !!}
                                        {!! Form::select('meal', $meals, old('contact_type'), ['class' => 'form-control', 'placeholder' => 'Select the Meal']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('meal_remark', trans('Meal Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('meal_remark', old('meal_remark') , ['class' => 'form-control', 'rows' => '3x5', 'placeholder' => 'Input the Meal Remark']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('other_pref', trans('Other Pref'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('other_pref', old('other_pref') , ['class' => 'form-control','rows' => '3x5', 'placeholder' => 'Input the Other Pref']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-wrapper">
                        <h5 class="element-header">Documents</h5>
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('passport_no', trans('Passport No'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passport_no', old('passport_no') , ['class' => 'form-control', 'placeholder' => 'Input the Passport No']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('issue_country', trans('Issue Country'), ['class' => 'control-label']) !!}
                                        {!! Form::text('issue_country', old('issue_country') , ['class' => 'form-control', 'placeholder' => 'Input the Issue Country']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality', trans('Nationality'), ['class' => 'control-label']) !!}
                                        {!! Form::text('nationality', old('nationality') , ['class' => 'form-control', 'placeholder' => 'Input the Nationality']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
                                        {!! Form::text('type', old('type') , ['class' => 'form-control', 'placeholder' => 'Input the Type']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('issue_date', trans('Issue Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('issue_date', old('issue_date') , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('expiry_date', trans('Expiry Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('expiry_date', old('expiry_date') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('entry_country', trans('Entry Country'), ['class' => 'control-label']) !!}
                                        {!! Form::text('entry_country', old('entry_country') , ['class' => 'form-control', 'placeholder' => 'Input the Entry Country']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('passenger_name', trans('Passenger Name'), ['class' => 'control-label']) !!}
                                        {!! Form::text('passenger_name', old('passenger_name') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::text('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="disc_rate">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
                                        {!! Form::select('product_code',[], old('product_code') , ['class' => 'form-control', 'placeholder' => 'Select the Product Code']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('discount_percentage', trans('Discount Percentage'), ['class' => 'control-label']) !!}
                                        {!! Form::text('discount_percentage', old('discount_percentage') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Discount Percentage']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the remark', 'rows' => '5']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="credit_card">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('card_type', trans('Card Type'), ['class' => 'control-label']) !!}
                                        {!! Form::text('card_type', old('card_type') , ['class' => 'form-control', 'placeholder' => 'Input the Card Type', 'readonly' => true]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('merchant_no', trans('Merchant No.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('merchant_no', old('merchant_no') , ['class' => 'form-control', 'placeholder' => 'Input the Merchant No.']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('merchant_no_int', trans('Merchant No. Int'), ['class' => 'control-label']) !!}
                                        {!! Form::text('merchant_no_int', old('merchant_no_int') , ['class' => 'form-control', 'placeholder' => 'Input the Merchant No. Int']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('credit_card_no', trans('Credit Card No.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('credit_card_no', old('credit_card_no') , ['class' => 'form-control', 'placeholder' => 'Input the Credit Card No.']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('cc_expiry_date', trans('Expiry Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('cc_expiry_date', old('cc_expiry_date') , ['class' => 'form-control', 'placeholder' => 'Input the Expiry Date']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('cardholder_name', trans('Cardholder Name'), ['class' => 'control-label']) !!}
                                        {!! Form::text('cardholder_name', old('cardholder_name') , ['class' => 'form-control', 'placeholder' => 'Input the Cardholder Name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('bill_type', trans('Billing Type'), ['class' => 'control-label']) !!}
                                        {!! Form::text('bill_type', old('bill_type') , ['class' => 'form-control', 'placeholder' => 'Input the Billing Type']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('preferred_card', trans('Preferred Card'), ['class' => 'control-label']) !!}
                                        {!! Form::select('preferred_card', ['true' => 'YES', 'false' => 'NO'],old('preferred_card') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('sof', trans('Sof'), ['class' => 'control-label']) !!}
                                        {!! Form::select('sof', ['true' => 'YES', 'false' => 'NO'],old('sof') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '5']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="termfee">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('credit_limit', trans('Credit Limit'), ['class' => 'control-label']) !!}
                                        {!! Form::number('credit_limit', old('credit_limit') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Credit Limit']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('share_credit_code', trans('Share Credit Code'), ['class' => 'control-label']) !!}
                                        {!! Form::text('share_credit_code', old('share_credit_code') , ['class' => 'form-control', 'placeholder' => 'Input the Share Credit Code']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('addon_credit_limit', trans('Addon Credit Limit'), ['class' => 'control-label']) !!}
                                        {!! Form::number('addon_credit_limit', old('addon_credit_limit') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Addon Credit Limit']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('addon_from_date', trans('Addon From Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('addon_from_date', old('addon_from_date') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('addon_to_date', trans('Addon To Date'), ['class' => 'control-label']) !!}
                                        {!! Form::date('addon_to_date', old('addon_to_date') , ['class' => 'form-control', 'placeholder' => 'Input the Addon To Date']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('credit_term_type', trans('Credit Term Type'), ['class' => 'control-label']) !!}
                                        {!! Form::text('credit_term_type', old('credit_term_type') , ['class' => 'form-control', 'placeholder' => 'Input the Credit Term Type']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('invoice_delivery_method', trans('Invoice Delivery Method'), ['class' => 'control-label']) !!}
                                        {!! Form::select('invoice_delivery_method', ['fortnightly-statement' => 'Fortnightly Statement', 'monthly-statement' => 'Monthly Statement'],old('invoice_delivery_method') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('recall_commission_method', trans('Recall Commission Method'), ['class' => 'control-label']) !!}
                                        {!! Form::select('recall_commission_method', ['credit-card' => 'Credit Card', 'invoice' => 'Invoice'],old('recall_commission_method') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rebate_method', trans('Rebate Method'), ['class' => 'control-label']) !!}
                                        {!! Form::select('rebate_method', ['cn' => 'C/N', 'credit-card' => 'Credit Card', 'same-inv' => 'Same Inv'],old('rebate_method') , ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rebate_amount_type_id', trans('Rebate Amount Type'), ['class' => 'control-label']) !!}
                                        {!! Form::select('rebate_amount_type_id', ['' => 'Choose Rebate Amount Type'],old('rebate_amount_type_id') , ['class' => 'form-control']) !!}
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
<!-- <script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script> -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\CustomerRequest', '#form-customer') !!}
<script>
$(function(){
    spinnerLoad($('#form-customer'));
});
</script>
@endsection