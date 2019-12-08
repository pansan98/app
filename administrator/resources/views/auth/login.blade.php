@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0)">Laravel <b>App</b></a>
        <small>Laravel App Login Form</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" novalidate="novalidate" action="{{ route('login') }}">
                @csrf

                <div class="msg">{{ __('Sign in to start Laravel App!!') }}</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line @error('email') error @enderror">
                        <input type="text" class="form-control" name="email" placeholder="E-mail" required="" autocomplete="email" autofocus="" aria-required="true" aria-invalid="true">
                        @error('email')
                            <label id="username-error" class="error" for="email">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line @error('password') error @enderror">
                        <input class="form-control" type="password" name="password" placeholder="Password" required="" aria-required="true">
                    </div>
                    @error('password')
                        <label id="password-error" class="error" for="password">{{ $message }}</label>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input id="remember" class="filled-in chk-col-pink" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit" style="padding: 0;">{{ __('Sign In!!') }}</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="{{ route('register') }}">Register now!</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
