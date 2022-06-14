@extends('layouts.dashboard')
@section('title', __('Edit Movie'))

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Movie') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.filmes.update', $filme->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.filmes.partials.create-edit')

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Movie Poster') }}</label>

                            <div class="col-md-6 ">
                                <img src="{{$filme->cartaz_url ? asset('storage/cartazes/' .
$filme->cartaz_url) : asset('img/default_img.png') }}" alt="Poster do Filme" class="w-25 img-fluid rounded">
                            </div>

                        </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Movie') }}
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
