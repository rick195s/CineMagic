@extends('layouts.auth')

@section('content')
<!-- authorization form -->
<form method="POST" class="sign__form" action="{{ route('login') }}">
    @csrf
    <a href="index.html" class="sign__logo">
        <img src="img/logo.svg" alt="">
    </a>

    <div class="sign__group">
        <input id="email" placeholder="{{__('Email')}}" type="email" class="form-control sign__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="sign__group">
        <input id="password" placeholder="{{__('Password')}}" type="password" class="form-control sign__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="sign__group sign__group--checkbox">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked="{{ old('remember') ? 'checked' : '' }}">

        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>

    <button type="submit" class="sign__btn">
        {{ __('Login') }}
    </button>

    @if (Route::has('password.request'))
    <a class="sign__text" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
    @endif

    <span class="sign__text">{{__("Don't Have an Account?")}} <a href="{{ route('register') }}">{{__("Create Account")}} </a></span>

</form>
<!-- end authorization form -->
@endsection