@extends('layouts.auth')
@section('title', __('Register'))
@section('content')

<!-- registration form -->

<form method="POST" class="sign__form" action="{{ route('register') }}">
    @csrf
    <a href="index.html" class="sign__logo">
        <img src="img/logo.svg" alt="">
    </a>

    <div class="sign__group">
        <input id="name" placeholder="{{__('Name')}}" type="text" class="sign__input form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
        <span class=" invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="sign__group">
        <input id="email" placeholder="{{__('Email')}}" type="email" class="sign__input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class=" invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="sign__group">
        <input id="password" placeholder="{{__('Password')}}" type="password" class="sign__input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
        <span class="  invalid-feedback " role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="sign__group">
        <input id="password-confirm" placeholder="{{__('Confirm Password')}}" type="password" class="form-control sign__input" name="password_confirmation" required autocomplete="new-password">

    </div>
    <button type="submit" class="sign__btn">
        {{ __('Register') }}
    </button>

    <span class="sign__text">{{__('Already have an account?')}} <a href="{{route('login')}}">{{__('Login')}}</a></span>
</form>
<!-- registration form -->


@endsection