<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-fitfolderservice col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="fitfolderservice-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Service type</th>
                                    <th>Charge method</th>
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
<div id="form-fitfolderservice" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-fitfolderservice-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="fitfolderservice_id" id="fitfolderservice_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Fit folder Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('id_product', trans('Product'), ['class' => 'control-label']) !!}
                            {!! Form::select('id_product', @$datainventory, old('id_product'), ['class' => 'form-control', 'id' => 'inventory']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('service_type', trans('Service type'), ['class' => 'control-label']) !!}
                            {!! Form::select('service_type', ['ticket' => 'ticket', 'land' => 'land'], old('service_type'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('charge_method', trans('Charge method'), ['class' => 'control-label']) !!}
                            {!! Form::select('charge_method', ['per group' => 'per group', 'per pax' => 'per pax'], old('charge_method'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('id_currency', trans('Currency'), ['class' => 'control-label']) !!}
                            {!! Form::select('id_currency', @$datacurrency, old('id_currency'), ['class' => 'form-control', 'placeholder' => 'Choose Currency']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('id_supplier', trans('Supplier'), ['class' => 'control-label']) !!}
                            {!! Form::select('id_supplier', @$suppliers, old('id_supplier'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('notes', trans('Notes'), ['class' => 'control-label']) !!}
                            {!! Form::text('notes', old('notes') , ['class' => 'form-control', 'placeholder' => 'Input the Notes']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-fitfolderservice-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush