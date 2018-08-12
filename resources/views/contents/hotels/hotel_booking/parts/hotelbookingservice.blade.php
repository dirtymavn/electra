<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotelbookingservice col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotelbookingservice-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Service code</th>
                                    <th>Service description</th>
                                    <th>Quantity</th>
                                    <th>Quantity order</th>
                                    <th>Order date</th>
                                    <th>Total sales</th>
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
<div id="form-hotelbookingservice" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotelbookingservice-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="hotelbookingservice_id" id="hotelbookingservice_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Tour folder Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('id_hotel_service', trans('Hotel service'), ['class' => 'control-label']) !!}
							{!! Form::select('id_hotel_service', @$datahotelservice, old('id_hotel_service'), ['placeholder' => 'Chose service', 'class' => 'form-control id_hotel_service']) !!}
						</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('service_code', trans('Service code'), ['class' => 'control-label']) !!}
                            {!! Form::text('service_code', old('service_code'), [ 'class' => 'form-control', 'placeholder' => 'Input the Service code' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('service_description', trans('Service description'), ['class' => 'control-label']) !!}
                            {!! Form::text('service_description', old('service_description'), [ 'class' => 'form-control', 'placeholder' => 'Input the Service description' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('quantity', trans('Quantity'), ['class' => 'control-label']) !!}
                            {!! Form::text('quantity', old('quantity'), [ 'class' => 'form-control', 'placeholder' => 'Input the Quantity' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('quantity_order', trans('Quantity order'), ['class' => 'control-label']) !!}
                            {!! Form::number('quantity_order', old('quantity_order'), [ 'class' => 'form-control', 'placeholder' => 'Input the Quantity order' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('order_date', trans('Order date'), ['class' => 'control-label']) !!}
                            {!! Form::date('order_date', old('order_date'), [ 'class' => 'form-control', 'placeholder' => 'Input the Order date' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('total_sales', trans('Total sales'), ['class' => 'control-label']) !!}
                            {!! Form::text('total_sales', old('total_sales'), [ 'class' => 'form-control', 'placeholder' => 'Input the Total sales' ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotelbookingservice-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush