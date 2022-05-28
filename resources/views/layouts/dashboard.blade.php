<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">


</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle"> {{ config('app.name', 'Laravel') }}</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        {{__('Pages')}}
                    </li>

                    <li class="sidebar-item {{Route::currentRouteName() == 'admin.index'? 'active': ''}}">
                        <a class="sidebar-link" href="{{route('admin.index')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{__('Dashboard')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{Str::startsWith( Route::currentRouteName(),'admin.users')? 'active': ''}}">
                        <a class="sidebar-link" href="{{route('admin.users.index')}}">
                            <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle">{{__('Users')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{Str::startsWith( Route::currentRouteName(),'admin.salas')? 'active': ''}}">
                        <a class="sidebar-link" href="{{route('admin.salas.index')}}">
                            <i class="align-middle me-2" data-feather="tv"></i> <span class="align-middle">{{__('Movie
                                Theaters')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{Str::startsWith( Route::currentRouteName(),'admin.filmes')? 'active': ''}}">
                        <a class="sidebar-link" href="{{route('admin.filmes.index')}}">
                            <i class="align-middle me-2" data-feather="film"></i> <span class="align-middle">{{__('Movies')}}</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{Str::startsWith( Route::currentRouteName(),'admin.sessoes')? 'active': ''}}">
                        <a class="sidebar-link" href="{{route('admin.sessoes.index')}}">
                            <i class="align-middle me-2" data-feather="video"></i> <span class="align-middle">{{__('Sessions')}}</span>
                        </a>
                    </li>
                </ul>


            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->foto_url ? asset('storage/fotos/' .
                                    Auth::user()->foto_url) : asset('img/default_img.png') }}" class="avatar img-fluid rounded me-1" alt="Fotografia" />

                                <span class="text-dark">
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> {{ __('Logout')
                                    }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest

                    </ul>
                </div>
            </nav>

            @include('flash-messages')

            <main class="content">
                @yield('content')

            </main>


        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>


</html>