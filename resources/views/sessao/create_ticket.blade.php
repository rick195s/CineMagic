@extends('layouts.app')

@section('title', __('Choose seat Ticket'))

@section('content')




<!-- content -->
<section class="home">

    <!-- home bg -->
    <div class="owl-carousel home__bg">
        <div class="item home__cover" data-bg="{{asset('storage/cartazes/'.$sessao->filme->cartaz_url)}}"></div>
    </div>
    <!-- end home bg -->
    <div class="container">
        <!-- content tabs -->
        <div class="sign__form" id="myTabContent">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{$sessao->filme->titulo}}</h2>
                    <div class="card__cover w-75">
                        <img src="{{asset('storage/cartazes/'.$sessao->filme->cartaz_url)}}" alt="">
                    </div>
                    <hr>
                    <p>{{__('Screen Room')}}: {{$sessao->sala->nome}}</p>
                    <p>{{__('Data')}}: {{$sessao->data}}</p>
                    <p>{{__('Starting Hour')}}: {{$sessao->horario_inicio}}</p>
                </div>
                <div class="col-md-8">
                    @foreach ($filas as $fila => $lugares)
                    <div class="row my-3">
                        <h3>{{$fila}}</h3>
                        <hr>

                        @foreach ($lugares as $lugar)
                        <div class="col-2 mx-1">
                            <div class="fa-4x">
                                @if ($sessao->ocupado($lugar->id))
                                <span class="fa-layers text-muted fa-fw">
                                    <i data-fa-transform="shrink-2" class="fas fa-couch"></i>
                                    <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11 up-2" style="color:black; font-weight:900">{{$lugar->posicao}}</span>
                                </span>
                                @else
                                <a href="" class="seats">
                                    <span class="fa-layers  fa-fw">
                                        <i data-fa-transform="shrink-2" class="fas fa-couch"></i>
                                        <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11 up-2" style="color:black; font-weight:900">{{$lugar->posicao}}</span>
                                    </span>
                                </a>
                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>
                    @endforeach
                </div>

            </div>

        </div>
        <!-- end content tabs -->
    </div>
</section>


<!-- end content -->


@endsection