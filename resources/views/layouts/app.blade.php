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
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="{{asset('bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <style type="text/css">
        body {
            padding-bottom: 70px;
        }
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

        .background-greece {
            background: repeating-linear-gradient(
                20deg,
                rgba(176, 181, 212, 0.15),
                rgba(176, 181, 212, 0.15) 50px,
                rgba(45, 70, 203, 0.15) 50px,
                rgba(45, 70, 203, 0.15) 100px
            );
        }
    </style>
    <link rel="stylesheet" href="{{ asset('fa/css/font-awesome.min.css') }}">

    @yield('stylesheet')
</head>
<body class="background-greece">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Γριφομπότ 1821
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('maths.index') }}">Ασκήσεις</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.index') }}">Κατηγορίες</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('towns.index') }}">Πόλεις</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('quiz.index') }}">Κουίζ</a>
                                </li>


                    @endif
                    @if(Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
                        <!-- Left Side Of Navbar -->
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('quiz_my') }}">Κουίζ</a>--}}
{{--                            </li>--}}
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Γριφομπότ
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <div class="navbar fixed-bottom navbar-light bg-light">
        <div class="row">
            <div class="col-sm-12">
                <div style="font-size: 10px" class="text-left">
                    Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/>
                    <br/>
                    @yield('footer')
                </div>
            </div>
        </div>





        <div class="float-right" id="footer_msg" style="font-size: 5px;"></div>
    </div>
    @yield('javascript')
</body>
</html>
