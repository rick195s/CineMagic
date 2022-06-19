<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    @yield('scripts')

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
                <a class="sidebar-brand" href="{{ route('home') }}">
                    <span class="align-middle"> {{ config('app.name', 'Laravel') }}</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        {{ __('Pages') }}
                    </li>

                    @if (auth()->user()->isAdmin())
                        <li class="sidebar-item {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.index') }}">
                                <i class="align-middle" data-feather="sliders"></i> <span
                                    class="align-middle">{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                    @endif

                    @can('viewAny', App\Models\User::class)
                        <li
                            class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.users') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                                <i class="align-middle me-2" data-feather="users"></i> <span
                                    class="align-middle">{{ __('Users') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', App\Models\Sala::class)
                        <li
                            class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.salas') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.salas.index') }}">
                                <i class="align-middle me-2" data-feather="tv"></i> <span
                                    class="align-middle">{{ __('Movie Theaters') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', App\Models\Filme::class)
                        <li
                            class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.filmes') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.filmes.index') }}">
                                <i class="align-middle me-2" data-feather="film"></i> <span
                                    class="align-middle">{{ __('Movies') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('viewAny', App\Models\Sessao::class)
                        <li
                            class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.sessoes') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.sessoes.index') }}">
                                <i class="align-middle me-2" data-feather="video"></i> <span
                                    class="align-middle">{{ __('Sessions') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>


            </div>
        </nav>

        <div class="main">
            @include('layouts.partials.dashboard_navbar')

            @include('flash-messages')

            <main class="content">
                @yield('content')

            </main>


        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>


</html>
