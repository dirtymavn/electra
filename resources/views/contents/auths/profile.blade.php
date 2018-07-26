@extends('layouts.app')

@section('title', 'Profile')

@section('style')
<link rel="stylesheet" href="{{ asset('themes/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" />
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item">Profile</li>
    </ul>
@endsection

@section('page_title', 'Profile')

@section('content')
    @include('flash::message')
    {!! Form::model($user, [
            'route'     =>['auth.profile.update', $user->id],
            'method'    => 'PATCH',
            'class' =>  'form-horizontal',
            'id'    =>  'form-profile',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box">
            <div class="box-body">
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
                            {!! Form::text('email', old('Email') , ['class' => 'form-control', 'placeholder' => 'Input the Email', 'readonly' => true]) !!}
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
                        <div class="form-group">
                            {!! Form::label('staff_no', trans('Staff No.'), ['class' => 'control-label']) !!}
                            {!! Form::text('staff_no', old('staff_no') , ['class' => 'form-control', 'placeholder' => 'Input the Staff No.']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('staff_fullname', trans('Staff Fullname'), ['class' => 'control-label']) !!}
                            {!! Form::text('staff_fullname', old('staff_fullname') , ['class' => 'form-control', 'placeholder' => 'Input the Staff Fullname']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                            {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', trans('Type'), ['class' => 'control-label']) !!}
                            {!! Form::text('type', old('type') , ['class' => 'form-control', 'placeholder' => 'Input the Type']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
                            {!! Form::text('title', old('title') , ['class' => 'form-control', 'placeholder' => 'Input the Title']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('home_tel', trans('Home Tel.'), ['class' => 'control-label']) !!}
                            {!! Form::text('home_tel', old('home_tel') , ['class' => 'form-control', 'placeholder' => 'Input the Home Tel.']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('mobile', trans('Mobile'), ['class' => 'control-label']) !!}
                            {!! Form::text('mobile', old('mobile') , ['class' => 'form-control', 'placeholder' => 'Input the Mobile']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('employment_date', trans('Employment Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('employment_date', old('employment_date') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('company_name', trans('Company'), ['class' => 'control-label']) !!}
                            {!! Form::text('company_name', old('company_name') , ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('id_branch', trans('ID Branch'), ['class' => 'control-label']) !!}
                            {!! Form::select('id_branch', @$branchs, old('branch_id'), ['class' => 'form-control', 'readonly' => true]) !!}   
                        </div>
                        <div class="form-group">
                            {!! Form::label('office_tel', trans('Office Tel.'), ['class' => 'control-label']) !!}
                            {!! Form::text('office_tel', old('office_tel') , ['class' => 'form-control', 'placeholder' => 'Input the Office Tel.']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fax_no', trans('Fax No.'), ['class' => 'control-label']) !!}
                            {!! Form::text('fax_no', old('fax_no') , ['class' => 'form-control', 'placeholder' => 'Input the Fax No.']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('office_address', trans('Office Address'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('office_address', old('office_address') , ['class' => 'form-control', 'placeholder' => 'Input the Office Address', 'rows' => '4']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('home_address', trans('Home Address'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('home_address', old('home_address') , ['class' => 'form-control', 'placeholder' => 'Input the Home Address', 'rows' => '4']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('remark', old('remark') , ['class' => 'form-control', 'placeholder' => 'Input the Remark', 'rows' => '4']) !!}
                        </div>
                        <div class="form-group" style="display: none;">
                            {!! Form::label('dr_account', trans('DR Account'), ['class' => 'control-label']) !!}
                            {!! Form::text('dr_account', old('dr_account') , ['class' => 'form-control', 'placeholder' => 'Input the DR Account']) !!}
                        </div>
                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
                            <label class="control-label">
                                Avatar (<small>Max. 2mb</small>)
                            </label>
                            <div class="col-sm-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img class="img-responsive" src="{{(@$user->avatar) ? get_file($user->avatar, 'thumbnail') : url('images/noimagefound.jpg')}}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-grey btn-file">
                                                <span class="fileinput-new">Choose</span>
                                                <span class="fileinput-exists">Edit</span>
                                                <input type="file" accept="image/jpg, image/png" name="avatar" value="{{@$user->avatar}}">
                                            </span>
                                            <a href="#" class="btn btn-grey fileinput-exists" data-dismiss="fileinput">Delete</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <div class="col-sm-10"> -->
                        <button type="submit" class="btn btn-primary" id="btn-submit">{{ trans('Submit') }}</button>
                    <!-- </div> -->
                </div>              
            </div>
        </div>
    </form>
@endsection

@section('script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Auth\ProfileRequest', '#form-profile') !!}

<script>
    $(document).ready(function() {
        $('#password').val('default1234');
        $('#conf_password').val('default1234');
    });
</script>
@endsection