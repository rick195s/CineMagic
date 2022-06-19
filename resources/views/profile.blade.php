@extends('layouts.app')

@section('title', __('Profile'))

@section('content')

    <form action="{{ route('client.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="small text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nif" class="col-md-4 col-form-label text-md-end">{{ __('Nif Number') }}</label>

            <div class="col-md-6">
                <input id="nif" type="number" class="form-control @error('nif') is-invalid @enderror" name="nif"
                    value="{{ old('nif', $user->cliente->nif) }}" autocomplete="nif">

                @error('nif')
                    <span class="small text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="row mb-3">
            <label for="nif" class="col-md-4 col-form-label text-md-end">{{ __('Payment Type') }}</label>
            <div class="col-md-6">
                <select class="form-control @error('tipo_pagamento') is-invalid @enderror" name="tipo_pagamento"
                    id="paymentType">
                    <option value>{{ __('Select One') }}</option>
                    <option value="VISA"
                        {{ 'VISA' == old('tipo_pagamento', Auth::user()->cliente ? Auth::user()->cliente->tipo_pagamento ?? '' : '') ? 'selected' : '' }}>
                        VISA</option>
                    <option value="PAYPAL"
                        {{ 'PAYPAL' == old('tipo_pagamento', Auth::user()->cliente ? Auth::user()->cliente->tipo_pagamento ?? '' : '') ? 'selected' : '' }}>
                        PAYPAL</option>
                    <option value="MBWAY"
                        {{ 'MBWAY' == old('tipo_pagamento', Auth::user()->cliente ? Auth::user()->cliente->tipo_pagamento ?? '' : '') ? 'selected' : '' }}>
                        MBWAY</option>
                </select>
            </div>

            @error('tipo_pagamento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="row mb-3">
            <label for="foto_url" class="col-md-4 col-form-label text-md-end">{{ __('Upload Photo') }}</label>

            <div class="col-md-6">
                <input id="foto_url" type="file" class="form-control @error('foto_url') is-invalid @enderror"
                    name="foto_url">

                @error('foto_url')
                    <span class="small text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>

        <div class="row mb-3">
            <label class="col-md-4 col-form-label text-md-end">{{ __('User Photo') }}</label>

            <div class="col-md-6 ">
                <img src="{{ $user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}"
                    alt="Foto do utilizador" class="w-25 img-fluid rounded">
            </div>

        </div>

        @can('update', $user->cliente)
            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update User') }}
                    </button>
                </div>
            </div>
        @endcan
    </form>



@endsection
