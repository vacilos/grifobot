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

    <title>Γριφομπότ 1821 by Χώρος Καινοτομίας του ΓΑΒ LAB</title>
    <meta property="description" content="Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα"/>
    <meta property="keywords" content="εκπαιδευτικό παιχνίδι, δημοτικό, παιχνίδι, ερωτήσεις, μαθηματικά, γλώσσα, ΓΑΒ LAB, Γριφομπότ, online παιχνίδι"/>
    <meta name="author" content="Ερευνητικό Εργαστήριο Γνώσης και Αβεβαιότητας - ΓΑΒ LAB">
    <meta property="og:title" content="Γριφομπότ by ΓΑΒ LAB">
    <meta property="og:description" content="Παιχνίδι για μαθητές Δημοτικού και Νηπιαγωγείου για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα">
    <meta property="og:url" content="http://1821.grifobot.gr"/>
    <meta property="og:image" content="{{asset('images/logo.png')}}"/>
    <meta property="fb:app_id" content="713822995484844"/>

    <meta name=”twitter:title” content=”White Γριφομπότ 1821 by Χώρος Καινοτομίας του ΓΑΒ LAB”>
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
    <!-- Fonts -->
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Noto Serif', serif;
            font-weight: 200;
            margin: 0;
        }


        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            float:right;
            padding: 10px;
        }

        .content {
            text-align: center;
            clear:both;
            padding-top:50px;
        }

        .title {
            font-size: 60px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        a {
            color: #636b6f;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('fa/css/font-awesome.min.css') }}">

</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/el_GR/sdk.js#xfbml=1&autoLogAppEvents=1&version=v6.0&appId=713822995484844"></script>
<body>
<div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        Γριφο<span style="color: firebrick;">μπότ</span> της <span style="color: #1b4b72">Επανάστασης</span>
                    </div>

                    <div>
                        <p>
                            Θεματικό παιχνίδι με ερωτήσεις ιστορίας για τον εορτασμό των 200 ετών από την επανάσταση του 1821.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-deck">

                    <div class="card">
                        <a href="http://1821.grifobot.gr/t/messini">
                        <img src="{{ asset('1821/images/messini.jpeg') }}" class="card-img-top img-fluid" alt="Δήμος Μεσσήνης">
                        <div class="card-body">
                            <h5 class="card-title">Δήμος Μεσσήνης</h5>
                            <p class="card-text">Η Μεσσήνη στην επανάσταση του 1821</p>

                        </div>
                        </a>
                    </div>


                    <div class="card">
                        <a href="http://1821.grifobot.gr/t/ermionida">
                        <img src="{{ asset('1821/images/ermionida.jpeg') }}" class="card-img-top img-fluid" alt="Δήμος Ερμιονίδας">
                        <div class="card-body">
                            <h5 class="card-title">Δήμος Ερμιονίδας</h5>
                            <p class="card-text">Η Ερμιονίδα στην επανάσταση του 1821</p>
                        </div>
                        </a>
                    </div>


                        <div class="card">
                            <a href="http://1821.grifobot.gr/t/trifylia">
                                <img src="{{ asset('1821/images/trifylia.jpeg') }}" class="card-img-top img-fluid" alt="Δήμος Τριφυλία">
                                <div class="card-body">
                                    <h5 class="card-title">Δήμος Τριφυλίας</h5>
                                    <p class="card-text">Η Τριφυλία στην επανάσταση του 1821</p>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12"></div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12">
                    <div>
                        <a href="http://grifobot.gr">Γριφομπότ</a> | <a href="{{route('about')}}">Τι είναι το Γριφομπότ της Επανάστασης</a> | <a href="{{route('help')}}">Οδηγίες</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div style="font-size:11px;">
                        <br/><br/>
                        Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr" target="_blank"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a> and <a href="http://innovation.gav.uop.gr" target="_blank">Χώρος Καινοτομίας του ΓΑΒ LAB</a><br/><br/>
                    </div>

                    <hr/>
                    <small>
                        tech support by <a href="http://osporos.com">O Sporos</a>
                    </small>
                </div>
            </div>
        </div>


    </div>

</div>

</body>
</html>
