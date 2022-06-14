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

    <!-- Icons da fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script>


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

        @include('layouts.partials.app_navbar')

        @include('flash-messages')

        <!-- page title -->
        @yield('page-title')
        <!-- end page title -->

        <section class="home ">

            @yield('home')
        </section>

        <section class="content">
            @yield('content')
        </section>



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
        @yield('scripts')
</body>

</html>