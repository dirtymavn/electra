<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('Name'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the name']) !!}
        
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', trans('Description'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the description (max. 160 chars)', 'rows' => '3', 'maxlength' => '160']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', trans('Image'), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: auto;">
                <img src="{{(@$masterTryOut->image) ? get_file($masterTryOut->image, 'thumbnail') : url('images/noimagefound.jpg')}}">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
            <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-new">Choose</span>
                    <span class="fileinput-exists">Edit</span>
                    <input type="file" accept="image/jpg, image/png" name="image" value="{{@$masterTryOut->image}}">
                </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Delete</a>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\UserManagement\UserRequest', '#form-user') !!}
@endsection