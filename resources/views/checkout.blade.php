@extends('layouts.app')
@section('title', __('Checkout'))

@section('page-title')
<section class="section section--first section--bg" data-bg="{{ asset('img/section.jpg')}}">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section__wrap">
                    <!-- section title -->
                    <h2 class="section__title">{{__('Checkout')}}</h2>
                    <!-- end section title -->

                    <!-- breadcrumb -->
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item"><a href="#">Home</a></li>
                        <li class="breadcrumb__item breadcrumb__item--active">{{__('Checkout')}}</li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('home')
<div class="container">

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            @if (Session::has('carrinho') && !Session::get('carrinho')->vazio())
            <div class="card">
                <div class="card-body p-4">

                    <div class="row">


                        <div class="col-lg-7">
                            <h5 class="mb-3"><a href="{{ route('home') }}"><i class="fas fa-long-arrow-alt-left me-2"></i>{{__('Continue shopping')}}</a></h5>
                            <hr>

                            <div class=" row  mb-4">
                                <div class="col-12 col-sm-6">
                                    <p class="mb-1">{{__('Cart')}}</p>

                                </div>

                                <div class="col-12 col-sm-6 d-flex justify-content-end">
                                    <form action="{{route('carrinho.empty')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white btn btn-sm bg-danger">
                                            {{ __('Empty Cart') }}
                                        </button>
                                    </form>

                                </div>

                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1">{{__('Sessions')}}:</p>
                                </div>
                            </div>

                            @foreach ($sessoes as $sessao)

                            <div class="card mb-3 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('filmes.show',  $sessao->filme->id)  }}">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img src="{{asset('storage/cartazes/'.$sessao->filme->cartaz_url)}}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                </div>
                                                <div class="ms-3">
                                                    <h5>{{$sessao->filme->titulo}}</h5>
                                                    <p class="small mb-0">{{date('d F Y', strtotime($sessao->data)) }}, {{ date('H:i', strtotime($sessao->horario_inicio)) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="mx-3">
                                                <a class="text-white btn btn-sm bg-success" href="{{route('sessao.select_seat', $sessao->id)}}">
                                                    {{__('Select the seat for the session')}}
                                                </a>

                                            </div>
                                            <form action="{{ route('carrinho.delete_sessao', [$sessao->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" style="color: #cecece;"><i class="fas fa-trash-alt"></i></button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1">{{__('seats')}}:</p>
                                </div>
                            </div>

                            @foreach ($lugares_por_sessao as $sessao_id => $lugares)
                            @foreach ($lugares as $lugar)
                            <div class="card mb-3 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            @isset($sessoes[$sessao_id])
                                            <div>
                                                <img src="{{asset('storage/cartazes/'.$sessoes[$sessao_id]->filme->cartaz_url)}}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                            </div>
                                            @endisset
                                            <div class="ms-3">
                                                <h5>{{ __('Seat') }} {{$lugar->fila}}{{ $lugar->posicao }}</h5>
                                                @isset($sessoes[$sessao_id])
                                                <p class="small mb-0">
                                                    {{ date('d F Y', strtotime($sessoes[$sessao_id]->data)) }},
                                                    {{ date('H:i', strtotime($sessoes[$sessao_id]->horario_inicio)) }}
                                                </p>
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="mx-3">
                                                <h5 class="mb-0">{{ number_format($preco_bilhete_com_iva,2) }} €</h5>
                                                <p class="small fw-normal mb-0">{{__('Per Ticket')}}</p>

                                            </div>
                                            <form action="{{ route('carrinho.delete_lugar', [$sessao_id, $lugar->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" style="color: #cecece;"><i class="fas fa-trash-alt"></i></button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach



                        </div>

                        <div class="col-lg-5">

                            <div class="card bg-primary text-white rounded-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="mb-0">{{__('Payment details')}}</h5>
                                        @auth
                                        <img src="{{ Auth::user()->foto_url ? asset('storage/fotos/' .
                                    auth()->user()->foto_url) : asset('img/default_img.png') }}" class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                        @endauth
                                    </div>

                                    <p class="small mb-2">Card type</p>
                                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-visa fa-2x me-2"></i></a>
                                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-amex fa-2x me-2"></i></a>
                                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                    <form class="mt-4">
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="typeName">{{__('NIF')}}</label>
                                            <input type="number" name="nif" id="typeName" class="form-control form-control-lg" placeholder="756231562" />

                                        </div>
                                    </form>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-2">{{__('Total(With IVA)')}}</p>
                                        <p class="mb-2">{{ number_format($total, 2)}}€</p>
                                    </div>

                                    <button type="button" class="btn btn-info btn-block btn-lg">
                                        <div class="d-flex justify-content-between">
                                            <span>{{__('Confirm')}} <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                        </div>
                                    </button>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            @else

            <div class="row text-center">
                <div class="col-lg-12">
                    <h2><a href="{{ route('home') }}"><i class="fas fa-long-arrow-alt-left me-2"></i>{{__('Cart is empty')}}</a></h2>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection