@extends('layouts.app')

@section('title', __('Tickets'))

@section('home')

    <div class="container ">

        <!-- content tabs -->
        <div class="row ">

            <div class="col-md-12">
                <table class="table  text-white">
                    <thead>
                        <tr>
                            <th>{{ __('Seat') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Filme') }}</th>
                            <th>{{ __('Date') . '-' . __('Starting Hour') }}</th>
                            <th>{{ __('PDF') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bilhetes as $bilhete)
                            <tr>
                                <td>{{ $bilhete->lugar->fila . $bilhete->lugar->posicao }}</td>
                                <td>{{ $bilhete->preco_sem_iva }} €</td>
                                <td>{{ $bilhete->sessao->filme->titulo ?? '' }}</td>
                                <td>{{ $bilhete->sessao->data . '-' . $bilhete->sessao->horario_inicio }}</td>
                                <td>
                                    <a href=" {{ route('client.bilhetes.download', $bilhete->id) }}">
                                        {{ __('See') }}</a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- end content tabs -->

    <!-- end content -->


@endsection
