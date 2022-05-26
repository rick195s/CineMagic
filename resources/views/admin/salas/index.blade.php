@extends('layouts.dashboard')
@section('title', __('Movie Theaters'))
@section('content')

<div class="container-fluid p-0">

    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-4"><strong>{{__('Movie Theaters')}}</strong></h1>
        </div>

        @can('create', App\Models\Sala::class)
        <div class="col-6 d-flex justify-content-end align-items-start">
            <a href="{{ route('admin.salas.create')}}" class="btn btn-success"><i class="align-middle" data-feather="user-plus"> </i> {{__('Add Movie Theater')}}</a>
        </div>
        @endcan
    </div>

    <div class="row">
        @foreach ($salas as $sala)

        <div class="col-6 col-sm-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('img/movie_theater.jpg')}}" alt="{{$sala->nome}}">
                <div class="card-body d-flex align-items-start">
                    <div class="me-auto">
                        <h2 class="mb-0">{{ $sala->nome }}</h2>
                    </div>

                    @can('update', $sala)
                    <a href="{{route('admin.salas.edit', $sala->id)}}" class="btn btn-primary me-1">{{__('Edit')}}</a>
                    @endcan

                    @can('delete', $sala)
                    <button form="delete_sala_{{$sala->id}}" class="btn btn-danger"><i data-feather="trash-2"></i> </button>

                    <form id="delete_sala_{{$sala->id}}" action="{{ route('admin.salas.destroy', $sala->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                    </form>
                    @endcan
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection