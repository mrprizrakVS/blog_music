<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/common.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="top_line">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8">

            </div>
            @guest
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                    <div class="login">
                        <span><a href="{{ route('login') }}">{{ __('Login') }}</a></span>
                        <span><a href="{{ route('register') }}">{{ __('Register') }}</a></span>
                    </div>
                </div>
                @else
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4">
                        <div class="login">
                            <span><a href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a></span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        @endguest
                    </div>
        </div>
    </div>
</div>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo col-lg-9 col-md-8 col-sm-7 col-xs-12">
                <a href="/"><img src="{!! asset('img/logo.png') !!}" alt=""></a>

            </div>
            <div class="search_block col-lg-3 col-md-4 col-sm-5 col-xs-12">
                <form class="search" action="{{route('music.search')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="text" name="search" placeholder="Шукати..." value="{{old('search')}}"> <i
                            class="search_button fa fa-search"
                            aria-hidden="true"></i>
                    <button class="btn btn-primary" type="submit">Шукати</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="main_menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul>

                    <li><a href="{{route('article.index')}}">Новини</a></li>
                    <li><a href="{{route('music.index')}}">Музика</a></li>
                    <li><a href="{{route('playlist.index')}}">Плейлисти</a></li>
                    @if(\Auth::check() && \Auth::user()->isAdmin == 1)
                        <li><a href="{{route('genre.index')}}">Жанри</a></li>
                    @endif
                </ul>
            </div>


        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="content">

                @yield('content')
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="center">КН-14-2 Нечай О.В.</span>
            </div>
        </div>
    </div>

</div>

</body>
</html>
