<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-mis col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="mis-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Lowest Fare Rejection</th>
                                    <th>Destination</th>
                                    <th>Deal Code</th>
                                    <th>Region Code</th>
                                    <th>Realised Saving Code</th>
                                    <th>Iata No</th>
                                    <th>Fare Type ID</th>
                                    
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
<div id="form-mis" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-mis-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="mis_id" id="mis_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Detail Mis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('lowest_fare_rejection', trans('Lowest Fare Rejection'), ['class' => 'control-label']) !!}
                            {!! Form::text('lowest_fare_rejection', old('lowest_fare_rejection') , ['class' => 'form-control', 'placeholder' => 'Input the Lowest Fare Rejection', 'id' => 'lowest_fare_rejection']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('destination_id', trans('Destination'), ['class' => 'control-label']) !!}
                            {!! Form::text('destination_id', old('destination_id') , ['class' => 'form-control', 'placeholder' => 'Input the Destination', 'id' => 'destination_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('deal_code', trans('Deal Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('deal_code', old('deal_code') , ['class' => 'form-control', 'placeholder' => 'Input the Deal Code', 'id' => 'deal_code']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('region_code_id', trans('Region Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('region_code_id', old('region_code_id') , ['class' => 'form-control', 'placeholder' => 'Input the Region Code', 'id' => 'region_code_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('realised_saving_code', trans('Realised Saving Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('realised_saving_code', old('realised_saving_code') , ['class' => 'form-control', 'placeholder' => 'Input the Realised Saving Code', 'id' => 'realised_saving_code']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('iata_no', trans('Iata No'), ['class' => 'control-label']) !!}
                            {!! Form::text('iata_no', old('iata_no') , ['class' => 'form-control', 'placeholder' => 'Input the Iata No', 'id' => 'iata_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('fare_type_id', trans('Fare Type ID'), ['class' => 'control-label']) !!}
                            {!! Form::text('fare_type_id', old('fare_type_id') , ['class' => 'form-control', 'placeholder' => 'Input the Fare Type ID', 'id' => 'fare_type_id']) !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a id="form-mis-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-mis-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush