@extends('layouts.auth')
@section('title', 'Login')

@section('body')
<div class="auth-box-w">
    <div class="logo-w">
        <a href="{{route('auth.login')}}"><img class="img-responsive" style="width:100%;" src="{{asset('themes/img/logo-big.png')}}"></a>
    </div>
    
    <div style="width:85%;margin:0 auto;">
        @include('flash::message')
    </div>
    {!! Form::open( [ 'route' => 'auth.login.store', 'id' => 'form-login' ] ) !!}
        <div class="form-group">
            <label for="">Username</label>
            {!! Form::text('username', null, [ 'class' => 'form-control', 'placeholder' => 'Enter Your Username' ]) !!}
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            {!! Form::password('password', [ 'class' => 'form-control', 'placeholder' => 'Enter Your Password' ]) !!}
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
        </div>
        <a href="{{ route('auth.forgot') }}"> Forgot Password </a>
        <div class="buttons-w">
            <button class="btn btn-primary" type="submit">Log me in</button>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox">Remember Me</label>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('script')
<!-- Laravel Javascript Validation -->
{!! JsValidator::formRequest('App\Http\Requests\Auth\LoginRequest', '#form-login') !!}
@endsection