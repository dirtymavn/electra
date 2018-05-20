@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('body')
<div class="auth-box-w">
    <div class="logo-w">
        <a href="{{route('auth.login')}}"><img alt="" src="{{asset('themes/img/logo-big.png')}}"></a>
    </div>
    <h4 class="auth-header">Forgot Password Form</h4>
    {!! Form::open( [ 'route' => 'auth.login.store', 'id' => 'form-login' ] ) !!}
        <div class="form-group">
            <label for="">Email</label>
            {!! Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'Enter Your Email' ]) !!}
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
        </div>
        <div class="buttons-w">
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection