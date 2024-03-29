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

    <title>ΓριφομπότΚΟΥΙΖ by ΓΑΒ LAB</title>
    <meta property="description" content="Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα"/>
    <meta property="keywords" content="εκπαιδευτικό παιχνίδι, δημοτικό, παιχνίδι, ερωτήσεις, μαθηματικά, γλώσσα, ΓΑΒ LAB, Γριφομπότ, online παιχνίδι"/>
    <meta name="author" content="Ερευνητικό Εργαστήριο Γνώσης και Αβεβαιότητας - ΓΑΒ LAB">
    <meta property="og:title" content="Γριφομπότ by ΓΑΒ LAB">
    <meta property="og:description" content="Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα">
    <meta property="og:url" content="http://grifobot.gr"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>
    <meta property="fb:app_id" content="713822995484844"/>
    <meta name=”twitter:title” content=”White ΓριφομπότΚΟΥΙΖ by ΓΑΒ LAB”>
    <meta name=”twitter:description” content=”Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα.”>
    <meta name=”twitter:image” content=”http://grifobot.gr”>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Scripts -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="{{asset('bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=greek" rel="stylesheet">
    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=greek" rel="stylesheet">

    <style type="text/css">
        body {
            padding-bottom: 70px;
        }
        .back-gray {
            background-color: #eee;
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

        .manouri {
            font-family: Manoyri;
        }

        .manouri-lg {
            font-size: 40px;
        }
        .manouri-xl {
            font-size: 60px;
        }
        .manouri-md {
            font-size: 20px;
        }

        .manouri-color {
            color: dodgerblue;
        }

        .manouri-shadow {
            text-shadow: 3px 3px 3px mediumvioletred;
        }
        .form-control-xl{
            height:calc(5rem + 2px);
            padding:.5rem 1rem;
            font-size:3rem;
            line-height:1.5;
            border-radius:.3rem
        }

        .color-change-2x {
            -webkit-animation: color-change-2x 10s linear infinite alternate both;
            animation: color-change-2x 10s linear infinite alternate both;
        }

/* /* /* ----------------------------------------------
 * Generated by Animista on 2020-4-22 11:3:23
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info.
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

        /**
         * ----------------------------------------
         * animation color-change-2x
         * ----------------------------------------
         */
        @-webkit-keyframes color-change-2x {
            0% {
                background: #19dcea;
            }
            100% {
                background: #b22cff;
            }
        }
        @keyframes color-change-2x {
            0% {
                background: #19dcea;
            }
            100% {
                background: #b22cff;
            }
        }

    </style>
    <link rel="stylesheet" href="{{ asset('fa/css/font-awesome.min.css') }}">

    @yield('stylesheet')
</head>
<body class="color-change-2x">
    <div id="app">
        <div class="container-fluid">
            <div class="row mt-lg-5">
                <div class="col-sm-12 text-center">
                    <h1>Γριφο<span style="color:firebrick">μπότ</span> <span class="manouri manouri-xl manouri-color manouri-shadow">ΚΟΥΙΖ</span> </h1>
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="navbar fixed-bottom navbar-light bg-light">
        <div class="row">
            <div class="col-sm-12">
                <div style="font-size: 10px" class="text-left">
                    Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/>


                    <a href="{{route('about')}}" target="_blank">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}" target="_blank">Οδηγίες</a> | <a href="{{route('version')}}" target="_blank">Έκδοση 1.4 (firebrick)</a> | <a href="{{route('contact')}}" target="_blank">Επικοινωνία</a>
                    <br/>additional graphics designed by <a href="https://www.facebook.com/aggelakosPnM/" target="_blank">Yannis Aggelakos</a> |
                    Images for animal avatars by freepik (<a href="http://www.freepik.com" target="_blank">Designed by Freepik</a>) |
                    tech support by <a href="http://osporos.com" target="_blank">O Sporos</a>
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
