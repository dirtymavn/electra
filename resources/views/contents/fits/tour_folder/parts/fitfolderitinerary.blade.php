<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-fitfolderitinerary col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="fitfolderitinerary-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Day</th>
                                    <th>Itinerary code</th>
                                    <th>description</th>
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
<div id="form-fitfolderitinerary" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-fitfolderitinerary-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="fitfolderitinerary_id" id="fitfolderitinerary_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Tour folder itinerary</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('day', trans('Day'), ['class' => 'control-label']) !!}
                            {!! Form::number('day', old('day') , ['class' => 'form-control', 'placeholder' => 'Input the Day']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('itinerary_code', trans('Itinerary code'), ['class' => 'control-label']) !!}
                            {!! Form::text('itinerary_code', old('itinerary_code') , ['class' => 'form-control', 'placeholder' => 'Input the Itinerary code']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('city', trans('City'), ['class' => 'control-label']) !!}
                            {!! Form::select('city', ['1' => 'Yes', '0' => 'No'], old('city'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
                            {!! Form::text('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Description']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('operator', trans('Operator'), ['class' => 'control-label']) !!}
                            {!! Form::select('operator', @$suppliers, old('operator'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('breakfast', trans('Breakfast'), ['class' => 'control-label']) !!}
                            {!! Form::text('breakfast', old('breakfast') , ['class' => 'form-control', 'placeholder' => 'Input the Breakfast']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('lunch', trans('Lunch'), ['class' => 'control-label']) !!}
                            {!! Form::text('lunch', old('lunch') , ['class' => 'form-control', 'placeholder' => 'Input the Lunch']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('dinner', trans('Dinner'), ['class' => 'control-label']) !!}
                            {!! Form::text('dinner', old('dinner') , ['class' => 'form-control', 'placeholder' => 'Input the Dinner']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('accomodation', trans('Accomodation'), ['class' => 'control-label']) !!}
                            {!! Form::text('accomodation', old('accomodation') , ['class' => 'form-control', 'placeholder' => 'Input the Accomodation']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('notes', trans('Notes'), ['class' => 'control-label']) !!}
                            {!! Form::text('notes', old('notes') , ['class' => 'form-control', 'placeholder' => 'Input the Notes']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('transport_detail', trans('Transport detail'), ['class' => 'control-label']) !!}
                            {!! Form::text('transport_detail', old('transport_detail') , ['class' => 'form-control', 'placeholder' => 'Input the Transport detail']) !!}
                        </div>
                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-fitfolderitinerary-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush