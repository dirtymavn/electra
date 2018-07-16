<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotel col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotel-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>City</th>
                                    <th>Hotel Name</th>
                                    <th>Hotel Chain</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Checkin Date</th>
                                    <th>Checkout Date</th>
                                    <th>Ref Code</th>
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
<div id="form-hotel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotel-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="route_hotel_id" id="route_hotel_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Route Hotel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('hotel_name', trans('Hotel Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('hotel_name', old('hotel_name') , ['class' => 'form-control', 'placeholder' => 'Input the Hotel Name', 'id' => 'hotel_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('hotel_chain', trans('Hotel Chain'), ['class' => 'control-label']) !!}
                            {!! Form::text('hotel_chain', old('hotel_chain') , ['class' => 'form-control', 'placeholder' => 'Input the Hotel Chain', 'id' => 'hotel_chain']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('hotel_city', trans('City'), ['class' => 'control-label']) !!}
                            {!! Form::text('hotel_city', old('hotel_city') , ['class' => 'form-control', 'placeholder' => 'Input the City', 'id' => 'hotel_city']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('hotel_status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::text('hotel_status', old('hotel_status') , ['class' => 'form-control', 'placeholder' => 'Input the Status', 'id' => 'hotel_status']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('phone', trans('Phone'), ['class' => 'control-label']) !!}
                            {!! Form::text('phone', old('phone') , ['class' => 'form-control', 'placeholder' => 'Input the Phone', 'id' => 'phone']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('fax', trans('Fax'), ['class' => 'control-label']) !!}
                            {!! Form::text('fax', old('fax') , ['class' => 'form-control', 'placeholder' => 'Input the Fax', 'id' => 'fax']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('checkin_date', trans('Checkin Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('checkin_date', old('checkin_date') , ['class' => 'form-control', 'placeholder' => 'Input the Checkin Date', 'id' => 'checkin_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('checkout_date', trans('Checkout Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('checkout_date', old('checkout_date') , ['class' => 'form-control', 'placeholder' => 'Input the Checkout Date', 'id' => 'checkout_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('rm_type', trans('RM Type'), ['class' => 'control-label']) !!}
                            {!! Form::text('rm_type', old('rm_type') , ['class' => 'form-control', 'placeholder' => 'Input the RM Type', 'id' => 'rm_type']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('rm_cat', trans('RM Cat'), ['class' => 'control-label']) !!}
                            {!! Form::text('rm_cat', old('rm_cat') , ['class' => 'form-control', 'placeholder' => 'Input the RM Cat', 'id' => 'rm_cat']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('guest_prm', trans('Guest PRM'), ['class' => 'control-label']) !!}
                            {!! Form::text('guest_prm', old('guest_prm') , ['class' => 'form-control', 'placeholder' => 'Input the Guest PRM', 'id' => 'guest_prm']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('meals', trans('Meals'), ['class' => 'control-label']) !!}
                            {!! Form::text('meals', old('meals') , ['class' => 'form-control', 'placeholder' => 'Input the Meals', 'id' => 'meals']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('other_svc', trans('Other SVC'), ['class' => 'control-label']) !!}
                            {!! Form::text('other_svc', old('other_svc') , ['class' => 'form-control', 'placeholder' => 'Input the Other SVC', 'id' => 'other_svc']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('ref_code', trans('Ref Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('ref_code', old('ref_code') , ['class' => 'form-control', 'placeholder' => 'Input the Ref Code', 'id' => 'ref_code']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('confirmation_code', trans('Confirmation Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('confirmation_code', old('confirmation_code') , ['class' => 'form-control', 'placeholder' => 'Input the Confirmation Code', 'id' => 'confirmation_code']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('address', old('address') , ['class' => 'form-control', 'placeholder' => 'Input the Address', 'rows' => '2x5', 'id' => 'address']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('remark', trans('remark'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the remark', 'rows' => '2x5', 'id' => 'remark']) !!}
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <a id="form-hotel-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotel-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush