<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

</head>

<body class="body">

    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @yield('content')
                </div>
            </div>
        </div>
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