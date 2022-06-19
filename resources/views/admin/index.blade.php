@extends('layouts.dashboard')
@section('title', __('Dashboard'))
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __('Sales') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $estatisticas->getNumSales() }}</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                        </span>
                                        <span class="text-muted">{{ __('Since last week') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __('Users') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $estatisticas->getNumUsers() }}</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                        </span>
                                        <span class="text-muted">{{ __('Since last week') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __('Sales') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $estatisticas->getValorVendas() }}€</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                        </span>
                                        <span class="text-muted">{{ __('Since last week') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __('Tickets') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $estatisticas->getNumTickets() }}</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                        </span>
                                        <span class="text-muted">{{ __('Since last week') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">{{ __('Latest Sales') }}</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th class="d-none d-xl-table-cell">{{ __('Date') }}</th>
                                <th class="d-none d-xl-table-cell">{{ __('Value') }}</th>
                                <th>{{ __('Payment Type') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estatisticas->getLastSales() as $recibo)
                                <tr>
                                    <td>{{ $recibo->nome_cliente }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $recibo->data }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $recibo->preco_total_com_iva }}€</td>
                                    <td><span class="badge bg-success">{{ $recibo->tipo_pagamento }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12  d-flex order-3 order-xxl-2">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">{{ __('Settings') }}</h5>
                    </div>
                    <div class="card-body px-4">
                        <form action="{{ route('admin.settings.update') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="preco_bilhete_sem_iva"
                                    class="col-md-2 col-form-label">{{ __('Ticket Price without IVA') }}</label>

                                <div class="col-md-2">
                                    <input id="preco_bilhete_sem_iva" type="number"
                                        value="{{ old('preco_bilhete_sem_iva', $config->preco_bilhete_sem_iva) }}"
                                        class="form-control @error('preco_bilhete_sem_iva') is-invalid @enderror"
                                        name="preco_bilhete_sem_iva" required>

                                    @error('preco_bilhete_sem_iva')
                                        <span class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="percentagem_iva" class="col-md-2 col-form-label">{{ __('IVA Percentage') }}
                                    (%)</label>

                                <div class="col-md-2">
                                    <input id="percentagem_iva" type="number"
                                        value="{{ old('percentagem_iva', $config->percentagem_iva) }}"
                                        class="form-control @error('percentagem_iva') is-invalid @enderror"
                                        name="percentagem_iva" required>


                                    @error('percentagem_iva')
                                        <span class="small text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 my-3 my-md-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Settings') }}
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
