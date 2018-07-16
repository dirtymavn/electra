<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-segment col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="segment-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Description</th>
                                    <th>End Description</th>
                                    <th>Description</th>
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

@push('modal_detail')
<div id="form-segment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-segment-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="segment_id" id="segment_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Detail Segment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('start_date', trans('Start Date'), ['class' => 'control-label']) !!}
                            {!! Form::text('start_date', old('start_date') , ['class' => 'form-control', 'placeholder' => 'Input the Start Date', 'id' => 'start_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('end_date', trans('End Date'), ['class' => 'control-label']) !!}
                            {!! Form::text('end_date', old('end_date') , ['class' => 'form-control', 'placeholder' => 'Input the End Date', 'id' => 'end_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('start_description', trans('Start Description'), ['class' => 'control-label']) !!}
                            {!! Form::text('start_description', old('start_description') , ['class' => 'form-control', 'placeholder' => 'Input the Start Description', 'rows' => '3x5', 'id' => 'start_description']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('end_description', trans('End Descripton'), ['class' => 'control-label']) !!}
                            {!! Form::text('end_description', old('end_description') , ['class' => 'form-control', 'placeholder' => 'Input the End Descripton', 'rows' => '3x5', 'id' => 'end_description']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('description', trans('Descripton'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Descripton','rows' => '3x6', 'id' => 'description']) !!}
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="modal-footer">
                <a id="form-segment-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-segment-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush