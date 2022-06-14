<div class="form-outline form-white mb-4" id="cvc">
    <label class="form-label">{{__('CVC')}}</label>

    <input class="form-control form-control-lg @error('cvc') is-invalid @enderror" type="number" name="cvc" value="{{ old('cvc', Auth::user()->cliente ? Auth::user()->cliente->ref_pagamento ?? '' : '') }}" />

    @error('cvc')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-outline form-white mb-4" id="card-number">
    <label class="form-label">{{__('Card Number')}}</label>

    <input class="form-control form-control-lg @error('card_number') is-invalid @enderror" type="number" name="card_number" value="{{ old('card_number', Auth::user()->cliente ? Auth::user()->cliente->ref_pagamento ?? '' : '') }}" />

    @error('card_number')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>