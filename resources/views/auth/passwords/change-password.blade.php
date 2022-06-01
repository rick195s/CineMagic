@extends('layouts.auth')
@section('title', __('Change Password'))

@section('content')

<form method="POST" class="sign__form" action="{{ route('change_password.update') }}">
    @csrf

    <a href="index.html" class="sign__logo">
        <img src="{{asset('img/logo.svg')}}" alt="">
    </a>

    <span class="text-white">
        {{ __('Please confirm your password before continuing.') }}
    </span>

    <div class="sign__group">
        <input id="current-password" placeholder="{{__('Current Password')}}" type="password" class="form-control sign__input @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password" autofocus>

        @error('current_password')
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
        <input id="password-confirmation" placeholder="{{__('Confirm New Password')}}" type="password" class="form-control sign__input" name="password_confirmation" required autocomplete="new-password">
    </div>


    <button type="submit" class="sign__btn">
        {{ __('Change Password') }}
    </button>

</form>


@endsection