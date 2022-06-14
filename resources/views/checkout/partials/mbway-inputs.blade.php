<div class="form-outline form-white mb-4" id="phone-number">
    <label class="form-label">{{__('Phone Number')}}</label>

    <input class="form-control form-control-lg @error('phone_number') is-invalid @enderror" type="number" name="phone_number" value="{{ old('phone_number', Auth::user()->cliente ? Auth::user()->cliente->ref_pagamento ?? '' : '') }}" />

    @error('phone_number')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>