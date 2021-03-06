@extends('layouts.auth')
@section('title', __('Confirm Password'))

@section('content')

    <form method="POST" class="sign__form" action="{{ route('password.confirm') }}">
        @csrf

        <a href="{{ route('home') }}" class="text-white">
            <h1 class="display-6">{{ config('app.name', 'Laravel') }}</h1>
        </a>

        <span class="text-white">
            {{ __('Please confirm your password before continuing.') }}
        </span>

        <div class="sign__group">
            <input id="password" placeholder="{{ __('Password') }}" type="password"
                class="form-control sign__input @error('password') is-invalid @enderror" name="password" required
                autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <button type="submit" class="sign__btn">
            {{ __('Confirm Password') }}
        </button>

        @if (Route::has('password.request'))
            <a class="sign__text" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>

@endsection
