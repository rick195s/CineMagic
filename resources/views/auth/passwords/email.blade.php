@extends('layouts.auth')
@section('title', __('Reset Password'))
@section('content')
<form method="POST" class="sign__form" action="{{ route('password.email') }}">
    @csrf
    <a href="index.html" class="sign__logo">
        <img src="{{asset('img/logo.svg')}}" alt="">
    </a>


    <div class="sign__group">
        <input id="email" placeholder="{{__('Email')}}" type="email" class="form-control sign__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

    </div>

    @if (session('status'))
    <div class="small alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <button type="submit" class="sign__btn">
        {{ __('Send Password Reset Link') }}
    </button>


</form>

@endsection