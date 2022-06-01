<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/plyr.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/main.css')}}">

    <!-- css criado por nos -->
    <link rel="stylesheet" href="{{asset('css/app/custom.css')}}">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
</head>

<body class="body">
    <div id="app">
        <!-- header -->
        <header class="header container-fluid">
            <div class="header__wrap">
                <div class="header__content">

                    <!-- header logo -->
                    <a href="{{route('home')}}" class="header__logo text-white">
                        <h1 class="display-6">{{config('app.name', 'Laravel') }}</h1>
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">
                        <li class="header__nav-item">
                            <a class="dopdown-toggle header__nav-link" href="{{route('home') }}">{{__('Home')}}</a>
                        </li>

                        @if (auth()->user()->isAdmin())
                        <li class="header__nav-item">
                            <a class="dopdown-toggle header__nav-link" href="{{route('admin.index') }}">{{__('Dashboard')}}</a>
                        </li>
                        @endif

                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>

                        <!-- Authentication Links -->
                        @guest
                        <div class="row row d-flex justify-content-between align-items-center text-end text-end">

                            @if (Route::has('login'))
                            <div class="col-4 ">
                                <a href="{{ route('login') }}" class="btn-primary header__sign-in">
                                    <i class="icon ion-ios-log-in"></i>
                                    <span> {{ __('Login') }}</span>
                                </a>
                            </div>
                            @endif
                            @if (Route::has('register'))
                            <div class="col-4">
                                <a href="{{ route('register') }}" class="d-none d-sm-inline-block">
                                    {{ __('Register') }}
                                </a>
                            </div>
                            @endif

                        </div>
                        @else

                        <a id="dropdownUser" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->foto_url ? asset('storage/fotos/' .
                                    auth()->user()->foto_url) : asset('img/default_img.png') }}" alt="mdo" class="rounded img-fluid" width="40" height="40">
                            <p class="d-none d-sm-inline-block"> {{ explode(' ', auth()->user()->name)[0] }}</p>

                        </a>
                        <div class="dropdown text-end" aria-labelledby="dropdownUser">
                            <ul class="dropdown-menu text-small">
                                <li>
                                    <a class="dropdown-item" href="{{ auth()->user()->isAdmin() ? route('admin.users.edit', auth()->user()->id) : route('client.profile') }}">{{__('Profile')}}</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endguest

                    </div>
                    <!-- end header auth -->

                    <!-- header menu btn -->
                    <button class="header__btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end header menu btn -->
                </div>
            </div>

            <!-- header search -->
            <form action="#" class="header__search">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header__search-content">
                                <input type="text" placeholder="{{__('Search for a movie, TV Series that you are looking for')}}">

                                <button type="button">{{__('search')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- end header search -->
        </header>
        <!-- end header -->

        @include('flash-messages')
        @yield('content')
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="{{ asset('js/app/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/app/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/app/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/app/jquery.mousewheel.min.js')}}"></script>
    <script src="{{ asset('js/app/jquery.mCustomScrollbar.min.js')}}"></script>
    <script src="{{ asset('js/app/wNumb.js')}}"></script>
    <script src="{{ asset('js/app/nouislider.min.js')}}"></script>
    <script src="{{ asset('js/app/plyr.min.js')}}"></script>
    <script src="{{ asset('js/app/jquery.morelines.min.js')}}"></script>
    <script src="{{ asset('js/app/photoswipe.min.js')}}"></script>
    <script src="{{ asset('js/app/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{ asset('js/app/main.js')}}"></script>
</body>

</html>