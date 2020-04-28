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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=greek" rel="stylesheet">
    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
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
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/user/home') }}">ΑΡΧΙΚΗ</a>
            @else
                <a href="{{ route('login') }}">ΕΙΣΟΔΟΣ</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">ΕΓΓΡΑΦΗ</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        Γριφο<span style="color: firebrick;">μπότ</span> <span style="font-size: 11px;">έκδοση 1.4</span>
                    </div>
                    <div>
                        <a href="{{route('about')}}">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}">Οδηγίες</a> | <a href="{{route('version')}}">Έκδοση 1.4 (firebrick)</a>
                    </div>
                    <div>
                        <p>
                            Παιχνίδι για μαθητές <b>ΔΗΜΟΤΙΚΟΥ ΚΑΙ ΝΗΠΙΑΓΩΓΕΙΟΥ</b> για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα
                        </p>
                    </div>
                    <div class="m-b-md">
                        <a href="{{route('user_home')}}" class="btn btn-lg btn-success">ΠΑΙΞΕ ΤΩΡΑ</a>
                    </div>
                    <div class="alert alert-danger">
                        Νέα έκδοση!!!<br/>
                        Γριφομπότ ΚΟΥΙΖ! Δείτε τι είναι πατώντας <a href="{{route('quiz')}}">ΕΔΩ</a><br/><br/>
                        Βρείτε στο ακόλουθο ελεύθερα ΚΟΥΙΖ <br/><a href="{{route('quiz_public')}}" class="btn btn-lg btn-danger">Γριφομπότ ΚΟΥΙΖ!</a>
                    </div>


                    <div class="fb-like m-b-md" data-href="https://facebook.com/grifobot" data-width="480" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                        <tr>
                            <td colspan="3">
                                <h3>
                                    Top 10 <small class="text-muted">(7 ημερών)</small>
                                </h3>
                            </td>
                        </tr>
                        </thead>
                        @foreach($stats7 as $stat)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td class="text-left">
                                    <img src="{{asset('images')}}/{{$stat->avatar}}" class="img-fluid" style="max-width:20px;"/>&nbsp; {{$stat->username}}
                                </td>
                                <td>
                                    {{number_format($stat->totalScore, 0, ',','.')}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-sm-3">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                        <tr>
                            <td colspan="3">
                                <h3>
                                    Hall of Fame
                                </h3>
                            </td>
                        </tr>
                        </thead>
                        @foreach($hof as $stat)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td class="text-left">
                                    <img src="{{asset('images')}}/{{$stat->avatar}}" class="img-fluid" style="max-width:20px;"/>&nbsp; {{$stat->username}}
                                </td>
                                <td>
                                    {{number_format($stat->totalScore, 0, ',','.')}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                        <tr>
                            <td colspan="4">
                                <h3>
                                    Top 10 Δήμοι
                                </h3>
                            </td>
                        </tr>
                        </thead>
                        @foreach($municipalStats as $stat)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>
                                    Δήμος {{ $stat->dimos }}
                                </td>
                                <td>
                                    {{$stat->totalUsers}} μαθητές
                                </td>
                                <td>
                                    {{number_format($stat->totalScore, 0, ',','.')}} πόντοι
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div style="font-size:18px;">
                        <br/><br/>
                        Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/><br/>
                    </div>

                    <hr/>
                    <small>
                        additional graphics designed by <a href="https://www.facebook.com/aggelakosPnM/" target="_blank">Yannis Aggelakos</a><br/>
                        images for animal avatars by freepik (<a href="http://www.freepik.com" target="_blank">Designed by Freepik</a>)<br/>
                        tech support by <a href="http://osporos.com">O Sporos</a>
                    </small>
                </div>
            </div>
        </div>


    </div>

</div>

</body>
</html>
