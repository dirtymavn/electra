<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-tourfolderguide col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tourfolderguide-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>From date</th>
                                    <th>To date</th>
                                    <th>Guide number</th>
                                    <th>title</th>
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
<div id="form-tourfolderguide" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-tourfolderguide-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="tourfolderguide_id" id="tourfolderguide_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Tour folder guide</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('id_tour_guide', trans('Tour guide'), ['class' => 'control-label']) !!}
                            {!! Form::select('id_tour_guide', @$dataguide, old('id_tour_guide'), ['class' => 'form-control id_tour_guide', 'placeholder' => 'Choose Guide']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('from_date', trans('From date'), ['class' => 'control-label']) !!}
                            {!! Form::date('from_date', old('from_date') , ['class' => 'form-control', 'placeholder' => 'Input the From date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('to_date', trans('To date'), ['class' => 'control-label']) !!}
                            {!! Form::date('to_date', old('to_date') , ['class' => 'form-control', 'placeholder' => 'Input the To date']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('guide_number', trans('Guide number'), ['class' => 'control-label']) !!}
                            {!! Form::text('guide_number', old('guide_number') , ['class' => 'form-control', 'placeholder' => 'Input the Guide number']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
                            {!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Input the Title']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the name']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('notes', trans('Notes'), ['class' => 'control-label']) !!}
                            {!! Form::text('notes', old('notes') , ['class' => 'form-control', 'placeholder' => 'Input the notes']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('cash_advance', trans('Cash advance'), ['class' => 'control-label']) !!}
                            {!! Form::text('cash_advance', old('cash_advance') , ['class' => 'form-control', 'placeholder' => 'Input the cash_advance']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('cash_return', trans('Cash return'), ['class' => 'control-label']) !!}
                            {!! Form::text('cash_return', old('cash_return') , ['class' => 'form-control', 'placeholder' => 'Input the Cash return']) !!}
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-tourfolderguide-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush