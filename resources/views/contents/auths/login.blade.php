@extends('layouts.auth')
@section('title', 'Login')

@section('body')
<div class="auth-box-w">
    <div class="logo-w">
        <a href="{{route('auth.login')}}"><img alt="" src="{{asset('themes/img/logo-big.png')}}"></a>
    </div>
    <h4 class="auth-header">Login Form</h4>
    <form action="#">
        <div class="form-group">
            <label for="">Username</label>
            <input class="form-control" placeholder="Enter your username" type="text">
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" placeholder="Enter your password" type="password">
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
        </div>
        <div class="buttons-w">
            <button class="btn btn-primary">Log me in</button>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox">Remember Me</label>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
@endsection