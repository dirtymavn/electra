<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-cost col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="cost-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Pay AMT</th>
                                    <th>Currency Code ID</th>
                                    <th>Supplier Reference ID</th>
                                    <th>Voucher Reference ID</th>
                                    
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
<div id="form-cost" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-cost-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="cost_id" id="cost_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Detail Cost</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pay_amt', trans('Pay AMT'), ['class' => 'control-label']) !!}
                            {!! Form::number('pay_amt', old('pay_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Pay AMT', 'id' => 'pay_amt']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('currency_code_id', trans('Currency Code'), ['class' => 'control-label']) !!}
                            {!! Form::text('currency_code_id', old('currency_code_id') , ['class' => 'form-control', 'placeholder' => 'Input the Currency Code', 'id' => 'currency_code_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('supplier_reference_id', trans('Supplier Reference ID'), ['class' => 'control-label']) !!}
                            {!! Form::text('supplier_reference_id', old('supplier_reference_id') , ['class' => 'form-control', 'placeholder' => 'Input the Supplier Reference ID', 'id' => 'supplier_reference_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('voucher_reference_id', trans('Voucher Reference ID'), ['class' => 'control-label']) !!}
                            {!! Form::text('voucher_reference_id', old('voucher_reference_id') , ['class' => 'form-control', 'placeholder' => 'Input the Voucher Reference ID', 'id' => 'voucher_reference_id']) !!}
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="modal-footer">
                <a id="form-cost-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-cost-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush