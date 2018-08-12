<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotelbookingdetail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotelbookingdetail-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Room type</th>
                                    <th>Room category</th>
                                    <th>Room number</th>
                                    <th>Night</th>
                                    <th>Price per night</th>
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
<div id="form-hotelbookingdetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotelbookingdetail-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="hotelbookingdetail_id" id="hotelbookingdetail_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Tour folder Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('id_room_type', trans('Room type'), ['class' => 'control-label']) !!}
							{!! Form::select('id_room_type', @$dataroomtype, old('id_room_type'), ['class' => 'form-control id_room_type']) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('id_room_category', trans('Room category'), ['class' => 'control-label']) !!}
							{!! Form::select('id_room_category', @$dataroomcategory, old('id_room_category'), ['class' => 'form-control id_room_category']) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('room_number', trans('Room number'), ['class' => 'control-label']) !!}
							{!! Form::text('room_number', old('room_number'), [ 'class' => 'form-control', 'placeholder' => 'Input the Room number' ]) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('night', trans('Night'), ['class' => 'control-label']) !!}
							{!! Form::text('night', old('night'), [ 'class' => 'form-control', 'placeholder' => 'Input the night' ]) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('price_per_night', trans('Price per night'), ['class' => 'control-label']) !!}
							{!! Form::number('price_per_night', old('price_per_night'), [ 'class' => 'form-control', 'placeholder' => 'Input the Price per night' ]) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('include_breakfast', trans('Include breakfast'), ['class' => 'control-label']) !!}
							{!! Form::select('include_breakfast', ['1' => 'Yes', '0' => 'No'], old('include_breakfast'), ['class' => 'form-control']) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('non_smooking', trans('Non smooking'), ['class' => 'control-label']) !!}
							{!! Form::select('non_smooking', ['1' => 'Yes', '0' => 'No'], old('non_smooking'), ['class' => 'form-control']) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('high_floor', trans('High floor'), ['class' => 'control-label']) !!}
							{!! Form::select('high_floor', ['1' => 'Yes', '0' => 'No'], old('high_floor'), ['class' => 'form-control']) !!}
						</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotelbookingdetail-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush