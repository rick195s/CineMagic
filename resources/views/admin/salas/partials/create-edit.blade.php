<div class="row mb-3">
    <label for="nome" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="nome" value="{{old('nome', $sala->nome)}}" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" required>

        @error('nome')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="num_lugares" class="col-md-4 col-form-label text-md-end">{{ __('Number of Seats') }}</label>

    <div class="col-md-6">
        <input id="num_lugares" type="number" value="{{old('num_lugares', $sala->lugares->count())}}" class="form-control @error('num_lugares') is-invalid @enderror" name="num_lugares" required>

        @error('num_lugares')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="num_filas" class="col-md-4 col-form-label text-md-end">{{ __('Number of Rows') }}</label>

    <div class="col-md-6">
        <input id="num_filas" type="number" value="{{old('num_lugares', $sala->number_of_rows())}}" class="form-control @error('num_filas') is-invalid @enderror" name="num_filas" required>

        @error('num_filas')
        <span class="small text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>