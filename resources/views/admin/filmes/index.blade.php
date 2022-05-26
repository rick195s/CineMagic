@extends('layouts.dashboard')
@section('title', __('Movies'))
@section('content')

<div class="container-fluid p-0">

    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-4"><strong>{{__('Movies')}}</strong></h1>
        </div>

        @can('create', App\Models\Filme::class)
        <div class="col-6 d-flex justify-content-end align-items-start">
            <a href="{{ route('admin.filmes.create')}}" class="btn btn-success"><i class="align-middle" data-feather="user-plus"> </i> {{__('Add Movie')}}</a>
        </div>
        @endcan
    </div>

    <div class="row">
        @foreach ($filmes as $filme)

        <div class="col-6 col-sm-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('storage/cartazes/'.$filme->cartaz_url)}}" alt="{{$filme->titulo}}">
                <div class="card-body d-flex">
                    <div class="me-auto">
                        <h2 class="mb-0">{{ $filme->titulo }}</h2>
                    </div>

                    @can('update', $filme)
                    <a href="{{route('admin.filmes.edit', $filme->id)}}" class="btn btn-primary me-1">{{__('Edit')}}</a>
                    @endcan

                    @can('delete', $filme)
                    <button form="delete_filme_{{$filme->id}}" class="btn btn-danger"><i data-feather="trash-2"></i> </button>

                    <form id="delete_filme_{{$filme->id}}" action="{{ route('admin.filmes.destroy', $filme->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                    </form>
                    @endcan
                </div>
            </div>
        </div>

        @endforeach
        {{ $filmes->links() }}
    </div>
</div>
@endsection
