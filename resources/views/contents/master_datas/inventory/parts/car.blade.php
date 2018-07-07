<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-car col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="car-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Company</th>
                                    <th>Class</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
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
<div id="form-car" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-car-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="car_id" id="car_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Car</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('from', trans('From'), ['class' => 'control-label']) !!}
                            {!! Form::text('from', old('from') , ['class' => 'form-control', 'placeholder' => 'Input the From', 'id' => 'from']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('to', trans('To'), ['class' => 'control-label']) !!}
                            {!! Form::text('to', old('to') , ['class' => 'form-control', 'placeholder' => 'Input the To', 'id' => 'to']) !!}
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
                            {!! Form::label('class', trans('Class'), ['class' => 'control-label']) !!}
                            {!! Form::text('class', old('class') , ['class' => 'form-control', 'placeholder' => 'Input the Class', 'id' => 'class']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('departure', trans('Departure'), ['class' => 'control-label']) !!}
                            {!! Form::date('departure', old('departure') , ['class' => 'form-control', 'placeholder' => 'Input the Departure', 'id' => 'departure']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('arrival', trans('Arrival'), ['class' => 'control-label']) !!}
                            {!! Form::date('arrival', old('arrival') , ['class' => 'form-control', 'placeholder' => 'Input the Arrival', 'id' => 'arrival']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::text('status', old('status') , ['class' => 'form-control', 'placeholder' => 'Input the Status', 'id' => 'status']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="form-car-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-car-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush