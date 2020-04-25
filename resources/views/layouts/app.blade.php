<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161556506-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-161556506-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Γριφομπότ by ΓΑΒ LAB</title>
    <meta property="description" content="Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα"/>
    <meta property="keywords" content="εκπαιδευτικό παιχνίδι, δημοτικό, παιχνίδι, ερωτήσεις, μαθηματικά, γλώσσα, ΓΑΒ LAB, Γριφομπότ, online παιχνίδι"/>
    <meta name="author" content="Ερευνητικό Εργαστήριο Γνώσης και Αβεβαιότητας - ΓΑΒ LAB">
    <meta property="og:title" content="Γριφομπότ by ΓΑΒ LAB">
    <meta property="og:description" content="Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα">
    <meta property="og:url" content="http://grifobot.gr"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>
    <meta property="fb:app_id" content="713822995484844"/>
    <meta name=”twitter:title” content=”White Γριφομπότ by ΓΑΒ LAB”>
    <meta name=”twitter:description” content=”Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα.”>
    <meta name=”twitter:image” content=”http://grifobot.gr”>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=greek" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        .f {
            display: inline-block;
            text-align: center;
        }
        .n {
            text-align: center;
            border-bottom: 1px solid black;
        }

        .d {
            text-align: center;
        }
        .fraction {
            display: inline-block;
            padding: 0 0.2em;
            text-align: center;
            vertical-align: middle;
        }
        .fraction:before {
            border-bottom: 1px solid #000;
            content: attr(top);
            display: block;
            line-height: 1.6em;
            padding: 0 0.2em;
        }
        .fraction:after {
            content: attr(bottom);
            display: block;
            line-height: 1.6em;
            padding: 0 0.2em;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('fa/css/font-awesome.min.css') }}">

    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Γριφο<span style="color:deeppink">μπότ</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                @guest


                @else
                    @if(Auth::user()->role == 'admin')
                        <!-- Left Side Of Navbar -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ασκήσεις</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">
                                    <a class="dropdown-item" href="{{ route('maths.index') }}">Όλες</a>
                                    @for($i=1; $i<7; $i++)
                                        <a class="dropdown-item" href="{{ route('maths_level', $i) }}">{{ display_level($i) }}</a>
                                    @endfor
                                </div>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.index') }}">Κατηγορίες</a>
                                </li>


                    @endif
                    @if(Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
                        <!-- Left Side Of Navbar -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('quiz_my') }}">Κουίζ</a>
                            </li>
                        @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user_home') }}">Αρχική</a>
                            </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Γριφομπότ</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="nav-link" href="{{ route('about') }}">Τι είναι</a>
                                <a class="nav-link" href="{{ route('quiz') }}">Γριφομπότ Κουίζ</a>
                                <a class="nav-link" href="{{ route('help') }}">Οδηγίες</a>
                                <a class="nav-link" href="{{ route('students') }}">Παιδιά και Γριφομπότ</a>
                                <a class="nav-link" href="{{ route('contact') }}">Επικοινωνία</a>
                            </div>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.facebook.com/grifobot" target="_blank" style="color: blue;"><i class="fa fa-facebook-official"></i> Γριφομπότ@Facebook</a>
                            </li>
                @endguest
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user_home') }}">
                                        Αρχική
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user_change_profile') }}">
                                        Αλλαγή προφίλ
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="text-center">
            Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/>

            <small>
                <a href="{{route('about')}}">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}">Οδηγίες</a> | <a href="{{route('version')}}">Έκδοση 1.3 (deeppink)</a> | <a href="{{route('contact')}}">Επικοινωνία</a>
                <br/>additional graphics designed by <a href="https://www.facebook.com/aggelakosPnM/" target="_blank">Yannis Aggelakos</a><br/>
                Images for animal avatars by freepik (<a href="http://www.freepik.com">Designed by Freepik</a>)<br/>
                tech support by <a href="http://osporos.com">O Sporos</a>
                <br/>
                @yield('footer')
            </small>
            <br/>
            <div class="float-right" id="footer_msg" style="font-size: 5px;"></div>
        </footer>
    </div>
    @yield('javascript')
</body>
</html>
