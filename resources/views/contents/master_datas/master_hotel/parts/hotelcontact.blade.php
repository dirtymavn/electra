<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-hotel-contact col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="hotel-contact-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>title</th>
                                    <th>name</th>
                                    <th>phone</th>
                                    <th>fax</th>
                                    <th>email</th>
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
<div id="form-hotel-contact" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-hotel-contact-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="hotel_contact_id" id="hotel_contact_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Hotel Contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
                            {!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Input the title', 'id' => 'title']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the name', 'id' => 'name']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone', trans('Phone'), ['class' => 'control-label']) !!}
                            {!! Form::text('phone', old('phone') , ['class' => 'form-control', 'placeholder' => 'Input the phone', 'id' => 'phone']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('fax', trans('fax'), ['class' => 'control-label']) !!}
                            {!! Form::text('fax', old('fax') , ['class' => 'form-control', 'placeholder' => 'Input the fax', 'id' => 'fax']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('email', trans('email'), ['class' => 'control-label']) !!}
                            {!! Form::text('email', old('email') , ['class' => 'form-control', 'placeholder' => 'Input the email', 'id' => 'email']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-hotel-contact-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endpush