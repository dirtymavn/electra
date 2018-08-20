<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotelbookingpax col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotelbookingpax-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Title</th>
                                    <th>Pax name</th>
                                    <th>Type</th>
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
<div id="form-hotelbookingpax" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotelbookingpax-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="hotelbookingpax_id" id="hotelbookingpax_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Tour folder Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
							{!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
							{!! Form::text('title', old('title'), [ 'class' => 'form-control', 'placeholder' => 'Input the Title' ]) !!}
						</div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
							{!! Form::label('pax_name', trans('Pax name'), ['class' => 'control-label']) !!}
							{!! Form::text('pax_name', old('pax_name'), [ 'class' => 'form-control', 'placeholder' => 'Input the Pax name' ]) !!}
						</div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
                            {!! Form::select('type', ['banyak' => 'banyak', 'adult' => 'adult', 'child' => 'child', 'dll' => 'dll'], old('type'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('id_nationality', trans('Nationality'), ['class' => 'control-label']) !!}
                            {!! Form::select('id_nationality', ['' => 'Choose Nationality'] + @$countries, old('id_nationality'), ['class' => 'form-control id_nationality']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotelbookingpax-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush