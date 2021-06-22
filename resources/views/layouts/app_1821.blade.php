<!DOCTYPE HTML>
<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Επανάσταση Γριφομπότ - Δήμος Μεσσήνης</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=greek" rel="stylesheet">
    <!--[if lte IE 8]><script src="{{ asset('1821/assets/js/ie/html5shiv.js') }}"></script><![endif]-->
    <link rel="stylesheet" href="{{ asset('1821/assets/css/main.css') }}" />
    <!--[if lte IE 9]><link rel="stylesheet" href="{{ asset('1821/assets/css/ie9.css') }}" /><![endif]-->


    <link rel="stylesheet" href="{{ asset('fa5/css/all.css') }}">

    <style>
        /* The image used */
        #banner {
            background-image: url("{{ asset('images/messini-old.jpg') }}");

            /* Set a specific height */
            height: 450px;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 3em;
        }
        /* The image used */
        #banner-small {
            background-image: url("{{ asset('images/messini-old.jpg') }}");

            /* Set a specific height */
            height: 250px;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 3em;
        }

        #logo {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        #user {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Add a black background color to the top navigation */
        .topnav {
            background-color: #645A52;
            overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: right;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav strong {
            color: #5697AA;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Add a color to the active/current link */
        .topnav a.active {
            background-color: #5697AA;
            color: white;
        }

        #banner section h2, #banner-small section h2 {
            padding: 10px;
            color: #444;
            background-color: rgba(235, 235, 235, 0.5);
        }

        #banner section p, #banner-small section p {
            text-align: justify;
            padding: 10px;
            color: #444;
            background-color: rgba(235, 235, 235, 0.5);
        }

        #banner .actions, #banner-small .actions {
            text-align:center;
        }

        #one p {
            text-align: justify;
        }

        .inner section img {
            position: -webkit-sticky; /* Safari */
            position: sticky;
            top: 5px;;
        }

    </style>

    @yield('stylesheet')
</head>
<body>
<div class="topnav">
    <span id="logo"><img src="{{ asset('1821/images/vic.png') }}" style="max-height:30px; float:left; padding-right:10px;" /> Γριφομπότ Επανάσταση @yield('town') </span>

    <span id="user">
        @yield('userdata')
</span>
    @yield('menu')
</div>
<!-- Banner -->
@yield('banner')

@yield('content')



<!-- Footer -->
<footer id="footer">
    <div class="copyright">
        Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr" target="_blank"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a> | Implementation by <a href="http://innovation.gav.uop.gr" target="_blank">Χώρος Καινοτομίας του ΓΑΒ LAB</a><br/>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('1821/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('1821/assets/js/skel.min.js') }}"></script>
<script src="{{ asset('1821/assets/js/util.js') }}"></script>
<!--[if lte IE 8]><script src="{{ asset('1821/assets/js/ie/respond.min.js') }}"></script><![endif]-->
<script src="{{ asset('1821/assets/js/main.js') }}"></script>

@yield('javascript')
</body>
</html>
