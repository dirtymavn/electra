<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-price col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="price-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Billing Currency ID</th>
                                    <th>GST ID</th>
                                    <th>GST Percent</th>
                                    <th>GST AMT</th>
                                    <th>Rebate Percent</th>
                                    <th>Rebate AMT</th>
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

@push('modal_detail')
<div id="form-price" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-price-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="price_id" id="price_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Detail Price</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('billing_currency_id', trans('Billing Currency ID'), ['class' => 'control-label']) !!}
                            {!! Form::number('billing_currency_id', old('billing_currency_id') , ['class' => 'form-control', 'placeholder' => 'Input the Billing Currency ID', 'id' => 'billing_currency_id']) !!}
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate AMT', 'id' => 'description', 'rows' => '3x5']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('gst_id', trans('GST ID'), ['class' => 'control-label']) !!}
                            {!! Form::number('gst_id', old('gst_id') , ['class' => 'form-control', 'placeholder' => 'Input the GST ID', 'id' => 'gst_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('gst_percent', trans('GST Percent'), ['class' => 'control-label']) !!}
                            {!! Form::number('gst_percent', old('gst_percent') , ['class' => 'form-control', 'placeholder' => 'Input the GST Percent', 'id' => 'gst_percent']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('gst_amt', trans('GST AMT'), ['class' => 'control-label']) !!}
                            {!! Form::number('gst_amt', old('gst_amt') , ['class' => 'form-control', 'placeholder' => 'Input the GST AMT', 'id' => 'gst_amt']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('rebate_percent', trans('Rebate Percent'), ['class' => 'control-label']) !!}
                            {!! Form::number('rebate_percent', old('rebate_percent') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate Percent', 'id' => 'rebate_percent']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('rebate_amt', trans('Rebate AMT'), ['class' => 'control-label']) !!}
                            {!! Form::number('rebate_amt', old('rebate_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate AMT', 'id' => 'rebate_amt']) !!}
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="modal-footer">
                <a id="form-price-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-price-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush