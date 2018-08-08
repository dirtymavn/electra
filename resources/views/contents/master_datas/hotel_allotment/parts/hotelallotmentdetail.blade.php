<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotel-allotmentdetail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotel-allotmentdetail-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Date</th>
                                    <th>Available room smooking</th>
                                    <th>Available room non smooking</th>
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
<div id="form-hotel-allotmentdetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotel-allotmentdetail-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="hotel_allotmentdetail_id" id="hotel_allotmentdetail_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Hotel Allotment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('date', old('date') , ['class' => 'form-control', 'placeholder' => 'Input the start date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('available_room_smooking', trans('Available room smooking'), ['class' => 'control-label']) !!}
                            {!! Form::number('available_room_smooking', old('available_room_smooking') , ['class' => 'form-control', 'placeholder' => 'Input the available_room_smooking', 'id' => 'available_room_smooking']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('available_room_non_smooking', trans('Available room non smooking'), ['class' => 'control-label']) !!}
                            {!! Form::number('available_room_non_smooking', old('available_room_non_smooking') , ['class' => 'form-control', 'placeholder' => 'Input the available_room_non_smooking', 'id' => 'available_room_non_smooking']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotel-allotmentdetail-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush