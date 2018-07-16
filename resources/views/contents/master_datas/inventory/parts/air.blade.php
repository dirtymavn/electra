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
                                    <th>Route From</th>
                                    <th>Route To</th>
                                    <th>Airline Code</th>
                                    <th>Fligh No</th>
                                    <th>Class</th>
                                    <th>Farebasis</th>
                                    <th>Depart Date</th>
                                    <th>Arrival</th>
                                    <th>Departure</th>
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
<div id="form-air" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-air-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="route_air_id" id="route_air_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Air</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('route_from', trans('Route From'), ['class' => 'control-label']) !!}
                            {!! Form::text('route_from', old('route_from') , ['class' => 'form-control', 'placeholder' => 'Input the Route From', 'id' => 'route_from']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('route_to', trans('Route To'), ['class' => 'control-label']) !!}
                            {!! Form::text('route_to', old('route_to') , ['class' => 'form-control', 'placeholder' => 'Input the Route From', 'id' => 'route_to']) !!}
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('airline_code', trans('Airline Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('airline_code', old('airline_code') , ['class' => 'form-control', 'placeholder' => 'Input the Airline Code', 'id' => 'airline_code']) !!}
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
                            {!! Form::label('class', trans('Class'), ['class' => 'control-label']) !!}
                            {!! Form::text('class', old('class') , ['class' => 'form-control', 'placeholder' => 'Input the Class', 'id' => 'class']) !!}
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('farebasis', trans('Farebasis'), ['class' => 'control-label']) !!}
                            {!! Form::text('farebasis', old('farebasis') , ['class' => 'form-control', 'placeholder' => 'Input the Farebasis', 'id' => 'farebasis']) !!}
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
                            {!! Form::label('arrival', trans('Arrival'), ['class' => 'control-label']) !!}
                            {!! Form::text('arrival', old('arrival') , ['class' => 'form-control', 'placeholder' => 'Input the Arrival', 'id' => 'arrival']) !!}
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('departure', trans('Departure'), ['class' => 'control-label']) !!}
                            {!! Form::text('departure', old('departure') , ['class' => 'form-control', 'placeholder' => 'Input the Departure', 'id' => 'departure']) !!}
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('air_status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::text('air_status', old('air_status') , ['class' => 'form-control', 'placeholder' => 'Input the Status', 'id' => 'air_status']) !!}
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
                            {!! Form::label('stopover_city', trans('Stop Over City'), ['class' => 'control-label']) !!}
                            {!! Form::text('stopover_city', old('stopover_city') , ['class' => 'form-control', 'placeholder' => 'Input the Stop Over City', 'id' => 'stopover_city']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('stopover_qty', trans('Stop Over Qty'), ['class' => 'control-label']) !!}
                            {!! Form::number('stopover_qty', old('stopover_qty') , ['class' => 'form-control', 'placeholder' => 'Input the Stop Over Qty', 'id' => 'stopover_qty']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('seat_no', trans('Seat No'), ['class' => 'control-label']) !!}
                            {!! Form::text('seat_no', old('seat_no') , ['class' => 'form-control', 'placeholder' => 'Input the Seat No', 'id' => 'seat_no']) !!}
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
                            {!! Form::label('fly_duration', trans('Fly Duration'), ['class' => 'control-label']) !!}
                            {!! Form::text('fly_duration', old('fly_duration') , ['class' => 'form-control', 'placeholder' => 'Input the Fly Duration', 'id' => 'fly_duration']) !!}
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
                            {!! Form::label('terminal', trans('Terminal'), ['class' => 'control-label']) !!}
                            {!! Form::text('terminal', old('terminal') , ['class' => 'form-control', 'placeholder' => 'Input the Terminal', 'id' => 'terminal']) !!}
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
                            {!! Form::label('miliage', trans('Mileage'), ['class' => 'control-label']) !!}
                            {!! Form::text('miliage', old('miliage') , ['class' => 'form-control only_number', 'placeholder' => 'Input the Mileage', 'id' => 'miliage']) !!}
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
                            {!! Form::label('land_sector_flag', trans('Land Sector Flag'), ['class' => 'control-label']) !!}
                            {!! Form::text('land_sector_flag', old('land_sector_flag') , ['class' => 'form-control', 'placeholder' => 'Input the Land Sector Flag', 'id' => 'land_sector_flag']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('land_sector_desc', trans('Land Sector Desc'), ['class' => 'control-label']) !!}
                            {!! Form::text('land_sector_desc', old('land_sector_desc') , ['class' => 'form-control', 'placeholder' => 'Input the Flight No', 'id' => 'land_sector_desc']) !!}
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