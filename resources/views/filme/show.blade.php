@extends('layouts.app')
@section('title', $filme->titulo )

@section('content')

<!-- details -->
<section class="section details">
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


            <!-- accordion -->
            <div class="my-5 col-12 col-xl-8">
                <div class="accordion" id="accordion">
                    @if ($sessoes->count() == 0)
                    <h2>{{__('There are no Sessions for this movie')}}</h2>
                    @else
                    @foreach ($sessoes as $sessao)
                    <div class="accordion__card">
                        <div class="card-header" id="heading{{$loop->index}}">
                            <button type="button" data-toggle="collapse" data-target="#collapse{{$loop->index}}" aria-expanded="{{$loop->first ? true : false }}" aria-controls="collapse{{$loop->index}}">
                                @if ($loop->first)
                                <span>{{__('Next Session')}}</span>

                                @endif
                                <span>{{date('d F Y', strtotime( $sessao->data)) }}, {{ date('H:i', strtotime($sessao->horario_inicio)) }}</span>
                            </button>
                        </div>

                        <div id="collapse{{$loop->index}}" class="collapse {{$loop->first ? 'show' : '' }}" aria-labelledby="heading{{$loop->index}}" data-parent="#accordion">
                            <div class="card-body">
                                <table class="accordion__list">
                                    <tbody>
                                        <tr>
                                            @if ($sessao->sala)
                                            <td>{{__('Movie Theater')}}:</td>
                                            <td>{{$sessao->sala->nome}}</td>
                                            @else
                                            <td>{{__('Movie Theater Not Found')}}</td>
                                            @endif

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <!-- end accordion -->

            <div class="col-12">
                <div class="details__wrap">
                    <!-- availables -->
                    <div class="details__devices">
                        <span class="details__devices-title">Available on devices:</span>
                        <ul class="details__devices-list">
                            <li><i class="icon ion-logo-apple"></i><span>IOS</span></li>
                            <li><i class="icon ion-logo-android"></i><span>Android</span></li>
                            <li><i class="icon ion-logo-windows"></i><span>Windows</span></li>
                            <li><i class="icon ion-md-tv"></i><span>Smart TV</span></li>
                        </ul>
                    </div>
                    <!-- end availables -->

                    <!-- share -->
                    <div class="details__share">
                        <span class="details__share-title">Share with friends:</span>

                        <ul class="details__share-list">
                            <li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>
                            <li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>
                            <li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>
                            <li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>
                        </ul>
                    </div>
                    <!-- end share -->
                </div>
            </div>
        </div>
    </div>
    <!-- end details content -->
</section>
<!-- end details -->

@endsection