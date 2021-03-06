<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('itinerary_code', trans('Itinerary Code'), ['class' => 'control-label']) !!}
            {!! Form::text('itinerary_code', $newCode , ['class' => 'form-control', 'placeholder' => '<Auto Number>', 'readonly' => true]) !!}
        </div>
        <div class="form-group" style="display: none;">
            {!! Form::label('itinerary_direction', trans('Itinerary Direction'), ['class' => 'control-label']) !!}
            {!! Form::text('itinerary_direction', old('itinerary_direction') , ['class' => 'form-control', 'placeholder' => 'Input the Direction']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('branch_id', trans('Branch Name'), ['class' => 'control-label']) !!}
            {!! Form::select('branch_id', ['' => "Choose Branch"] + @$branchs, old('branch_id'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show {{ $errors->has('itinerary_name') ? 'has-errors' : ''}}" data-toggle="tab" href="#main">Main</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#itinerary">Itinerary</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#service">Service</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#optional">Optional</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="main">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group {{ $errors->has('itinerary_name') ? 'has-error has-danger' : ''}}">
                                        {!! Form::label('itinerary_name', trans('Itinerary Name'), ['class' => 'control-label']) !!}
                                        {!! Form::text('itinerary_name', old('itinerary_name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
                                        {!! $errors->first('itinerary_name', '<span id="itinerary_name-error" class="help-block form-text with-errors form-control-feedback">:message</span>') !!}
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
                                                {!! Form::select('city_code', ['' => "Choose City"] + @$cities, old('city_code'), ['class' => 'form-control city-list']) !!}
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
                                        {!! Form::select('airline', ['' => "Choose Airline"] + @$airlines, old('airline'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nationality', trans('Nationality'), ['class' => 'control-label']) !!}
                                        {!! Form::select('nationality', ['' => "Choose Nationality"] + @$nationalities, old('nationality'), ['class' => 'form-control']) !!}
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
                                        {!! Form::text('min_cap', old('min_cap') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Min. Cap.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('max_cap', trans('Max. Cap.'), ['class' => 'control-label']) !!}
                                        {!! Form::text('max_cap', old('max_cap') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Max. Cap.']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('validity_start', trans('Validity Start'), ['class' => 'control-label']) !!}
                                        {!! Form::date('validity_start', old('validity_start'), ['class' => 'form-control']) !!}
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
                                        {!! Form::label('departure', trans('Departure'), ['class' => 'control-label']) !!}
                                        {!! Form::select('departure', ['' => "Choose departure"] + @$departures, old('departure'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('days_duration', trans('Days Duration'), ['class' => 'control-label']) !!}
                                        {!! Form::text('days_duration', old('days_duration') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Days Duration']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('cutoff_days', trans('Cutoff Days'), ['class' => 'control-label']) !!}
                                        {!! Form::text('cutoff_days', old('cutoff_days') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Cutoff Days']) !!}
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
                                        <button type="button" class="btn btn-primary form-control btn-add-detail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="itinerary-detail" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Day</th>
                                                        <!-- <th>Remark</th>
                                                        <th>Remark</th> -->
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
                                        <button class="btn btn-primary form-control btn-add-service"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>FIXED</p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped itinerary-service" id="itinerary-service-fixed" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Supp. No.</th>
                                                        <th>Product Code</th>
                                                        <th>Charge Method</th>
                                                        <th>Reference No.</th>
                                                        <th>Remark</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
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
                                            <table class="table table-bordered table-striped itinerary-service" id="itinerary-service-variable" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Supp. No.</th>
                                                        <th>Product Code</th>
                                                        <th>Charge Method</th>
                                                        <th>Reference No.</th>
                                                        <th>Remark</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
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
                                        <button class="btn btn-primary btn-add-optional form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="itinerary-optional" style="width:100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Product Description</th>
                                                        <th>Supp. No.</th>
                                                        <th>Product Code</th>
                                                        <th>Reference No.</th>
                                                        <th>Currency</th>
                                                        <th>Cost</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
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
</div>

@push('models')
    <!-- Form Itinerary Detail .Start -->
    <div id="form-detail" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-itinerary-detail', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Itinerary Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="itinerary_detail_id" id="itinerary_detail_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('day', trans('Day'), ['class' => 'control-label']) !!}
                                    {!! Form::number('day', old('day'), ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Day']) !!}
                                </div>
                                <div class="form-group" style="display: none;">
                                    {!! Form::label('as_remark_flag', trans('As Remark Flag'), ['class' => 'control-label']) !!}
                                    {!! Form::select('as_remark_flag', ['true' => 'YES', 'false' => 'NO'], old('as_remark_flag'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group" style="display: none;">
                                    {!! Form::label('remark_seq', trans('Remark Seq'), ['class' => 'control-label']) !!}
                                    {!! Form::text('remark_seq', old('remark_seq'), ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Remark Seq']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('itinerary_item_code', trans('Itinerary Item Code'), ['class' => 'control-label']) !!}
                                    {!! Form::text('itinerary_item_code', old('itinerary_item_code'), ['class' => 'form-control', 'placeholder' => 'Input the Itinerary Item Code', 'maxlength' => '20']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('city', trans('City'), ['class' => 'control-label']) !!}
                                    {!! Form::select('city', ['' => 'Choose City'] + @$cities, old('city'), ['class' => 'form-control city-list']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('brief_description', trans('Brief Description'), ['class' => 'control-label']) !!}
                                    {!! Form::text('brief_description', old('brief_description'), ['class' => 'form-control', 'placeholder' => 'Input the Brief Description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('land_operator', trans('Land Operator'), ['class' => 'control-label']) !!}
                                    {!! Form::text('land_operator', old('land_operator'), ['class' => 'form-control', 'placeholder' => 'Input the Land Operator']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Input the Description', 'rows' => '4']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('highlight', trans('Highlight'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('highlight', old('highlight'), ['class' => 'form-control', 'placeholder' => 'Input the Highlight', 'rows' => '4']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('breakfast', trans('Breakfast'), ['class' => 'control-label']) !!}
                                    {!! Form::text('breakfast', old('breakfast'), ['class' => 'form-control', 'placeholder' => 'Input the Breakfast']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lunch', trans('Lunch'), ['class' => 'control-label']) !!}
                                    {!! Form::text('lunch', old('lunch'), ['class' => 'form-control', 'placeholder' => 'Input the Lunch']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('dinner', trans('Dinner'), ['class' => 'control-label']) !!}
                                    {!! Form::text('dinner', old('dinner'), ['class' => 'form-control', 'placeholder' => 'Input the Dinner']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('accomodations', trans('Accommodations'), ['class' => 'control-label']) !!}
                                    {!! Form::text('accomodations', old('accomodations'), ['class' => 'form-control', 'placeholder' => 'Input the Accommodations']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('remark', old('remark'), ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('transport_detail', trans('Transportaion Detail'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('transport_detail', old('transport_detail'), ['class' => 'form-control', 'placeholder' => 'Input the Transportaion Detail', 'rows' => '4']) !!}
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <a id="form-detail-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                    </a>
                    <button id="form-detail-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Form Itinerary Detail .End -->

    <!-- Form Itinerary Service .Start -->
    <div id="form-service" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Itinerary Service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'form-itinerary-service', 'method' => 'post']) !!}
                    <input type="hidden" value="" name="itinerary_service_id" id="itinerary_service_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
                                {!! Form::text('product_code', old('product_code'), ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('service_type', trans('Type'), ['class' => 'control-label']) !!}
                                {!! Form::select('service_type', ['fixed' => 'Fixed', 'variable' => 'Variable'], old('service_type'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('ref_no', trans('Reference No.'), ['class' => 'control-label']) !!}
                                {!! Form::text('ref_no', old('ref_no'), ['class' => 'form-control', 'placeholder' => 'Input the Reference No.']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('charge_method', trans('Charge Method'), ['class' => 'control-label']) !!}
                                {!! Form::text('charge_method', old('charge_method'), ['class' => 'form-control', 'placeholder' => 'Input the Charge Method']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('supplier_no', trans('Supplier'), ['class' => 'control-label']) !!}
                                {!! Form::select('supplier_no', ['' => 'Choose Supplier'] + @$suppliers, old('supplier_no'), ['class' => 'form-control supplier-no']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('currency', trans('Currency'), ['class' => 'control-label']) !!}
                                {!! Form::select('currency', ['' => 'Choose Currency'] + @$currencys, old('currency'), ['class' => 'form-control currency-rate']) !!}
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('service_remark', trans('Remark'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('service_remark', old('service_remark'), ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tax_type', trans('Tax Type'), ['class' => 'control-label']) !!}
                                {!! Form::text('tax_type', old('tax_type'), ['class' => 'form-control', 'placeholder' => 'Input the Tax Type']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tax_currency', trans('Tax Currency'), ['class' => 'control-label']) !!}
                                {!! Form::select('tax_currency', ['' => 'Choose Tax Currency'], old('tax_currency'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group" style="display: none;">
                                {!! Form::label('tax_free_foc_flag', trans('Tax Free Foc Flag'), ['class' => 'control-label']) !!}
                                {!! Form::select('tax_free_foc_flag', ['true' => 'Yes', 'false' => 'No'], old('tax_free_foc_flag'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group" style="display: none;">
                                {!! Form::label('foc_discount_type', trans('Foc Discount Type'), ['class' => 'control-label']) !!}
                                {!! Form::text('foc_discount_type', old('foc_discount_type'), ['class' => 'form-control', 'placeholder' => 'Input the Foc Discount Type']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                            <ul class="nav nav-tabs smaller">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#route">Route</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cost_interval">Cost Interval</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#other_ptc">Other Ptc</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#foc">Foc</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tax">Tax</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="route">
                                <div class="element-wrapper">
                                    <div class="element-box">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-add-service-route form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="itinerary-service-route" style="width:100%;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Desc.</th>
                                                                <th>Start Date</th>
                                                                <th>Start Desc.</th>
                                                                <th>End Date</th>
                                                                <th>End Desc.</th>
                                                                <!-- <th>Status</th> -->
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Route .Start -->
                                            <div id="form-service-route" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        {!! Form::open(['id' => 'form-itinerary-service-route', 'method' => 'post']) !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Itinerary Service Route</h4>
                                                            <button type="button" class="close close-service-route"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="itinerary_service_route_id" id="itinerary_service_route_id">
                                                            <input type="hidden" value="add" name="itinerary_service_route_method" id="itinerary_service_route_method">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('route_description', trans('Description'), ['class' => 'control-label']) !!}
                                                                        {!! Form::textarea('route_description', old('route_description'), ['class' => 'form-control', 'placeholder' => 'Input the Description', 'rows' => '4']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('start_date', trans('Start Date'), ['class' => 'control-label']) !!}
                                                                        {!! Form::date('start_date', old('start_date'), ['class' => 'form-control']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('end_date', trans('End Date'), ['class' => 'control-label']) !!}
                                                                        {!! Form::date('end_date', old('end_date'), ['class' => 'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('start_description', trans('Start Description'), ['class' => 'control-label']) !!}
                                                                        {!! Form::textarea('start_description', old('start_description'), ['class' => 'form-control', 'placeholder' => 'Input the Start Description', 'rows' => '4']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('end_description', trans('End Description'), ['class' => 'control-label']) !!}
                                                                        {!! Form::textarea('end_description', old('end_description'), ['class' => 'form-control', 'placeholder' => 'Input the End Description', 'rows' => '4']) !!}
                                                                    </div>
                                                                    <div class="form-group" style="display: none;">
                                                                        {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('status', old('status'), ['class' => 'form-control', 'placeholder' => 'Input the Status']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" href="#" class="btn btn-grey pull-left close-service-route"><i class="fa fa-times m-right-10"></i> Cancel</button>
                                                            <button type="button" id="submit-service-route" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Route .End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="cost_interval">
                                <div class="element-wrapper">
                                    <div class="element-box">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-add-service-interval form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="itinerary-service-interval" style="width:100%;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Pax From</th>
                                                                <th>Pax To</th>
                                                                <th>Unit Cost</th>
                                                                <th>Disc. Percent</th>
                                                                <th>Disc. Amount</th>
                                                                <th>Net Cost</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Interval .Start -->
                                            <div id="form-service-interval" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        {!! Form::open(['id' => 'form-itinerary-service-interval', 'method' => 'post']) !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Itinerary Service Cost Interval</h4>
                                                            <button type="button" class="close close-service-interval"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="itinerary_service_interval_id" id="itinerary_service_interval_id">
                                                            <input type="hidden" value="add" name="itinerary_service_interval_method" id="itinerary_service_interval_method">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('interval_pax_from', trans('Pax From'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('interval_pax_from', old('interval_pax_from'), ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Pax From']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('interval_pax_to', trans('Pax To'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('interval_pax_to', old('interval_pax_to'), ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Pax To']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('interval_unit_cost', trans('Unit Cost'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('interval_unit_cost', old('interval_unit_cost'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Unit Cost']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('interval_discount_percent', trans('Discount Percent'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('interval_discount_percent', old('interval_discount_percent'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Discount Percent']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('interval_discount_amount', trans('Discount Amount'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('interval_discount_amount', old('interval_discount_amount'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Discount Amount']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('interval_net_cost', trans('Net Cost'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('interval_net_cost', old('interval_net_cost'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Net Cost']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" href="#" class="btn btn-grey pull-left close-service-interval"><i class="fa fa-times m-right-10"></i> Cancel</button>
                                                            <button type="button" id="submit-service-interval" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Interval .End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="other_ptc">
                                <div class="element-wrapper">
                                    <div class="element-box">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-add-service-ptc form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="itinerary-service-ptc" style="width:100%;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Pax Ptc</th>
                                                                <th>Pax From</th>
                                                                <th>Pax To</th>
                                                                <th>Unit Cost</th>
                                                                <th>Disc. Percent</th>
                                                                <th>Disc. Amount</th>
                                                                <th>Net Cost</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Ptc .Start -->
                                            <div id="form-service-ptc" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        {!! Form::open(['id' => 'form-itinerary-service-ptc', 'method' => 'post']) !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Itinerary Service Other Ptc</h4>
                                                            <button type="button" class="close close-service-ptc"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="itinerary_service_ptc_id" id="itinerary_service_ptc_id">
                                                            <input type="hidden" value="add" name="itinerary_service_ptc_method" id="itinerary_service_ptc_method">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_pax_ptc', trans('Pax Ptc'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_pax_ptc', old('ptc_pax_ptc'), ['class' => 'form-control', 'placeholder' => 'Input the Pax Ptc']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_pax_from', trans('Pax From'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_pax_from', old('ptc_pax_from'), ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Pax From']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_pax_to', trans('Pax To'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_pax_to', old('ptc_pax_to'), ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Pax To']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_unit_cost', trans('Unit Cost'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_unit_cost', old('ptc_unit_cost'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Unit Cost']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_discount_percent', trans('Discount Percent'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_discount_percent', old('ptc_discount_percent'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Discount Percent']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_discount_amount', trans('Discount Amount'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_discount_amount', old('ptc_discount_amount'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Discount Amount']) !!}
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {!! Form::label('ptc_net_cost', trans('Net Cost'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('ptc_net_cost', old('ptc_net_cost'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Net Cost']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" href="#" class="btn btn-grey pull-left close-service-ptc"><i class="fa fa-times m-right-10"></i> Cancel</button>
                                                            <button type="button" id="submit-service-ptc" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Ptc .End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="foc">
                                <div class="element-wrapper">
                                    <div class="element-box">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-add-service-foc form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="itinerary-service-foc" style="width:100%;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Pax No</th>
                                                                <th>Foc</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Foc .Start -->
                                            <div id="form-service-foc" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        {!! Form::open(['id' => 'form-itinerary-service-foc', 'method' => 'post']) !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Itinerary Service Foc</h4>
                                                            <button type="button" class="close close-service-foc"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="itinerary_service_foc_id" id="itinerary_service_foc_id">
                                                            <input type="hidden" value="add" name="itinerary_service_foc_method" id="itinerary_service_foc_method">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('foc_pax_no', trans('Pax No'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('foc_pax_no', old('foc_pax_no'), ['class' => 'form-control', 'placeholder' => 'Input the Pax No']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('foc_foc', trans('Foc'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('foc_foc', old('foc_foc'), ['class' => 'form-control', 'placeholder' => 'Input the Foc']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" href="#" class="btn btn-grey pull-left close-service-foc"><i class="fa fa-times m-right-10"></i> Cancel</button>
                                                            <button type="button" id="submit-service-foc" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Foc .End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tax">
                                <div class="element-wrapper">
                                    <div class="element-box">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-add-service-tax form-control"><i class="fa fa-plus m-right-10"></i> Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="itinerary-service-tax" style="width:100%;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Ptc</th>
                                                                <th>Tax Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Tax .Start -->
                                            <div id="form-service-tax" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        {!! Form::open(['id' => 'form-itinerary-service-tax', 'method' => 'post']) !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Itinerary Service Tax</h4>
                                                            <button type="button" class="close close-service-tax"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="itinerary_service_tax_id" id="itinerary_service_tax_id">
                                                            <input type="hidden" value="add" name="itinerary_service_tax_method" id="itinerary_service_tax_method">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('tax_ptc', trans('Ptc'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('tax_ptc', old('tax_ptc'), ['class' => 'form-control', 'placeholder' => 'Input the Ptc']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        {!! Form::label('tax_tax_amount', trans('Tax Amount'), ['class' => 'control-label']) !!}
                                                                        {!! Form::text('tax_tax_amount', old('tax_tax_amount'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Tax Amount']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" href="#" class="btn btn-grey pull-left close-service-tax"><i class="fa fa-times m-right-10"></i> Cancel</button>
                                                            <button type="button" id="submit-service-tax" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                                                            </button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Form Itinerary Service Tax .End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="form-service-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                    </a>
                    <button id="form-service-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Itinerary Service .End -->

    <!-- Form Itinerary Optional .Start -->
    <div id="form-optional" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['id' => 'form-itinerary-optional', 'method' => 'post']) !!}
                <div class="modal-header">
                    <h4 class="modal-title">Itinerary Optional</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="itinerary_optional_id" id="itinerary_optional_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('optional_product_description', trans('Product Description'), ['class' => 'control-label']) !!}
                                    {!! Form::text('optional_product_description', old('optional_product_description'), ['class' => 'form-control', 'placeholder' => 'Input the Product Description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('optional_supplier_no', trans('Supplier'), ['class' => 'control-label']) !!}
                                    {!! Form::select('optional_supplier_no', ['' => 'Choose Supplier'] + @$suppliers, old('optional_supplier_no'), ['class' => 'form-control supplier-no']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('optional_product_code', trans('Product Code'), ['class' => 'control-label']) !!}
                                    {!! Form::text('optional_product_code', old('optional_product_code'), ['class' => 'form-control', 'placeholder' => 'Input the Product Code']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('optional_reference_no', trans('Reference No'), ['class' => 'control-label']) !!}
                                    {!! Form::text('optional_reference_no', old('optional_reference_no'), ['class' => 'form-control', 'placeholder' => 'Input the Reference No']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('optional_currency', trans('Currency'), ['class' => 'control-label']) !!}
                                    {!! Form::select('optional_currency', ['' => 'Choose Currency'] + @$currencys, old('optional_currency'), ['class' => 'form-control currency-rate']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('optional_cost', trans('Cost'), ['class' => 'control-label']) !!}
                                    {!! Form::text('optional_cost', old('optional_cost'), ['class' => 'form-control only_number', 'placeholder' => 'Input the Cost']) !!}
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <a id="form-optional-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                    </a>
                    <button id="form-optional-accept" type="submit" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Form Itinerary Optional .End -->
@endpush

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\Outbound\ItinRequest') !!}

<script>
    $(function(){
        spinnerLoad($('#form-itin'));
        initSelect2Remote($('#branch_id'), "{{ route('branch.search-data') }}", "Choose Branch", 0);
        initSelect2Remote($('.city-list'), "{{ route('city.search-data-normal') }}", "Choose City", 0, true);
        initSelect2Remote($('#airline'), "{{ route('airline.search-data') }}", "Choose Airline", 0);
        initSelect2Remote($('#departure'), "{{ route('city.search-data') }}", "Choose Departure", 0, true);
        initSelect2Remote($('.supplier-no'), "{{ route('supplier.search-data') }}", "Choose Supplier", 0, true);
        initSelect2Remote($('#nationality'), "{{ route('country.search-data-nationality') }}", "Choose Nationality", 0);
        initSelect2Remote($('.currency-rate'), "{{ route('currencyrate.search-data') }}", "Choose Currency", 0, true);
        initSelect2($('#type'), 'Choose Type');
        initSelect2($('#category'), 'Choose Category');
    });
</script>

@include('contents.master_datas.outbounds.itin.js.itinerary_detail_js')
@include('contents.master_datas.outbounds.itin.js.itinerary_service_js')
@include('contents.master_datas.outbounds.itin.js.itinerary_optional_js')

@endsection