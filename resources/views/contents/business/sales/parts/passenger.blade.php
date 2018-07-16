<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-passenger col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="passenger-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Passenger Name</th>
                                    <th>Ticket No</th>
                                    <th>Conj Ticket No</th>
                                    
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
<div id="form-passenger" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-passenger-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="passenger_id" id="passenger_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Detail Passenger</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('passenger_name', trans('Passenger Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('passenger_name', old('passenger_name') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Name', 'id' => 'passenger_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ticket_no', trans('Ticket No'), ['class' => 'control-label']) !!}
                            {!! Form::text('ticket_no', old('ticket_no') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket No', 'id' => 'ticket_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('conj_ticket_no', trans('Conj Ticket No'), ['class' => 'control-label']) !!}
                            {!! Form::text('conj_ticket_no', old('conj_ticket_no') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket No', 'id' => 'conj_ticket_no']) !!}
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="modal-footer">
                <a id="form-passenger-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-passenger-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush