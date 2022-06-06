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

            <div class="card">
                <div class="card-body p-4">

                    <div class="row">

                        <div class="col-lg-7">
                            <h5 class="mb-3"><a href="{{ route('home') }}"><i class="fas fa-long-arrow-alt-left me-2"></i>{{__('Continue shopping')}}</a></h5>
                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <p class="mb-1">{{__('Cart')}}</p>
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
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img src="{{asset('storage/cartazes/'.$sessao->filme->cartaz_url)}}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                            </div>
                                            <div class="ms-3">
                                                <h5>{{$sessao->filme->titulo}}</h5>
                                                <p class="small mb-0">{{date('d F Y', strtotime($sessao->data)) }}, {{ date('H:i', strtotime($sessao->horario_inicio)) }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="mx-3">
                                                <a class="text-white btn btn-sm bg-success" href="{{route('sessao.select_seat', $sessao->id)}}">
                                                    {{__('Select the seat for the session')}}
                                                </a>

                                            </div>
                                            <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1">{{__('Tickets')}}:</p>
                                </div>
                            </div>

                            @foreach ($bilhetes as $bilhete)
                            <div class="card mb-3 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <div>
                                                <img src="{{asset('storage/cartazes/'.$bilhete->sessao->filme->cartaz_url)}}" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                            </div>
                                            <div class="ms-3">
                                                <h5>{{$bilhete->sessao->filme->titulo}}</h5>
                                                <p class="small mb-0">{{date('d F Y', strtotime($bilhete->sessao->data)) }}, {{ date('H:i', strtotime($bilhete->sessao->horario_inicio)) }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="mx-3">
                                                <h5 class="mb-0">{{ number_format($preco_bilhete_com_iva,2) }} €</h5>
                                                <p class="small fw-normal mb-0">{{__('Per Ticket')}}</p>

                                            </div>
                                            <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="col-lg-5">

                            <div class="card bg-primary text-white rounded-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="mb-0">{{__('Payment details')}}</h5>
                                        <img src="{{asset('storage/fotos/'.Auth::user()->foto_url)}}" class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
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
        </div>
    </div>
</div>
@endsection