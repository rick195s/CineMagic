@extends('layouts.auth')
@section('title', __('Reset Password'))

@section('content')
<form method="POST" class="sign__form" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <a href="index.html" class="sign__logo">
        <img src="{{asset('img/logo.svg')}}" alt="">
    </a>


    <div class="sign__group">
        <input id="email" placeholder="{{__('Email')}}" type="email" class="form-control sign__input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>

    <div class="sign__group">
        <input id="password" placeholder="{{__('Password')}}" type="password" class="form-control sign__input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror


    </div>


    <div class="sign__group">
        <input id="password-confirm" placeholder="{{__('Confirm Password')}}" type="password" class="form-control sign__input" name="password_confirmation" required autocomplete="new-password">
    </div>

    <button type="submit" class="sign__btn">
        {{ __('Reset Password') }}
    </button>

</form>

@endsection