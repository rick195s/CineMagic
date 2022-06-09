@auth
<form action="{{ route('carrinho.checkout') }}" method="post" class="mt-4">
    @csrf

    <div class="form-outline form-white mb-4">
        <label class="form-label" for="typeName">{{__('NIF')}}</label>

        <input class="form-control form-control-lg @error('nif') is-invalid @enderror" type="number" name="nif" id="typeName" value="{{ old('nif' , Auth::user()->cliente ? Auth::user()->cliente->nif ?? '' : '') }}" placeholder="756231562" />
        @error('nif')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline form-white mb-4">
        <label class="form-label" for="typeName">{{__('Payment Type')}}</label>

        <select class="form-control @error('tipo_pagamento') is-invalid @enderror" name="tipo_pagamento" id="paymentType">
            <option value="VISA" {{'VISA' == old('tipo_pagamento', Auth::user()->cliente ? Auth::user()->cliente->tipo_pagamento ?? '' : '') ? 'selected' : ''}}>VISA</option>
            <option value="PAYPAL" {{'PAYPAL' == old('tipo_pagamento',Auth::user()->cliente ? Auth::user()->cliente->tipo_pagamento ?? '' : '') ? 'selected' : ''}}>PAYPAL</option>
            <option value="MBWAY" {{'MBWAY' == old('tipo_pagamento',Auth::user()->cliente ? Auth::user()->cliente->tipo_pagamento ?? '' : '') ? 'selected' : ''}}>MBWAY</option>
        </select>

        @error('tipo_pagamento')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- ---------------------VISA-----------------  -->
    @include('checkout.partials.visa-inputs')
    <!-- ---------------------END VISA-----------------  -->

    <!-- ---------------------PAYPAL-----------------  -->
    @include('checkout.partials.paypal-inputs')
    <!-- ---------------------END PAYPAL-----------------  -->

    <!-- ---------------------MBWAY-----------------  -->
    @include('checkout.partials.mbway-inputs')
    <!-- ---------------------END MBWAY-----------------  -->

    <hr class="my-4">

    <div class="d-flex justify-content-between mb-4">
        <p class="mb-2">{{__('Total(With IVA)')}}</p>
        <p class="mb-2">{{ number_format($total, 2)}}€</p>
    </div>

    @can('confirmarCompra', $carrinho)
    <button type="submit" class="btn btn-primary btn-block btn-lg">
        <span>{{__('Confirm')}} <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
    </button>
    @endcan

</form>
@else
<div class="d-flex justify-content-between mb-4">
    <p class="mb-2">{{__('Total(With IVA)')}}</p>
    <p class="mb-2">{{ number_format($total, 2)}}€</p>
</div>
<a href="{{ route('login') }}" class="btn btn-primary btn-block btn-lg">
    <span>{{__('Login')}} <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
</a>
@endauth