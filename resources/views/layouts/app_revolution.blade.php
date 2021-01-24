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

    <title>Επανάσταση Γριφομπότ - Δήμος Μεσσήνης</title>
    <meta property="description" content="Εκπαιδευτικό παιχνίδι για μαθητές σχολείων που αφορά τους εορτασμούς των 200 ετών από την επανάσταση του 1821"/>
    <meta property="keywords" content="εκπαιδευτικό παιχνίδι, δημοτικό, παιχνίδι, ερωτήσεις, 200 χρόνια, Επανάσταση 1821, ΓΑΒ LAB, Γριφομπότ, online παιχνίδι"/>
    <meta name="author" content="Ερευνητικό Εργαστήριο Γνώσης και Αβεβαιότητας - ΓΑΒ LAB">
    <meta property="og:title" content="Επανάσταση Γριφομπότ by ΓΑΒ LAB">
    <meta property="og:description" content="Εκπαιδευτικό παιχνίδι για μαθητές σχολείων που αφορά τους εορτασμούς των 200 ετών από την επανάσταση του 1821">
    <meta property="og:url" content="http://1821.grifobot.gr"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>
    <meta property="fb:app_id" content="713822995484844"/>
    <meta name=”twitter:title” content=”Επανάσταση Γριφομπότ by ΓΑΒ LAB”>
    <meta name=”twitter:description” content=”Εκπαιδευτικό παιχνίδι για μαθητές σχολείων που αφορά τους εορτασμούς των 200 ετών από την επανάσταση του 1821.”>
    <meta name=”twitter:image” content=”http://1821.grifobot.gr”>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Scripts -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <script src="{{asset('bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">


    <style type="text/css">
        body {
            font-family: 'EB Garamond', serif !important;
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
            font-family: 'EB Garamond', serif;
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
            color: #1b4b72;
        }

        .manouri-shadow {
            text-shadow: 3px 3px 3px #0f6674;
        }
        .form-control-xl{
            height:calc(5rem + 2px);
            padding:.5rem 1rem;
            font-size:3rem;
            line-height:1.5;
            border-radius:.3rem
        }

        .background-greece {
            background: repeating-linear-gradient(
                12deg,
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
        <div class="container-fluid">
            <div class="row mt-lg-5">
                <div class="col-sm-12 text-center">
                    <h1 class="manouri manouri-xl manouri-color manouri-shadow"><img src="https://www.messini.gr/images/logo.png" />Δήμος Μεσσήνης - Επανάσταση Γριφο<span style="color:firebrick">μπότ</span> </h1>
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
