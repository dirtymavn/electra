<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-pkg col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="pkg-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Package Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
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
<div id="form-pkg" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-pkg-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="pkg_id" id="pkg_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Package</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('package_name', trans('Package Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('package_name', old('package_name') , ['class' => 'form-control', 'placeholder' => 'Input the package_name', 'id' => 'package_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('start_date', trans('Start Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('start_date', old('start_date') , ['class' => 'form-control', 'placeholder' => 'Input the Start Date', 'id' => 'start_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('end_date', trans('End Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('end_date', old('end_date') , ['class' => 'form-control', 'placeholder' => 'Input the End Date', 'id' => 'end_date']) !!}
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
                <a id="form-detail-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-detail-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-times m-right-10"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush