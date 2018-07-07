<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-car-transfer col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="car-transfer-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>City</th>
                                    <th>Company Code</th>
                                    <th>Vehicle</th>
                                    <th>Days Hired</th>
                                    <th>pickup_date</th>
                                    <th>pickup_location</th>
                                    <th>Dropoff Date</th>
                                    <th>Dropoff Location</th>
                                    <th>Rate Type</th>
                                    <th>Status</th>
                                    
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

@push('models')
<div id="form-car-transfer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-car-transfer-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="car_transfer_id" id="car_transfer_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Transfer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('city', trans('City'), ['class' => 'control-label']) !!}
                            {!! Form::text('city', old('city') , ['class' => 'form-control', 'placeholder' => 'Input the City', 'id' => 'city']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('company', trans('Company'), ['class' => 'control-label']) !!}
                            {!! Form::text('company', old('company') , ['class' => 'form-control', 'placeholder' => 'Input the Company', 'id' => 'company']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('vehicle', trans('Vehicle'), ['class' => 'control-label']) !!}
                            {!! Form::text('vehicle', old('vehicle') , ['class' => 'form-control', 'placeholder' => 'Input the Vehicle', 'id' => 'vehicle']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('days_hired', trans('Days Hired'), ['class' => 'control-label']) !!}
                            {!! Form::text('days_hired', old('days_hired') , ['class' => 'form-control', 'placeholder' => 'Input the Days Hired', 'id' => 'days_hired']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pickup_date', trans('Pickup Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('pickup_date', old('pickup_date') , ['class' => 'form-control', 'placeholder' => 'Input the Pickup Date', 'id' => 'pickup_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pickup_location', trans('Pickup Location'), ['class' => 'control-label']) !!}
                            {!! Form::text('pickup_location', old('pickup_location') , ['class' => 'form-control', 'placeholder' => 'Input the Pickup Location', 'id' => 'pickup_location']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('dropoff_date', trans('Dropoff Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('dropoff_date', old('dropoff_date') , ['class' => 'form-control', 'placeholder' => 'Input the Dropoff Date', 'id' => 'dropoff_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('dropoff_location', trans('Dropoff Location'), ['class' => 'control-label']) !!}
                            {!! Form::text('dropoff_location', old('dropoff_location') , ['class' => 'form-control', 'placeholder' => 'Input the Dropoff Location', 'id' => 'dropoff_location']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::text('status', old('status') , ['class' => 'form-control', 'placeholder' => 'Input the Pickup Location', 'id' => 'status']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('rate_type', trans('Rate Type'), ['class' => 'control-label']) !!}
                            {!! Form::text('rate_type', old('rate_type') , ['class' => 'form-control', 'placeholder' => 'Input the Rate Type', 'id' => 'rate_type']) !!}
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <a id="form-car-transfer-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-car-transfer-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush