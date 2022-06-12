@extends('layouts.dashboard')

@section('title', __('Sessions'))
@section('content')

    <div class="container-fluid p-0">


        <div class="row">
            <div class="col-6">
                <h1 class="h3 mb-3"><strong>{{ __('Sessions') }}</strong></h1>
            </div>

            @can('create', App\Models\Sessao::class)
                <div class="col-6  d-flex justify-content-end align-items-start">
                    <a href="{{ route('admin.sessoes.create') }}" class="btn btn-success"><i class="align-middle"
                            data-feather="user-plus"> </i> {{ __('Add User') }}</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-12  d-flex">
                <div class="card flex-fill">

                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th class="d-none d-xl-table-cell">{{ __('Date') }}</th>
                                <th class="d-none d-xl-table-cell">{{ __('Starting Hour') }}</th>
                                <th class="d-none d-xl-table-cell">{{ __('Screen Room') }}</th>
                                <th class="d-none d-xl-table-cell">{{ __('Manage') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessoes as $sessao)
                                <tr>
                                    <td>{{ $sessao->filme->titulo }}</td>
                                    <td>{{ $sessao->data }}</td>
                                    <td>{{ $sessao->horario_inicio }}</td>
                                    <td>
                                        @isset($sessao->sala)
                                            {{ $sessao->sala->nome }}
                                        @endisset
                                    </td>
                                    <td>
                                        @can('manage', $sessao)
                                            <a href="{{ route('admin.sessoes.manage', $sessao->id) }}"
                                                class="btn btn-info"><i data-feather="corner-down-right"></i> </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{ $sessoes->links() }}
        </div>
    </div>
@endsection
