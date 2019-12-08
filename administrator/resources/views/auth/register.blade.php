@extends('layouts.app-register')

@section('content')
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0)">Laravel <b>App</b></a>
            <small>Laravel App Login Form</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign-up" method="POST" novalidate="novalidate" action="{{ route('register') }}">
                    @csrf
                    <div class="msg">{{ __('Register a new membership') }}</div>
                    <label for="email" class="col-md-12 col-form-label text-md-right" style="margin-bottom: 0;">{{ __('your name') }}</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                        <div class="form-line @error('name') error @enderror">
                            <input class="from-control" type="text" name="name" style="margin-bottom: 0;" value="{{ old('name') }}" required="" autocomplete="name" autofocus/>
                        </div>
                        @error('name')
                        <label id="name" class="error" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                    <label for="email" class="col-md-12 col-form-label text-md-right" style="margin-bottom: 0;">{{ __('E-Mail Address') }}</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                        <div class="form-line @error('email') error @enderror">
                            <input class="form-control" type="email" name="email" style="margin-bottom: 0;" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                        </div>
                        @error('email')
                        <label id="email" class="error" for="email">{{ $message }}</label>
                        @enderror
                    </div>
                    <label for="email" class="col-md-12 col-form-label text-md-right" style="margin-bottom: 0;">{{ __('Password') }}</label>
                    <div class="input-group">
                        <span class="input-grooup-addon">
                        <i class="material-icons">lock</i>
                    </span>
                        <div class="form-line @error('password') error @enderror">
                            <input class="form-control" type="password" name="password" style="margin-bottom: 0;" minlength="6" required/>
                        </div>
                        @error('password')
                        <label id="password-error" class="error" for="password">{{ $message }}</label>
                        @enderror
                    </div>
                    <label for="email" class="col-md-12 col-form-label text-md-right" style="margin-bottom: 0;">{{ __('Confirm Password') }}</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                        <div class="form-line @error('password_confirmation') error @enderror">
                            <input class="form-control" type="password" style="margin-bottom: 0;" name="password_confirmation" required/>
                        </div>
                        @error('password_confirmation')
                        <label id="password_confirmation" class="error" for="password_confirmation">{{ $message }}</label>
                        @enderror
                    </div>
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP!!</button>
                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ route('login') }}">You already have a membership ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
