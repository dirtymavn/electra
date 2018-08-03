<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotel-service col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotel-service-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>service_name</th>
                                    <th>service_desciption</th>
                                    <th>cost</th>
                                    <th>sales</th>
                                    <th>start_date</th>
                                    <th>end_date</th>
                                    <th>season</th>
                                    <th>is_free</th>
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
<div id="form-hotel-service" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotel-service-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="hotel_service_id" id="hotel_service_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Hotel Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('service_name', trans('service_name'), ['class' => 'control-label']) !!}
                            {!! Form::text('service_name', old('service_name') , ['class' => 'form-control', 'placeholder' => 'Input the service_name', 'id' => 'service_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('service_desciption', trans('service_desciption'), ['class' => 'control-label']) !!}
                            {!! Form::text('service_desciption', old('service_desciption') , ['class' => 'form-control', 'placeholder' => 'Input the service_desciption', 'id' => 'service_desciption']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('cost', trans('cost'), ['class' => 'control-label']) !!}
                            {!! Form::text('cost', old('cost') , ['class' => 'form-control', 'placeholder' => 'Input the cost', 'id' => 'cost']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('sales', trans('sales'), ['class' => 'control-label']) !!}
                            {!! Form::text('sales', old('sales') , ['class' => 'form-control', 'placeholder' => 'Input the sales', 'id' => 'sales']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('start_date', trans('start_date'), ['class' => 'control-label']) !!}
                            {!! Form::date('start_date', old('start_date') , ['class' => 'form-control', 'placeholder' => 'Input the start date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('end_date', trans('end_date'), ['class' => 'control-label']) !!}
                            {!! Form::date('end_date', old('end_date') , ['class' => 'form-control', 'placeholder' => 'Input the end date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('season', trans('season'), ['class' => 'control-label']) !!}
                            {!! Form::select('season',  @season(), old('season'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('is_free', trans('is_free'), ['class' => 'control-label']) !!}
                            {!! Form::select('is_free', ['1' => 'Yes', '0' => 'No'], old('season'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotel-service-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush