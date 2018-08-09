<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-invoicedetail col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="invoicedetail-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Product code</th>
                                    <th>Product code desc</th>
                                    <th>Qty</th>
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
<div id="form-invoicedetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-invoicedetail-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="invoicedetail_id" id="invoicedetail_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Invoice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('product_code', trans('Product code'), ['class' => 'control-label']) !!}
                            {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product code']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('product_code_desc', trans('Product code desc'), ['class' => 'control-label']) !!}
                            {!! Form::text('product_code_desc', old('product_code_desc') , ['class' => 'form-control', 'placeholder' => 'Input the Product code desc']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('pkg_flag', trans('Pkg'), ['class' => 'control-label']) !!}
                            {!! Form::select('pkg_flag', ['1' => 'Yes', '0' => 'No'], old('pkg_flag'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('suppress_itinerary_flag', trans('Suppress itinerary'), ['class' => 'control-label']) !!}
                            {!! Form::select('suppress_itinerary_flag', ['1' => 'Yes', '0' => 'No'], old('suppress_itinerary_flag'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('qty', trans('Qty'), ['class' => 'control-label']) !!}
                            {!! Form::number('qty', old('qty') , ['class' => 'form-control', 'placeholder' => 'Input the Qty']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('sales_cur', trans('Sales cur'), ['class' => 'control-label']) !!}
                            {!! Form::text('sales_cur', old('sales_cur') , ['class' => 'form-control', 'placeholder' => 'Input the Sales cur']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('total_sales', trans('Total sales'), ['class' => 'control-label']) !!}
                            {!! Form::number('total_sales', old('total_sales') , ['class' => 'form-control', 'placeholder' => 'Input the Total sales']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('total_cost', trans('Total cost'), ['class' => 'control-label']) !!}
                            {!! Form::number('total_cost', old('total_cost') , ['class' => 'form-control', 'placeholder' => 'Input the Total cost']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('gp_amt', trans('Gp amt'), ['class' => 'control-label']) !!}
                            {!! Form::number('gp_amt', old('gp_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Gp amt']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('gp_percentage', trans('Gp percentage'), ['class' => 'control-label']) !!}
                            {!! Form::number('gp_percentage', old('gp_percentage') , ['class' => 'form-control', 'placeholder' => 'Input the Gp percentage']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('pax1', trans('Pax 1'), ['class' => 'control-label']) !!}
                            {!! Form::number('pax1', old('pax1') , ['class' => 'form-control', 'placeholder' => 'Input the Pax 1']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('pax2', trans('Pax 2'), ['class' => 'control-label']) !!}
                            {!! Form::number('pax2', old('pax2') , ['class' => 'form-control', 'placeholder' => 'Input the Pax 2']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('unit_sales', trans('Unit sales'), ['class' => 'control-label']) !!}
                            {!! Form::number('unit_sales', old('unit_sales') , ['class' => 'form-control', 'placeholder' => 'Input the Unit sales']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('unit_cost', trans('Unit cost'), ['class' => 'control-label']) !!}
                            {!! Form::number('unit_cost', old('unit_cost') , ['class' => 'form-control', 'placeholder' => 'Input the Unit cost']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('unit_cost_tax', trans('Unit cost tax'), ['class' => 'control-label']) !!}
                            {!! Form::number('unit_cost_tax', old('unit_cost_tax') , ['class' => 'form-control', 'placeholder' => 'Input the Unit cost tax']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('commission_rate', trans('Commission rate'), ['class' => 'control-label']) !!}
                            {!! Form::number('commission_rate', old('commission_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Commission rate']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('commission', trans('Commission'), ['class' => 'control-label']) !!}
                            {!! Form::number('commission', old('commission') , ['class' => 'form-control', 'placeholder' => 'Input the Commission']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('discount_rate', trans('Discount rate'), ['class' => 'control-label']) !!}
                            {!! Form::number('discount_rate', old('discount_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Discount rate']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('discount', trans('Discount'), ['class' => 'control-label']) !!}
                            {!! Form::number('discount', old('discount') , ['class' => 'form-control', 'placeholder' => 'Input the Discount']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('rebate_rate', trans('Rebate rate'), ['class' => 'control-label']) !!}
                            {!! Form::number('rebate_rate', old('rebate_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate rate']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('rebate', trans('Rebate'), ['class' => 'control-label']) !!}
                            {!! Form::number('rebate', old('rebate') , ['class' => 'form-control', 'placeholder' => 'Input the Rebate']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-invoicedetail-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush