<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-visadocument col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="visadocument-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Document type</th>
                                    <th>Document uri</th>
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
<div id="form-visadocument" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-visadocument-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="visadocument_id" id="visadocument_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Visa Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('document_type', trans('Document type'), ['class' => 'control-label']) !!}
                            {!! Form::text('document_type', old('document_type'), [ 'class' => 'form-control', 'placeholder' => 'Input the Document type' ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
							{!! Form::label('document_uri', trans('Document uri'), ['class' => 'control-label']) !!}
							{!! Form::text('document_uri', old('document_uri'), [ 'class' => 'form-control', 'placeholder' => 'Input the Document uri' ]) !!}
						</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-visadocument-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush