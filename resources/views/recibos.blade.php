@extends('layouts.app')

@section('title', __('Invoice'))

@section('home')

    <div class="container ">

        <!-- content tabs -->
        <div class="row ">

            <div class="col-md-12">
                <table class="table  text-white">
                    <thead>
                        <tr>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('PDF') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recibos as $recibo)
                            <tr>
                                <td>{{ $recibo->data }}</td>
                                <td>{{ $recibo->preco_total_com_iva }} €</td>
                                <td>
                                    @if ($recibo->recibo_pdf_url)
                                        <a href=" {{ route('client.recibos.download', $recibo->id) }}">
                                            {{ __('See') }}</a>
                                    @else
                                        {{ __('There is no invoice url') }}
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{ $recibos->links() }}

        </div>
    </div>
    <!-- end content tabs -->

    <!-- end content -->


@endsection
