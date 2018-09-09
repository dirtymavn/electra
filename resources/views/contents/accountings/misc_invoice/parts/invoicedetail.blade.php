@push('models')
<div id="form-invoicedetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-invoicedetail-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="invoicedetail_id" id="invoicedetail_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">New Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('product_code', trans('Product code'), ['class' => 'control-label']) !!}
                            {!! Form::text('product_code', old('product_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product code','required'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description') , ['class' => 'form-control','rows'=>4, 'placeholder' => 'Description','maxlength'=>500]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('coa_id', trans('Cost Account'), ['class' => 'control-label']) !!}
                            {!! Form::select('coa_id',[''=>'Choose COA']+ @$listCoa, old('coa_id'), [ 'class' => 'form-control','required'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('unit_cost', trans('Unit Cost'), ['class' => 'control-label']) !!}
                            {!! Form::text('unit_cost', old('unit_cost') , ['class' => 'form-control','required'=>true, 'placeholder' => 'Unit Cost']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cost_gst', trans('Cost GST'), ['class' => 'control-label']) !!}
                            {!! Form::text('cost_gst', old('cost_gst') , ['class' => 'form-control','required'=>true, 'placeholder' => 'Cost GST']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sales_id', trans('Sales A/C'), ['class' => 'control-label']) !!}
                            {!! Form::select('sales_id',[''=>'Choose Sales']+ @$listSales, old('sales_id'), [ 'class' => 'form-control','required'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('unit_price', trans('Unit Price'), ['class' => 'control-label']) !!}
                            {!! Form::text('unit_price', old('unit_price') , ['class' => 'form-control', 'placeholder' => 'Unit Price','required'=>true,'onkeyup'=>'totalSales()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('qty', trans('QTY'), ['class' => 'control-label']) !!}
                            {!! Form::number('qty', old('qty') , ['class' => 'form-control', 'placeholder' => 'Qty','required'=>true,'onkeyup'=>'totalSales()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('gst', trans('GST'), ['class' => 'control-label']) !!}
                            {!! Form::text('gst', old('gst') , ['class' => 'form-control', 'placeholder' => 'GST','required'=>true,'onkeyup'=>'totalSales()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('total_sales', trans('Total Sales'), ['class' => 'control-label']) !!}
                            {!! Form::number('total_sales', old('total_sales') , ['class' => 'form-control','required'=>true, 'placeholder' => 'Total Sales']) !!}
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