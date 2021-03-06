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
                            {!! Form::label('pkg_start_date', trans('Start Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('pkg_start_date', old('pkg_start_date') , ['class' => 'form-control', 'placeholder' => 'Input the Start Date', 'id' => 'pkg_start_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('pkg_end_date', trans('End Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('pkg_end_date', old('pkg_end_date') , ['class' => 'form-control', 'placeholder' => 'Input the End Date', 'id' => 'pkg_end_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('pkg_status', trans('Status'), ['class' => 'control-label']) !!}
                            {{-- {!! Form::text('pkg_status', old('pkg_status') , ['class' => 'form-control', 'placeholder' => 'Input the Status', 'id' => 'pkg_status']) !!} --}}
                            {!! Form::select('pkg_status', [ 'active' => 'Active', 'inactive' => 'Inactive' ], old('pkg_status'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-pkg-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush