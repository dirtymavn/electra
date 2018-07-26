<div class="row">
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
            {!! Form::label('First Name', trans('First Name'), ['class' => 'control-label']) !!}
            {!! Form::text('first_name', old('first_name') , ['class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Input the First Name']) !!}
        </div>
        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
            {!! Form::label('Last Name', trans('Last Name'), ['class' => 'control-label']) !!}
            {!! Form::text('last_name', old('last_name') , ['class' => 'form-control', 'maxlength' => '100', 'placeholder' => 'Input the Last Name']) !!}
        </div>
        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
            {!! Form::label('Username', trans('Username'), ['class' => 'control-label']) !!}
            {!! Form::text('username', old('username') , ['class' => 'form-control', 'maxlength' => '20', 'placeholder' => 'Input the Username']) !!}
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', trans('Email'), ['class' => 'control-label']) !!}
            {!! Form::text('email', old('Email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
        </div>
        <div class="password-user">
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', trans('Password'), ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input the Password']) !!}
            </div>

            <div class="form-group {{ $errors->has('conf_password') ? 'has-error' : ''}}">
                {!! Form::label('conf_password', trans('Confirmation Password'), ['class' => 'control-label']) !!}
                {!! Form::password('conf_password', ['class' => 'form-control', 'placeholder' => 'Input the Confirmation Password']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
            {!! Form::label('company_id', trans('Company'), ['class' => 'control-label']) !!}
            {!! Form::select('company_id', ['' => "Choose Company"] + @$companies, old('company_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('branch_id') ? 'has-error' : ''}}">
            {!! Form::label('branch_id', trans('Branch'), ['class' => 'control-label']) !!}
            {!! Form::select('branch_id', ['' => "Choose Branch"] + @$branchs, old('branch_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group {{ $errors->has('company_department_id') ? 'has-error' : ''}}">
            {!! Form::label('company_department_id', trans('Department'), ['class' => 'control-label']) !!}
            {!! Form::select('company_department_id', ['' => "Choose Department"] + @$departments, old('company_department_id'), ['class' => 'form-control']) !!}
        </div>
        {{-- @if(user_info()->id != 1) --}}
            <div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">
                {!! Form::label('role_id', trans('Role'), ['class' => 'control-label']) !!}
                {!! Form::select('role_id', ['' => "Choose Role"] + @$roles, old('role_id'), ['class' => 'form-control']) !!}
            </div>
        {{-- @endif --}}
    </div>
</div>

<input type="hidden" name="is_required" class="is-required-password" value="requirred">
<input type="hidden" name="company_role" value="{{ user_info('company_role') }}">

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

        initSelect2Remote($('#company_id'), "{{ route('company.search-data') }}", "Choose Company", 0);
        initSelect2Remote($('#branch_id'), "{{ route('branch.search-data') }}", "Choose Branch", 0);
        initSelect2Remote($('#company_department_id'), "{{ route('department.search-data') }}", "Choose Department", 0);
        initSelect2Remote($('#role_id'), "{{ route('role.search-data') }}", "Choose Role", 0, true);

    });
</script>
@endsection