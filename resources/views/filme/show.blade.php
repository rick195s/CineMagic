@extends('layouts.app')
@section('title', $filme->titulo )

@section('home')

<!-- details background -->
<div class="details__bg" data-bg="img/home/home__bg.jpg"></div>
<!-- end details background -->


<!-- details content -->
<div class="container">
    <div class="row">
        <!-- title -->
        <div class="col-12">
            <h1 class="details__title">{{$filme->titulo}}</h1>
        </div>
        <!-- end title -->

        <!-- content -->
        <div class="col-12 col-xl-6">
            <div class="card card--details">
                <div class="row">
                    <!-- card cover -->
                    <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">
                        <div class="card__cover">
                            <img src="{{asset('storage/cartazes/'.$filme->cartaz_url)}}" alt="capa">
                        </div>
                    </div>
                    <!-- end card cover -->

                    <!-- card content -->
                    <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                        <div class="card__content">
                            <div class="card__wrap">
                                <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>

                                <ul class="card__list">
                                    <li>HD</li>
                                    <li>{{$filme->ano}}</li>
                                </ul>
                            </div>

                            <ul class="card__meta">
                                <li><span>{{__('Genre')}}:</span> <a href="#">{{$filme->genero->nome}}</a>
                                </li>
                                <li><span>{{__('Release year')}}:</span> {{$filme->ano}}</li>
                            </ul>

                            <div class="card__description card__description--details">
                                {{$filme->sumario}}
                            </div>
                        </div>
                    </div>
                    <!-- end card content -->
                </div>
            </div>
        </div>
        <!-- end content -->

        <!-- player -->
        <div class="col-12 col-xl-6">
            <div class="plyr__video-embed" id="player">
                <iframe src="{{$filme->trailer_url}}" allowfullscreen allowtransparency allow="autoplay"></iframe>
            </div>
        </div>
        <!-- end player -->



    </div>
</div>
<!-- end details content -->
@endsection


@section('content')

<!-- content -->
<div class="content__head">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- content title -->
                <h2 class="content__title">{{__('Sessions')}}</h2>
                <!-- end content title -->

                <!-- content tabs nav -->
                <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                    @foreach ($conj_sessoes as $tipo_sessoes => $sessoes)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : ''}} " data-toggle="tab" href="#tab-{{$loop->index}}" role="tab" aria-controls="tab-{{$loop->index}}" aria-selected="{{$loop->first ? 'true' : 'false'}}">5 {{$tipo_sessoes}}</a>
                    </li>

                    @endforeach

                </ul>
                <!-- end content tabs nav -->

                <!-- content mobile tabs nav -->
                <div class="content__mobile-tabs" id="content__mobile-tabs">
                    <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <input type="button">
                        <span></span>
                    </div>

                    <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($conj_sessoes as $tipo_sessoes => $sessoes)
                            <li class="nav-item"><a class="nav-link {{ $loop->first ? 'active' : ''}}" id="{{$loop->index}}-tab" data-toggle="tab" href="#tab-{{$loop->index}}" role="tab" aria-controls="tab-{{$loop->index}}" aria-selected="{{$loop->first ? 'true' : 'false'}}">5 {{$tipo_sessoes}}</a></li>
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

    <div class="row">
        <div class="col-12 col-lg-8 col-xl-8">
            <!-- content tabs -->
            <div class="tab-content" id="myTabContent">
                @foreach ($conj_sessoes as $sessoes)

                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }} " id="tab-{{$loop->index}}" role="tabpanel" aria-labelledby="{{$loop->index}}-tab">
                    <div class="row">
                        <div class="col-12">
                            <!-- accordion -->
                            <div class="accordion " id="accordion{{$loop->index}}">
                                @if (count($sessoes) == 0)
                                <h2>{{__('There are no Sessions for this movie')}}</h2>
                                @else
                                @foreach ($sessoes as $sessao)
                                <div class="accordion__card">
                                    <div class="card-header" id="heading{{$loop->index}}">
                                        <button type="button" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="{{$loop->first ? true : false }}" aria-controls="collapse{{$loop->index}}">
                                            @if ($loop->first)
                                            <span>{{__('Next Session')}}</span>

                                            @endif
                                            <span>{{date('d F Y', strtotime($sessao->data)) }}, {{ date('H:i', strtotime($sessao->horario_inicio)) }}</span>
                                        </button>
                                    </div>

                                    <div id="collapse{{$loop->index}}" class="collapse {{$loop->first ? 'show' : '' }}" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion{{$loop->parent->index}}">
                                        <div class="card-body">
                                            <table class="accordion__list">
                                                <tbody>
                                                    <tr>
                                                        @isset ($salas[$sessao->sala_id])
                                                        <td>{{__('Movie Theater')}}:</td>
                                                        <td class="text-end">{{$salas[$sessao->sala_id]->nome}}</td>
                                                        @else
                                                        <td>{{__('Movie Theater Not Found')}}</td>
                                                        @endif
                                                    </tr>
                                                    @can('adicionar', [Session::get('carrinho') ?? new App\Models\Carrinho, $sessao])
                                                    <tr>
                                                        <td colspan="2" class="text-end">
                                                            <a class="text-white btn btn-sm bg-success" href="{{route('carrinho.adicionar', $sessao->id)}}">
                                                                {{__('Add to Cart')}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endcan
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <!-- end accordion -->

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

        <!-- sidebar -->
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="row">
                <!-- section title -->
                <div class="col-12">
                    <h2 class="section__title section__title--sidebar">{{__('You may also like...')}}</h2>
                </div>
                <!-- end section title -->

                @foreach ($destaques as $destaque)

                <!-- card -->
                <div class="col-6 col-sm-4 col-lg-6">
                    <div class="card">
                        <div class="card__cover">
                            <img src="{{asset('storage/cartazes/'.$destaque->cartaz_url)}}" alt="">
                            <a href="{{$destaque->trailer_url}}" target="_blank" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="{{ route('filmes.show', $destaque->id) }}">{{ $destaque->titulo }}</a></h3>
                            <span class="card__category">
                                <a href="#">{{ $destaque->genero->nome }}</a>
                            </span>
                            <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                @endforeach

            </div>
        </div>
        <!-- end sidebar -->
    </div>
</div>
<!-- end content -->
@endsection