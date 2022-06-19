@extends('layouts.auth')
@section('title', __('Verify Your Email Address'))
@section('content')

    <form class="sign__form" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <a href="{{ route('home') }}" class="text-white">
            <h1 class="display-6">{{ config('app.name', 'Laravel') }}</h1>
        </a>
        <span class="text-white">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        </span>


        @if (session('resent'))
            <div class="small alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif


        <button type="submit" class="sign__btn">
            {{ __('click here to request another') }}
        </button>

    </form>



@endsection
