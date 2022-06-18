<div class="row mb-3">
    <label for="titulo" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

    <div class="col-md-6">
        <input id="titulo" value="{{ old('titulo', $filme->titulo) }}" type="text"
            class="form-control @error('titulo') is-invalid @enderror" name="titulo" required>

        @error('titulo')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="genero_code" class="col-md-4 col-form-label text-md-end">{{ __('Movie Gender') }}</label>

    <div class="col-md-6">
        <select name="genero_code" required class="form-control @error('genero_code') is-invalid @enderror"
            id="genero_code">
            @foreach ($generos as $genero)
                <option value="{{ $genero->code }}" {{ old('genero_code') == $genero->code ? 'selected' : '' }}>
                    {{ $genero->nome }}
                </option>
            @endforeach
        </select>

        @error('genero_code')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="ano" class="col-md-4 col-form-label text-md-end">{{ __('Release Year') }}</label>

    <div class="col-md-6">
        <input id="ano" value="{{ old('ano', $filme->ano) }}" type="number"
            class="form-control @error('ano') is-invalid @enderror" name="ano" required>

        @error('ano')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="sumario" class="col-md-4 col-form-label text-md-end">{{ __('Summary') }}</label>

    <div class="col-md-6">
        <textarea id="sumario" type="text" class="form-control @error('sumario') is-invalid @enderror" name="sumario"
            required cols="30" rows="10">
            {{ old('sumario', $filme->sumario) }}
        </textarea>
        @error('sumario')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="trailer_url" class="col-md-4 col-form-label text-md-end">{{ __('Movie Trailer') }}</label>

    <div class="col-md-6">
        <input id="trailer_url" value="{{ old('trailer_url', $filme->trailer_url) }}" type="text"
            class="form-control @error('trailer_url') is-invalid @enderror" name="trailer_url" required>

        @error('trailer_url')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="cartaz_url" class="col-md-4 col-form-label text-md-end">{{ __('Upload Photo') }}</label>
    <div class="col-md-6">
        <input id="cartaz_url" type="file" class="form-control @error('cartaz_url') is-invalid @enderror"
            name="cartaz_url" @if (Route::currentRouteName() == 'admin.filmes.create') required @endif>

        @error('cartaz_url')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
</div>
