<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>



<div class="row mb-3">
    <label for="tipo" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>
    <div class="col-md-6">
        <input type="radio" id="A" name="tipo" value="A" {{ old('tipo') == 'A' || !old('tipo') ? 'checked' : '' }}>
        <label for="A">{{__("Admin")}}</label>

        <input type="radio" id="F" name="tipo" value="F" {{ old('tipo') == 'F' ? 'checked' : '' }}>
        <label for="F">{{__("Emplee")}}</label>

        <input type="radio" id="C" name="tipo" value="C" {{ old('tipo') == 'C' ? 'checked' : '' }}>
        <label for="C">{{__("Client")}}</label>

        @error('tipo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>