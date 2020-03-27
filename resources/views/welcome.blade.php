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

    <title>Γριφομπότ</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap&subset=greek" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 80vh;
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
                <div class="col-sm-8">
                    <div class="title m-b-md">
                        Γριφο<span style="color: magenta;">μπότ</span> <span style="font-size: 11px;">έκδοση 1.1</span>
                    </div>
                    <div>
                        <p>
                            Παιχνίδι για μαθητές δημοτικού για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα
                        </p>
                    </div>

                    <h5>
                        Μέχρι σήμερα έχουν παιχτεί <b style="color:red;">{{ number_format($count, 0, ',','.') }}</b> παιχνίδια, έχουν απαντηθεί σωστά <b style="color: green">{{ number_format($answers, 0, ',','.') }}</b> ασκήσεις, έχουν γίνει <b style="color: blue;">{{ number_format($moves, 0, ',','.') }}</b> κινήσεις με συνολικό σκορ <b style="color: magenta">{{ number_format($total, 0, ',','.') }}</b>.
                    </h5>

                    <div>
                        <a href="{{route('user_home')}}" class="btn btn-lg btn-success">ΠΑΙΞΕ ΤΩΡΑ</a>
                    </div>
                    <div>
                        <br/>
                        <a href="{{route('about')}}">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}">Οδηγίες</a> | <a href="{{route('version')}}">Έκδοση 1.1</a>
                    </div>

                </div>
                <div class="col-sm-4">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                        <tr>
                            <td colspan="3">
                                <h3>
                                    Top10 <small class="text-muted">(24ωρών)</small>
                                </h3>
                            </td>
                        </tr>
                        </thead>
                        @foreach($stats as $stat)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>
                                    {{$stat->username}}
                                </td>
                                <td>
                                    {{number_format($stat->totalScore, 0, ',','.')}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row" style="padding-top:20px;">
                <div class="col-sm-12">
                    <div class="alert alert-danger" role="alert">
                        ΣΗΜΑΝΤΙΚΟ! Χρειαζόμαστε τις ιδέες σου. Πάτα <a href="{{ route('logo') }}">εδώ</a> για να δεις
                    </div>
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
