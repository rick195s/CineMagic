@extends('layouts.app')

@section('title', __('Choose seat Ticket'))


@section('page-title')
    <section class="section section--first section--bg" data-bg="{{ asset('img/section.jpg') }}">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">{{ __('Select the seat for the session') }}</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="#">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">
                                {{ __('Select the seat for the session') }}</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('home')

    <div class="container ">

        <!-- content tabs -->
        <div class="row ">
            <div class="col-md-4">
                <h2>{{ $sessao->filme->titulo }}</h2>
                <div class="card__cover w-75">
                    <img src="{{ asset('storage/cartazes/' . $sessao->filme->cartaz_url) }}" alt="">
                </div>
                <hr>
                <p>{{ __('Screen Room') }}: {{ $sessao->sala->nome }}</p>
                <p>{{ __('Data') }}: {{ $sessao->data }}</p>
                <p>{{ __('Starting Hour') }}: {{ $sessao->horario_inicio }}</p>
            </div>
            <div class="col-md-8">
                @foreach ($filas as $fila => $lugares)
                    <div class="row my-3">
                        <h3>{{ $fila }}</h3>
                        <hr>

                        @foreach ($lugares as $lugar)
                            <div class="col-2 mx-1">
                                <div class="fa-4x">
                                    @can('adicionarLugar', [Session::get('carrinho') ?? new App\Models\Carrinho(), $sessao,
                                        $lugar])
                                        <form action="{{ route('carrinho.add_lugar', [$sessao->id, $lugar->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit">
                                                <span class="fa-layers seats fa-fw">
                                                    <i data-fa-transform="shrink-2" class="fas fa-couch"></i>
                                                    <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11 up-2"
                                                        style="color:black;font-weight:900">{{ $lugar->posicao }}</span>
                                                </span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="fa-layers text-muted fa-fw">
                                            <i data-fa-transform="shrink-2" class="fas fa-couch"></i>
                                            <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11 up-2"
                                                style="color:black; font-weight:900">{{ $lugar->posicao }}</span>
                                        </span>
                                    @endcan

                                </div>

                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- end content tabs -->

    <!-- end content -->


@endsection
