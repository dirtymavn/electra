<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-tourfolderrate col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tourfolderrate-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Customer type</th>
                                    <th>Price type</th>
                                    <th>Group size</th>
                                    <th>Price</th>
                                    <th>Discount</th>
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
<div id="form-tourfolderrate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-tourfolderrate-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="tourfolderrate_id" id="tourfolderrate_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Tour folder rate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('customer_type', trans('Customer type'), ['class' => 'control-label']) !!}
                            {!! Form::select('customer_type', ['fit' => 'fit', 'agent' => 'agent', 'commercial' => 'commercial'], old('customer_type'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('price_type', trans('Price type'), ['class' => 'control-label']) !!}
                            {!! Form::select('price_type', ['normal tour' => 'normal tour', 'ticket only' => 'ticket only', 'land only' => 'land only'], old('price_type'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('group_size', trans('Group size'), ['class' => 'control-label']) !!}
                            {!! Form::number('group_size', old('group_size') , ['class' => 'form-control', 'placeholder' => 'Input the Group size']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('price', trans('Price'), ['class' => 'control-label']) !!}
                            {!! Form::number('price', old('price') , ['class' => 'form-control', 'placeholder' => 'Input the Price']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('discount', trans('Discount'), ['class' => 'control-label']) !!}
                            {!! Form::number('discount', old('discount') , ['class' => 'form-control', 'placeholder' => 'Input the Discount']) !!}
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-tourfolderrate-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush