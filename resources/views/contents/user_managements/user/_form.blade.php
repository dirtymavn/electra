<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::label('First Name', trans('First Name'), ['class' => 'col-sm-6 control-label']) !!}
            {!! Form::text('first_name', old('first_name') , ['class' => 'form-control', 'placeholder' => 'Input the First Name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::label('Last Name', trans('Last Name'), ['class' => 'col-sm-6 control-label']) !!}
            {!! Form::text('last_name', old('last_name') , ['class' => 'form-control', 'placeholder' => 'Input the Last Name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
            {!! Form::label('Username', trans('Username'), ['class' => 'col-sm-6 control-label']) !!}
            {!! Form::text('username', old('username') , ['class' => 'form-control', 'placeholder' => 'Input the Username']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', trans('Email'), ['class' => 'col-sm-6 control-label']) !!}
            {!! Form::text('email', old('Email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            {!! Form::label('password', trans('Password'), ['class' => 'col-sm-6 control-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input the Password']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
            {!! Form::label('company_id', trans('Company ID'), ['class' => 'col-sm-6 control-label']) !!}
            {!! Form::text('company_id', null ,['class' => 'form-control', 'placeholder' => 'Input the Company ID']) !!}
        </div>
    </div>
</div>


@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\UserManagement\UserRequest', '#form-user') !!}
@endsection