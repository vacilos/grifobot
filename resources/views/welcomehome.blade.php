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
            font-family: 'Open Sans', sans-serif;
            font-weight: 200;
            margin: 0;
            padding-bottom: 70px;
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
            /*padding-top:50px;*/
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

        .rowsheight600 {
            min-height: 600px;
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
                <div class="col-md-6 rowsheight600" style="background-image: url('{{asset('images/robotback.jpg')}}') !important; background-position:top left; background-repeat: repeat; border-right: 1px solid #333;">
                    <div class="title mt-5">
                        Γριφο<span style="color: firebrick;">μπότ</span> <span style="font-size: 11px;">1.4 Firebrick</span>
                    </div>
                    <p>
                        Παιχνίδι για μαθητές <b>ΔΗΜΟΤΙΚΟΥ ΚΑΙ ΝΗΠΙΑΓΩΓΕΙΟΥ</b> για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα
                    </p>
                    <div class="m-b-md">
                        <a href="{{route('user_home')}}" class="btn btn-lg btn-success"><i class="fa fa-gamepad"></i> ΠΑΙΞΕ ΤΩΡΑ</a>
                    </div>
                </div>
                <div class="col-md-6 rowsheight600" style="background-image: url('{{asset('images/quiztime.jpg')}}') !important; background-position:center; background-repeat: repeat;">
                    <div class="title mt-5">
                    Γριφο<span style="color:firebrick">μπότ</span> <span class="manouri manouri-xl manouri-color manouri-shadow">ΚΟΥΙΖ</span>
                    </div>
                    <p>
                        Η κλασσική έκδοση του Γριφομπότ τώρα και με ΚΟΥΙΖ! Θεματικά ΚΟΥΙΖ για κάθε τάξη και κάθε βαθμίδα. Επιτρέπει τη δημιουργία κουίζ από εκπαιδευτικούς για τις τάξεις τους!
                    </p>

                    <div class="m-b-md">
                        <a href="{{route('quiz_public')}}" class="btn btn-lg btn-danger"><i class="fa fa-trophy"></i> ΠΑΙΞΕ ΤΩΡΑ</a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">

                    <div>
                        <a href="{{route('about')}}">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}">Οδηγίες</a> | <a href="{{route('version')}}">Έκδοση 1.4 (firebrick)</a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">

                    <div>
                        <div class="fb-like m-b-md" data-href="https://facebook.com/grifobot" data-width="480" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
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
        </div>
    </div>
</div>

<div class="navbar fixed-bottom navbar-light bg-light">
    <div class="row">
        <div class="col-sm-12">
            <div style="font-size: 10px" class="text-left">
                Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/>

                <a href="{{route('about')}}" target="_blank">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}" target="_blank">Οδηγίες</a> | <a href="{{route('version')}}" target="_blank">Έκδοση 1.4 (firebrick)</a> | <a href="{{route('contact')}}" target="_blank">Επικοινωνία</a> | <a href="{{route('credits')}}">Credits</a>
                @yield('footer')
            </div>
        </div>
    </div>





    <div class="float-right" id="footer_msg" style="font-size: 5px;"></div>
</div>

{{--    @if (Route::has('login'))--}}
{{--        <div class="top-right links">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/user/home') }}">ΑΡΧΙΚΗ</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}">ΕΙΣΟΔΟΣ</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}">ΕΓΓΡΑΦΗ</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="content">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}

{{--                    <div>--}}
{{--                        <a href="{{route('about')}}">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}">Οδηγίες</a> | <a href="{{route('version')}}">Έκδοση 1.4 (firebrick)</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <p>--}}
{{--                            Παιχνίδι για μαθητές <b>ΔΗΜΟΤΙΚΟΥ ΚΑΙ ΝΗΠΙΑΓΩΓΕΙΟΥ</b> για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="m-b-md">--}}
{{--                        <a href="{{route('user_home')}}" class="btn btn-lg btn-success">ΠΑΙΞΕ ΤΩΡΑ</a>--}}
{{--                    </div>--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        Νέα έκδοση!!!<br/>--}}
{{--                        Γριφομπότ ΚΟΥΙΖ! Δείτε τι είναι πατώντας <a href="{{route('quiz')}}">ΕΔΩ</a><br/><br/>--}}
{{--                        Βρείτε στο ακόλουθο ελεύθερα ΚΟΥΙΖ <br/><a href="{{route('quiz_public')}}" class="btn btn-lg btn-danger">Γριφομπότ ΚΟΥΙΖ!</a>--}}
{{--                    </div>--}}

{{--                    <h5>--}}
{{--                        Μέχρι σήμερα έχουν παιχτεί <b style="color:red;">{{ number_format($count, 0, ',','.') }}</b> παιχνίδια, έχουν απαντηθεί σωστά <b style="color: green">{{ number_format($answers, 0, ',','.') }}</b> ασκήσεις, έχουν γίνει <b style="color: blue;">{{ number_format($moves, 0, ',','.') }}</b> κινήσεις με συνολικό σκορ <b style="color: magenta">{{ number_format($total, 0, ',','.') }}</b>.--}}
{{--                    </h5>--}}

{{--                    <div class="fb-like m-b-md" data-href="https://facebook.com/grifobot" data-width="480" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-3">--}}
{{--                    <table class="table table-striped table-bordered table-sm">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <td colspan="3">--}}
{{--                                <h3>--}}
{{--                                    Top 10 <small class="text-muted">(7 ημερών)</small>--}}
{{--                                </h3>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        @foreach($stats7 as $stat)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    {{$loop->index+1}}--}}
{{--                                </td>--}}
{{--                                <td class="text-left">--}}
{{--                                    <img src="{{asset('images')}}/{{$stat->avatar}}" class="img-fluid" style="max-width:20px;"/>&nbsp; {{$stat->username}}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{number_format($stat->totalScore, 0, ',','.')}}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="col-sm-3">--}}
{{--                    <table class="table table-striped table-bordered table-sm">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <td colspan="3">--}}
{{--                                <h3>--}}
{{--                                    Hall of Fame--}}
{{--                                </h3>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        @foreach($hof as $stat)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    {{$loop->index+1}}--}}
{{--                                </td>--}}
{{--                                <td class="text-left">--}}
{{--                                    <img src="{{asset('images')}}/{{$stat->avatar}}" class="img-fluid" style="max-width:20px;"/>&nbsp; {{$stat->username}}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{number_format($stat->totalScore, 0, ',','.')}}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <table class="table table-striped table-bordered table-sm">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <td colspan="4">--}}
{{--                                <h3>--}}
{{--                                    Top 10 Δήμοι--}}
{{--                                </h3>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        @foreach($municipalStats as $stat)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    {{$loop->index+1}}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    Δήμος {{ $stat->dimos }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{$stat->totalUsers}} μαθητές--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{number_format($stat->totalScore, 0, ',','.')}} πόντοι--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="row" style="padding-top:20px;">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="alert alert-danger" role="alert">--}}
{{--                        ΣΗΜΑΝΤΙΚΟ! Χρειαζόμαστε τις ιδέες σου. Πάτα <a href="{{ route('logo') }}" class="btn btn-info btn-sm">εδώ</a> για να δεις<br/>--}}
{{--                        ή δες <a href="{{ route('students') }}" class="btn btn-info btn-sm">εδώ</a> τις ιδέες των παιδιών για το Γριφομπότ--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div style="font-size:18px;">--}}
{{--                        <br/><br/>--}}
{{--                        Application designed with <i class="fa fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/><br/>--}}
{{--                    </div>--}}

{{--                    <hr/>--}}
{{--                    <small>--}}
{{--                        additional graphics designed by <a href="https://www.facebook.com/aggelakosPnM/" target="_blank">Yannis Aggelakos</a><br/>--}}
{{--                        images for animal avatars by freepik (<a href="http://www.freepik.com" target="_blank">Designed by Freepik</a>)<br/>--}}
{{--                        tech support by <a href="http://osporos.com">O Sporos</a>--}}
{{--                    </small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--    </div>--}}

{{--</div>--}}

</body>
</html>
