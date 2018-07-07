<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-detail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
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
<div id="form-car-transfer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-car-transfer-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="car_transfer_id" id="car_transfer_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Air</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('route_form', trans('Route From'), ['class' => 'control-label']) !!}
                            {!! Form::text('route_form', old('route_form') , ['class' => 'form-control', 'placeholder' => 'Input the Route From', 'id' => 'route_form']) !!}
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
                            {!! Form::label('arrival', trans('Arrival'), ['class' => 'control-label']) !!}
                            {!! Form::text('arrival', old('arrival') , ['class' => 'form-control', 'placeholder' => 'Input the Arrival', 'id' => 'arrival']) !!}
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