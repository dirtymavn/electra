<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('itinerary_code', trans('Itinerary Code'), ['class' => 'control-label']) !!}
            {!! Form::text('itinerary_code', old('itinerary_code') , ['class' => 'form-control', 'placeholder' => 'Input the Code']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('inbound_outbound', trans('Inbound/Outbound'), ['class' => 'control-label']) !!}
            {!! Form::select('inbound_outbound', ['' => "Choose Inbound/Outbound"], old('inbound_outbound'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('branch_code', trans('Branch Code'), ['class' => 'control-label']) !!}
            {!! Form::text('branch_code', old('branch_code') , ['class' => 'form-control', 'placeholder' => 'Input the Code']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('modified_by', trans('Modified By'), ['class' => 'control-label']) !!}
            {!! Form::text('modified_by', old('modified_by') , ['class' => 'form-control', 'placeholder' => 'Input the Modified By']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('modified_date', trans('Modified Date'), ['class' => 'control-label']) !!}
            {!! Form::text('modified_date', old('modified_date') , ['class' => 'form-control', 'placeholder' => 'Input the Modified Date']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#main">Main</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#itinerary">Itinerary</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#service">Service</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cost_comparison">Cost Comparison</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#rate">Rate</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#rate_summary">Rate Summary</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#optional">Optional</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#analysis_code">Analysis Code</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="main">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
                                        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('category', trans('Category'), ['class' => 'control-label']) !!}
                                                {!! Form::select('category', ['' => "Choose Category"], old('category'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('city_code', trans('City Code'), ['class' => 'control-label']) !!}
                                                {!! Form::select('city_code', ['' => "Choose City Code"], old('city_code'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
                                                {!! Form::select('type', ['' => "Choose Type"], old('type'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('airline', trans('Airline'), ['class' => 'control-label']) !!}
                                        {!! Form::select('airline', ['' => "Choose Airline"], old('airline'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality', trans('Nationality'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality', ['' => "Choose Nationality"], old('nationality'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Description', 'rows' => 5]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('min_cap', trans('Min. Cap.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('min_cap', old('min_cap') , ['class' => 'form-control', 'placeholder' => 'Input the Min. Cap.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('max_cap', trans('Max. Cap.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('max_cap', old('max_cap') , ['class' => 'form-control', 'placeholder' => 'Input the Max. Cap.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('validity_from', trans('Validity From'), ['class' => 'control-label']) !!}
                                        {!! Form::date('validity_from', old('validity_from'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('validity_end', trans('Validity End'), ['class' => 'control-label']) !!}
                                        {!! Form::date('validity_end', old('validity_end'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('depature', trans('Depature'), ['class' => 'control-label']) !!}
                                        {!! Form::select('depature', ['' => "Choose Depature", '1' => 'Daily', '2' => 'Only on day of week', '3' => 'Only on the following date'], old('depature'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('no_of_day', trans('No. of Days'), ['class' => 'control-label']) !!}
                                        {!! Form::text('no_of_day', old('no_of_day') , ['class' => 'form-control', 'placeholder' => 'Input the No. of Days']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('cutoff_day', trans('Cutoff Days'), ['class' => 'control-label']) !!}
                                        {!! Form::text('cutoff_day', old('cutoff_day') , ['class' => 'form-control', 'placeholder' => 'Input the Cutoff Days']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('only_on_week', trans('The Day of Week'), ['class' => 'control-label']) !!}
                                        {!! Form::select('only_on_week[]', ['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'], old('only_on_week'), ['class' => 'form-control', 'multiple' => true, 'id' => 'only_on_week']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('only_on_date', trans('Following Date'), ['class' => 'control-label']) !!}
                                        {!! Form::select('only_on_date[]', ['25/01/18' => '25/01/18'], old('only_on_date'), ['class' => 'form-control', 'multiple' => true, 'id' => 'only_on_date']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => 5]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="itinerary">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control col-md-1"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Day</th>
                                                        <th>Remark</th>
                                                        <th>Remark</th>
                                                        <th>City</th>
                                                        <th>Code</th>
                                                        <th>Bried Description</th>
                                                        <th>Breakfast</th>
                                                        <th>Lunch</th>
                                                        <th>Dinner</th>
                                                        <th>Accommodations</th>
                                                        <th>Remark</th>
                                                        <th>Transportaion Detail</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-center">
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownAction1" type="button">Action</button>
                                                                <div aria-labelledby="dropdownAction1" class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-37"></i> Detail</a>
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-15"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="service">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>FIXED</p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Product Description</th>
                                                        <th>Supp. No.</th>
                                                        <th>Supp. Name</th>
                                                        <th>Product Code</th>
                                                        <th>Charge Method</th>
                                                        <th>Reference No.</th>
                                                        <th>Remark</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-center">
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownAction1" type="button">Action</button>
                                                                <div aria-labelledby="dropdownAction1" class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-37"></i> Detail</a>
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-15"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>VARIABLE</p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Product Description</th>
                                                        <th>Supp. No.</th>
                                                        <th>Supp. Name</th>
                                                        <th>Product Code</th>
                                                        <th>Charge Method</th>
                                                        <th>Reference No.</th>
                                                        <th>Remark</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-center">
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownAction1" type="button">Action</button>
                                                                <div aria-labelledby="dropdownAction1" class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-37"></i> Detail</a>
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-15"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="cost_comparison">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('group_size', trans('Group Size'), ['class' => 'control-label']) !!}
                                        {!! Form::text('group_size', old('group_size') , ['class' => 'form-control', 'placeholder' => 'Input the Group Size']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('currency', trans('Currency'), ['class' => 'control-label']) !!}
                                        {!! Form::select('currency', ['' => "Choose Currency"], old('currency'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('exchange_rate', trans('Exchange Rate'), ['class' => 'control-label']) !!}
                                        {!! Form::text('exchange_rate', old('exchange_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Exchange Rate']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Price Type</th>
                                                    <th colspan="5">Group Size (Right click the grid to set group size)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>10</td>
                                                    <td>15</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Normal Tour</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ticket Only</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Land Only</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                    <td>{{number_format(0,2)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="rate">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('group_size', trans('Group Size'), ['class' => 'control-label']) !!}
                                        {!! Form::text('group_size', old('group_size') , ['class' => 'form-control', 'placeholder' => 'Input the Group Size']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('currency', trans('Currency'), ['class' => 'control-label']) !!}
                                        {!! Form::select('currency', ['' => "Choose Currency"], old('currency'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('exchange_rate', trans('Exchange Rate'), ['class' => 'control-label']) !!}
                                        {!! Form::text('exchange_rate', old('exchange_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Exchange Rate']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('ptc', trans('PTC'), ['class' => 'control-label']) !!}
                                        {!! Form::select('ptc', ['' => "Choose PTC"], old('ptc'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('origin', trans('Origin'), ['class' => 'control-label']) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::select('origin', ['' => "Choose Origin"], old('origin'), ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-success form-control">Apply latest Auto-Calculation %</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Customer Type</th>
                                                        <th>Price Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>FIT</td>
                                                        <td>Normal Tour</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ticket Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Land Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agent</td>
                                                        <td>Normal Tour</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ticket Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Land Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Commercial</td>
                                                        <td>Normal Tour</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ticket Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Land Only</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-success form-control col-md-2">Selling Currency</button>
                                        <button class="btn btn-success form-control col-md-2">Convert Currency</button>
                                        <button class="btn btn-success form-control col-md-2">Origin</button>
                                        <button class="btn btn-success form-control col-md-2">Rate Calculation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="rate_summary">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('currency', trans('Currency'), ['class' => 'control-label']) !!}
                                        {!! Form::select('currency', ['' => "Choose Currency"], old('currency'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('exchange_rate', trans('Exchange Rate'), ['class' => 'control-label']) !!}
                                        {!! Form::text('exchange_rate', old('exchange_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Exchange Rate']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('origin', trans('Origin'), ['class' => 'control-label']) !!}
                                        {!! Form::select('origin', ['' => "Choose Origin"], old('origin'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Customer Type</th>
                                                        <th>Price Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>FIT</td>
                                                        <td>Normal Tour</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ticket Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Land Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agent</td>
                                                        <td>Normal Tour</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ticket Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Land Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Commercial</td>
                                                        <td>Normal Tour</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Ticket Only</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>Land Only</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-success form-control col-md-2">Deviation</button>
                                        <button class="btn btn-success form-control col-md-2">Early Bird Discount</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="optional">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Product Description</th>
                                                        <th>Supp. No.</th>
                                                        <th>Supp. Name</th>
                                                        <th>Product Code</th>
                                                        <th>Reference No.</th>
                                                        <th>Currency</th>
                                                        <th>Cost</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td class="text-center">
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button aria-expanded="false" aria-haspopup="true" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownAction1" type="button">Action</button>
                                                                <div aria-labelledby="dropdownAction1" class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-37"></i> Detail</a>
                                                                    <a class="dropdown-item" href="#"><i class="os-icon os-icon-ui-15"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="analysis_code">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('analysis_code_1', trans('Analysis Code 1'), ['class' => 'control-label']) !!}
                                        {!! Form::text('analysis_code_1', old('analysis_code_1') , ['class' => 'form-control', 'placeholder' => 'Input the Analysis Code 1']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('analysis_code_2', trans('Analysis Code '), ['class' => 'control-label']) !!}
                                        {!! Form::text('analysis_code_2', old('analysis_code_2') , ['class' => 'form-control', 'placeholder' => 'Input the Analysis Code ']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('analysis_code_3', trans('Analysis Code 3'), ['class' => 'control-label']) !!}
                                        {!! Form::text('analysis_code_3', old('analysis_code_3') , ['class' => 'form-control', 'placeholder' => 'Input the Analysis Code 3']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('analysis_code_4', trans('Analysis Code 4'), ['class' => 'control-label']) !!}
                                        {!! Form::text('analysis_code_4', old('analysis_code_4') , ['class' => 'form-control', 'placeholder' => 'Input the Analysis Code 4']) !!}
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
<script>
    $(document).ready(function() {
        initSelect2($('#only_on_week'), 'Select The Day of Week');
        initSelect2($('#only_on_date'), 'Select The Following Date');
    });
</script>
@endsection