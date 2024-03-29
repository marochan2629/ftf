<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FTF</title>

    <!-- Scripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="https://js.stripe.com/v3/"></script> -->
</head>
<body style="padding-top: 55px; background-color:#f6f6f3;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand header-logo" href="{{ url('/') }}">
                    FTF
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @if(\Auth::guard('user')->check())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('user')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('question.create') }}">
                                        {{ __('質問を送る') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('photo.create') }}">
                                        {{ __('写真を投稿する') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('user.mypage', Auth::guard('user')->user()->id) }}">
                                        {{ __('マイページ') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @elseif(\Auth::guard('associate')->check())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('associate')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('associate.mypage', Auth::guard('associate')->user()->id) }}">
                                        {{ __('マイページ') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('article.create') }}">
                                        {{ __('記事を作成する') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('unanswered.questions') }}">
                                        {{ __('質問に回答する') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('photo.create') }}">
                                        {{ __('写真を投稿する') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('associate.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('associate.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item header-logo">
                                <a class="nav-link" href="{{ route('user.login') }}">{{ __('User Login') }}</a>
                            </li>
                            <li class="nav-item header-logo">
                                <a class="nav-link" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if (session('flash_message'))
                <div class="login-error flash-message bg-warning text-center">
                    {{ session('flash_message') }}
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="py-0 footer">
            <div class="footer-wrapper">
                <div class="footer-main">
                    <a class="footer-title" href="/">
                        Face to Faith
                    </a>
                    <div class="footer-services">
                        <ul class="footer-service-list">
                            <li><a href="/article/index">読む</a></li>
                            <li><a href="/question/index">聞く</a></li>
                            <li><a href="/photo/index">見る</a></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-second">
                    <ul class="footer-detail">
                        <li><a href="/about">Face to Faithとは</a></li>
                        <li><a href="/policy">プライバシーポリシー</a></li>
                        <li><a href="#">企業情報</a></li>
                        <li><a href="#">お問い合わせ</a></li>
                        <li><a href="/associate/login">FTFアソシエイトはこちら</a></li>
                    </ul>
                </div>
            </div>
            
        </footer>

    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/photo.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script> -->
    <!-- <script src="/node_modules/readmore-js/readmore.min.js"></script> -->

</body>
</html>