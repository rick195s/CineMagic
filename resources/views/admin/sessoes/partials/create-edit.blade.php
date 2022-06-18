<div class="row mb-3">
    <label for="sala_id" class="col-md-4 col-form-label text-md-end">{{ __('Movie Theater') }}</label>

    <div class="col-md-6">
        <select name="sala_id" required class="form-control @error('sala_id') is-invalid @enderror" id="sala_id">
            @foreach ($salas as $sala)
                <option value="{{ $sala->id }}" {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nome }}
                </option>
            @endforeach
        </select>

        @error('sala_id')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="filme_id" class="col-md-4 col-form-label text-md-end">{{ __('Movie') }}</label>

    <div class="col-md-6">
        <select name="filme_id" required class="form-control @error('filme_id') is-invalid @enderror" id="filme_id">
            @foreach ($filmes as $filme)
                <option value="{{ $filme->id }}" {{ old('filme_id') == $filme->id ? 'selected' : '' }}>
                    {{ $filme->titulo }}
                </option>
            @endforeach
        </select>

        @error('filme_id')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="data" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

    <div class="col-md-6">
        <input id="data" type="date" value="{{ old('data', $sessao->data) }}"
            class="form-control @error('data') is-invalid @enderror" name="data" required>

        @error('data')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="horario_inicio" class="col-md-4 col-form-label text-md-end">{{ __('Starting Hour') }}</label>

    <div class="col-md-6">
        <input id="horario_inicio" type="time" step="2"
            value="{{ old('horario_inicio', $sessao->horario_inicio) }}"
            class="form-control @error('horario_inicio') is-invalid @enderror" name="horario_inicio" required>

        @error('horario_inicio')
            <span class="small text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
