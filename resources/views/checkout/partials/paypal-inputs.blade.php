<div class="form-outline form-white mb-4" id="email">
    <label class="form-label">{{__('Email')}}</label>

    <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="number" name="email" value="{{ old('email', Auth::user()->cliente ? Auth::user()->cliente->ref_pagamento ?? '' : '') }}" />

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>