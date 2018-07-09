<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-air col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="air-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>City From</th>
                                    <th>City To</th>
                                    <th>Airline</th>
                                    <th>Passenger Class</th>
                                    <th>Depart Date</th>
                                    <th>Arrival Date</th>
                                    <th>Stopover Count</th>
                                    <th>Flight Status</th>
                                    
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
<div id="form-air" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-air-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="car_transfer_id" id="car_transfer_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Detail Routing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('city_from_id', trans('City From'), ['class' => 'control-label']) !!}
                            {!! Form::text('city_from_id', old('city_from_id') , ['class' => 'form-control', 'placeholder' => 'Input the City From', 'id' => 'city_from_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('city_to_id', trans('City To'), ['class' => 'control-label']) !!}
                            {!! Form::text('city_to_id', old('city_to_id') , ['class' => 'form-control', 'placeholder' => 'Input the City To', 'id' => 'city_to_id']) !!}
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('airline_id', trans('Airline'), ['class' => 'control-label']) !!}
                            {!! Form::text('airline_id', old('airline_id') , ['class' => 'form-control', 'placeholder' => 'Input the Airline', 'id' => 'airline_id']) !!}
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('passenger_class_id', trans('Passenger Class ID'), ['class' => 'control-label']) !!}
                            {!! Form::text('passenger_class_id', old('passenger_class_id') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Class ID', 'id' => 'passenger_class_id']) !!}
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('depart_date', trans('Depart Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('depart_date', old('depart_date') , ['class' => 'form-control', 'placeholder' => 'Input the Depart Date', 'id' => 'depart_date']) !!}
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('arrival_date', trans('Arrival Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('arrival_date', old('arrival_date') , ['class' => 'form-control', 'placeholder' => 'Input the Arrival Date', 'id' => 'arrival_date']) !!}
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('stopover_city', trans('Stop Over City'), ['class' => 'control-label']) !!}
                            {!! Form::text('stopover_city', old('stopover_city') , ['class' => 'form-control', 'placeholder' => 'Input the Stop Over City', 'id' => 'stopover_city']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('stopover_count', trans('Stop Over Count'), ['class' => 'control-label']) !!}
                            {!! Form::number('stopover_count', old('stopover_count') , ['class' => 'form-control', 'placeholder' => 'Input the Stop Over Count', 'id' => 'stopover_count']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('airline_pnr', trans('Airline PNR'), ['class' => 'control-label']) !!}
                            {!! Form::text('airline_pnr', old('airline_pnr') , ['class' => 'form-control', 'placeholder' => 'Input the Airline PNR', 'id' => 'airline_pnr']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('fly_hr', trans('Fly Hr'), ['class' => 'control-label']) !!}
                            {!! Form::text('fly_hr', old('fly_hr') , ['class' => 'form-control', 'placeholder' => 'Input the Fly Hr', 'id' => 'fly_hr']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('meal_srv', trans('Meal Srv'), ['class' => 'control-label']) !!}
                            {!! Form::text('meal_srv', old('meal_srv') , ['class' => 'form-control', 'placeholder' => 'Input the Meal Srv', 'id' => 'meal_srv']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ssr', trans('SSR'), ['class' => 'control-label']) !!}
                            {!! Form::text('ssr', old('ssr') , ['class' => 'form-control', 'placeholder' => 'Input the SSR', 'id' => 'ssr']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sector_pair', trans('Sector Pair'), ['class' => 'control-label']) !!}
                            {!! Form::text('sector_pair', old('sector_pair') , ['class' => 'form-control', 'placeholder' => 'Input the Sector Pair', 'id' => 'sector_pair']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('path_code', trans('Path Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('path_code', old('path_code') , ['class' => 'form-control', 'placeholder' => 'Input the Path Code', 'id' => 'path_code']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('land_sector_desc', trans('Land Sector Desc'), ['class' => 'control-label']) !!}
                            {!! Form::text('land_sector_desc', old('land_sector_desc') , ['class' => 'form-control', 'placeholder' => 'Input the Land Sector Desc', 'id' => 'land_sector_desc']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('operating_carrier_id', trans('Operating Carrier ID'), ['class' => 'control-label']) !!}
                            {!! Form::text('operating_carrier_id', old('operating_carrier_id') , ['class' => 'form-control', 'placeholder' => 'Input the Operating Carrier ID', 'id' => 'operating_carrier_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('flight_no', trans('Flight No'), ['class' => 'control-label']) !!}
                            {!! Form::text('flight_no', old('flight_no') , ['class' => 'form-control', 'placeholder' => 'Input the Flight No', 'id' => 'flight_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('flight_status', trans('Flight Status'), ['class' => 'control-label']) !!}
                            {!! Form::text('flight_status', old('flight_status') , ['class' => 'form-control', 'placeholder' => 'Input the Flight Status', 'id' => 'flight_status']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('equip', trans('Equip'), ['class' => 'control-label']) !!}
                            {!! Form::text('equip', old('equip') , ['class' => 'form-control', 'placeholder' => 'Input the Equip', 'id' => 'equip']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('seat_no', trans('Meal Srv'), ['class' => 'control-label']) !!}
                            {!! Form::text('seat_no', old('seat_no') , ['class' => 'form-control', 'placeholder' => 'Input the Meal Srv', 'id' => 'seat_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('terminal', trans('Terminal'), ['class' => 'control-label']) !!}
                            {!! Form::text('terminal', old('terminal') , ['class' => 'form-control', 'placeholder' => 'Input the Terminal', 'id' => 'terminal']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('mileage', trans('Mileage'), ['class' => 'control-label']) !!}
                            {!! Form::text('mileage', old('mileage') , ['class' => 'form-control', 'placeholder' => 'Input the Mileage', 'id' => 'mileage']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('land_sector_flag', trans('Land Sector Flag'), ['class' => 'control-label']) !!}
                            {!! Form::text('land_sector_flag', old('land_sector_flag') , ['class' => 'form-control', 'placeholder' => 'Input the Land Sector Flag', 'id' => 'land_sector_flag']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('stopover', trans('Stopover'), ['class' => 'control-label']) !!}
                            {!! Form::text('stopover', old('stopover') , ['class' => 'form-control', 'placeholder' => 'Input the Stopover', 'id' => 'stopover']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nuc', trans('NUC'), ['class' => 'control-label']) !!}
                            {!! Form::text('nuc', old('nuc') , ['class' => 'form-control', 'placeholder' => 'Input the NUC', 'id' => 'nuc']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('roe', trans('ROE'), ['class' => 'control-label']) !!}
                            {!! Form::text('roe', old('roe') , ['class' => 'form-control', 'placeholder' => 'Input the ROE', 'id' => 'roe']) !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a id="form-air-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-air-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush