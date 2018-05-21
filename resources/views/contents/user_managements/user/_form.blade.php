<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::label('First Name', trans('First Name'), ['class' => 'control-label']) !!}
            {!! Form::text('first_name', old('first_name') , ['class' => 'form-control', 'placeholder' => 'Input the First Name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::label('Last Name', trans('Last Name'), ['class' => 'control-label']) !!}
            {!! Form::text('last_name', old('last_name') , ['class' => 'form-control', 'placeholder' => 'Input the Last Name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
            {!! Form::label('Username', trans('Username'), ['class' => 'control-label']) !!}
            {!! Form::text('username', old('username') , ['class' => 'form-control', 'placeholder' => 'Input the Username']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', trans('Email'), ['class' => 'control-label']) !!}
            {!! Form::text('email', old('Email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
        </div>
    </div>
    <div class="col-sm-6 password-user">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            {!! Form::label('password', trans('Password'), ['class' => 'control-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input the Password']) !!}
        </div>

        <div class="form-group {{ $errors->has('conf_password') ? 'has-error' : ''}}">
            {!! Form::label('conf_password', trans('Confirmation Password'), ['class' => 'control-label']) !!}
            {!! Form::password('conf_password', ['class' => 'form-control', 'placeholder' => 'Input the Confirmation Password']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
            {!! Form::label('company_id', trans('Company ID'), ['class' => 'control-label']) !!}
            {!! Form::select('company_id', ['' => "Choose Company"] + @$companies, old('company_id'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<input type="hidden" name="is_required" class="is-required-password" value="requirred">

@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\UserManagement\UserRequest', '#form-user') !!}
<script>
    $(document).ready(function() {
        @if(@$user->id)
            $('.password-user').remove();
            $('.is-required-password').val('not_required');
        @endif
    });
</script>
@endsection