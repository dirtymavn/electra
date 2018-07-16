<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-detail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="misc-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Desc</th>
                                    <th>End Desc</th>
                                    <th>Status</th>
                                    <th>Description</th>
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
<div id="form-detail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-misc-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="misc_id" id="misc_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Misc</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
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
                            {!! Form::label('misc_status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::text('misc_status', old('misc_status') , ['class' => 'form-control', 'placeholder' => 'Input the Status', 'id' => 'misc_status']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('start_desc', trans('Start Description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('start_desc', old('start_desc') , ['class' => 'form-control', 'placeholder' => 'Input the Start Description', 'rows' => '4x2', 'id' => 'start_desc']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('end_desc', trans('End Description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('end_desc', old('end_desc') , ['class' => 'form-control', 'placeholder' => 'Input the End Description', 'rows' => '4x2', 'id' => 'end_desc']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Description', 'rows' => '4x2', 'id' => 'description']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="form-detail-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-detail-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush
