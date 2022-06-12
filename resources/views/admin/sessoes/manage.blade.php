@extends('layouts.dashboard')

@section('title', __('Manage Session') . ' - ' . $sessao->filme->titulo)

@section('content')

    <div class="col-12">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/cartazes/' . $sessao->filme->cartaz_url) }}"
                        class="img-fluid rounded-start" alt="{{ $sessao->filme->titulo }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body h-100">
                        <h1>{{ $sessao->filme->titulo }}</h1>
                        <h3 class="card-text">
                            {{ $sessao->data . ' ' . $sessao->horario_inicio }}
                        </h3>

                        <div class=" mt-5">
                            <a href="" class="btn btn-lg btn-info">
                                {{ __('Scan QRCode') }}
                            </a>
                        </div>

                        <table class="table mt-3 table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="d-none d-xl-table-cell">{{ __('Ticket ID') }}</th>
                                    <th class="d-none d-xl-table-cell">{{ __('Users') }}</th>
                                    <th class="d-none d-xl-table-cell">{{ __('State') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessao->bilhetes as $bilhete)
                                    <tr>
                                        <td>{{ $bilhete->id }}</td>
                                        <td>{{ $bilhete->cliente->user->name }}</td>
                                        <td>
                                            @if (!$bilhete->usado())
                                                <form action="{{ route('admin.bilhetes.use', $bilhete->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button class="btn btn-success">{{ __('Mark as Used') }}</button>

                                                </form>
                                            @else
                                                <p>{{ __('Ticket already used') }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
