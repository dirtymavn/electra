<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-sales col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="sales-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Product Code</th>
                                    <th>Passenger Class Code</th>
                                    <th>Is Group Flag</th>
                                    <th>Is Supperss Flag</th>
                                    <th>Is Pax Sup</th>
                                    <th>Is Group Item</th>
                                    <th>PNR No</th>
                                    <th>DK No</th>
                                    <th>Airline Form</th>
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
<div id="form-sales-trx" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-sales-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="sales_id" id="sales_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Sales Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('product_code', trans('Product Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product Code', 'id' => 'product_code']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('passenger_class_code', trans('Passenger Class Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('passenger_class_code', old('passenger_class_code') , ['class' => 'form-control', 'placeholder' => 'Input the Passenger Class Code', 'id' => 'hotel_name']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('is_group_flag', trans('Is Group Flag'), ['class' => 'control-label']) !!}
                            {!! Form::select('is_group_flag', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_group_flag'), ['class' => 'form-control', 'placeholder' => 'Choose Is Group Flag']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('is_supperss_flag', trans('Is Supperss Flag'), ['class' => 'control-label']) !!}
                            {!! Form::select('is_supperss_flag', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_supperss_flag'), ['class' => 'form-control', 'placeholder' => 'Choose Is Supperss Flag']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('is_pax_sup', trans('Is Pax Sup'), ['class' => 'control-label']) !!}
                            {!! Form::select('is_pax_sup', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_pax_sup'), ['class' => 'form-control', 'placeholder' => 'Choose Is Pax Sup']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('is_group_item', trans('Is Group Item'), ['class' => 'control-label']) !!}
                            {!! Form::select('is_group_item', [ 'true' => 'TRUE', 'false' => 'FALSE' ], old('is_group_item'), ['class' => 'form-control', 'placeholder' => 'Choose Is Group Item']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pnr_no', trans('Pnr No'), ['class' => 'control-label']) !!}
                            {!! Form::text('pnr_no', old('pnr_no') , ['class' => 'form-control', 'placeholder' => 'Input the Pnr No', 'id' => 'pnr_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('dk_no', trans('DK No'), ['class' => 'control-label']) !!}
                            {!! Form::text('dk_no', old('dk_no') , ['class' => 'form-control', 'placeholder' => 'Input the DK No', 'id' => 'dk_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('airline_form', trans('Airline Form'), ['class' => 'control-label']) !!}
                            {!! Form::text('airline_form', old('airline_form') , ['class' => 'form-control', 'placeholder' => 'Input the Airline Form', 'id' => 'airline_form']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sales_type', trans('Sales Type'), ['class' => 'control-label']) !!}
                            {!! Form::text('sales_type', old('sales_type') , ['class' => 'form-control', 'placeholder' => 'Input the Sales Type', 'id' => 'sales_type']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('confirm_by', trans('Confirm By'), ['class' => 'control-label']) !!}
                            {!! Form::text('confirm_by', old('confirm_by') , ['class' => 'form-control', 'placeholder' => 'Input the Confirm By', 'id' => 'confirm_by']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('confirm_date', trans('Confirm Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('confirm_date', old('confirm_date') , ['class' => 'form-control', 'placeholder' => 'Input the Confirm Date', 'id' => 'confirm_date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('mpd_no', trans('MPD No'), ['class' => 'control-label']) !!}
                            {!! Form::text('mpd_no', old('mpd_no') , ['class' => 'form-control', 'placeholder' => 'Input the MPD No', 'id' => 'mpd_no']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('sales_detail_remark', trans('Sales Detail Remark'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('sales_detail_remark', old('sales_detail_remark') , ['class' => 'form-control', 'placeholder' => 'Input the Sales Detail Remark','rows' => '3x6', 'id' => 'sales_detail_remark']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="form-sales-trx-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-sales-trx-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush
