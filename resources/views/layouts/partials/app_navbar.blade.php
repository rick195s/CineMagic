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
                @auth

                @if (auth()->user()->isAdmin())
                <li class="header__nav-item">
                    <a class="dopdown-toggle header__nav-link" href="{{route('admin.index') }}">{{__('Dashboard')}}</a>
                </li>
                @endif

                @endauth

            </ul>
            <!-- end header nav -->

            <!-- header auth -->
            <div class="header__auth">
                <button class="text-light mx-3" style="font-size: 26px;" type="button">
                    <!-- colocamos aqui o codigo para ir buscar a informacao do carrinho para 
                    nao estarmos a fazer isto em quase todos os controladores  -->
                    {{ Session::has('carrinho') ? Session::get('carrinho')->quantidade() : '0' }}
                    <i class="icon ion-ios-cart "></i>
                </button>


                <button class="text-light header__search-btn" type="button">
                    <i class="icon ion-ios-search "></i>
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
                            <a class="dropdown-item" href="{{ route('change_password.index') }}">{{__('Change Password')}}</a>
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