@extends('layouts.app')
@section('title', __('Home'))

@section('home')
<!-- home bg -->
<div class="owl-carousel home__bg">
    @foreach ($destaques as $destaque)
    <div class="item home__cover" data-bg="{{asset('storage/cartazes/'.$destaque->cartaz_url)}}"></div>
    @endforeach
</div>
<!-- end home bg -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="home__title text-uppercase"><b>{{__('New Items')}}</b> {{__('of this season')}}</h1>

            <button class="home__nav home__nav--prev" type="button">
                <i class="icon ion-ios-arrow-round-back"></i>
            </button>
            <button class="home__nav home__nav--next" type="button">
                <i class="icon ion-ios-arrow-round-forward"></i>
            </button>
        </div>

        <div class="col-12">
            <div class="owl-carousel home__carousel">
                @foreach ($destaques as $destaque)
                <div class="item">
                    <!-- card -->
                    <div class="card border-0 rounded bg-transparent card--big">
                        <div class="card__cover">
                            <img src="{{asset('storage/cartazes/'.$destaque->cartaz_url)}}" alt="">
                            <a href="{{$destaque->trailer_url}}" target="_blank" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="{{ route('filmes.show', $destaque->id) }}">{{$destaque->titulo}}</a></h3>
                            <span class="card__category">
                                <a href="#">{{$destaque->genero->nome}}</a>
                            </span>
                            <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- end home -->
@endsection

@section('content')
<!-- content -->
<div class="content__head">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- content title -->
                <h2 class="content__title">{{__('New Items')}}</h2>
                <!-- end content title -->

                <!-- content tabs nav -->
                <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                    @foreach ($filmes_por_genero as $genero_nome => $filmes )
                    <li class="nav-item ">
                        <a class="nav-link  @if ($loop->first) active @endif" data-toggle="tab" href="#tab-{{$genero_nome}}" role="tab" aria-controls="tab-{{$genero_nome}}" aria-selected="@if($loop->first) true @else false @endif ">{{$genero_nome}}</a>
                    </li>
                    @endforeach
                </ul>
                <!-- end content tabs nav -->

                <!-- content mobile tabs nav -->
                <div class="content__mobile-tabs" id="content__mobile-tabs">
                    <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <input type="button" value="New items">
                        <span></span>
                    </div>

                    <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($filmes_por_genero as $genero_nome => $filmes )
                            <li class="nav-item">
                                <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#tab-{{$genero_nome}}" role="tab" aria-controls="#tab-{{$genero_nome}}" aria-selected="@if($loop->first) true @else false @endif ">{{$genero_nome}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- end content mobile tabs nav -->
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- content tabs -->
    <div class="tab-content" id="myTabContent">
        @foreach ($filmes_por_genero as $genero_nome => $filmes ) <div class="tab-pane fade show @if($loop->first) active @endif" id="tab-{{$genero_nome}}" role="tabpanel" aria-labelledby="tab-{{$genero_nome}}">
            <div class="row">
                <!-- card -->
                @foreach ($filmes as $filme)
                <div class="col-6 col-sm-12 col-lg-6">
                    <div class="card border-0 rounded bg-transparent card--list">
                        <div class="row">

                            <div class="col-12 col-sm-4">
                                <div class="card__cover">
                                    <img src="{{asset('storage/cartazes/'.$filme->cartaz_url)}}" alt="">
                                    <a href="{{$filme->trailer_url}}" target="_blank" class="card__play">
                                        <i class="icon ion-ios-play"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8">
                                <div class="card__content">
                                    <h3 class="card__title"><a href="{{ route('filmes.show', $filme->id) }}">{{ $filme->titulo }}</a></h3>
                                    <span class="card__category">
                                        <a href="#">{{ $genero_nome }}</a>

                                    </span>

                                    <div class="card__wrap">
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>

                                        <ul class="card__list">
                                            <li>HD</li>
                                            <li>{{ $filme->ano }}</li>
                                        </ul>
                                    </div>

                                    <div class="card__description">
                                        <p>{{$filme->sumario}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end card -->


            </div>
        </div>
        @endforeach
    </div>
    <!-- end content tabs -->
</div>
<!-- end content -->


@endsection