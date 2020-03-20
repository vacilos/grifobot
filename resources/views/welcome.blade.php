<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
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
                height: 100vh;
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
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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
        <script src="https://kit.fontawesome.com/98c292b2c4.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/user/home') }}">Αρχική</a>
                    @else
                        <a href="{{ route('login') }}">Είσοδος</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Εγγραφή</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Γριφομπότ
                </div>

                <div>
                    <p>
                        Παιχνίδι για μαθητές δημοτικού για να κάνουν ασκήσεις γλώσσας και μαθηματικών συνδυαστικά με στοιχεία εκμάθησης κώδικα
                    </p>
                </div>
                <div>
                    <a href="{{route('user_home')}}" class="btn btn-lg btn-success">ΠΑΙΞΕ ΤΩΡΑ</a>
                </div>
                <div>
                    <br/>
                    <a href="{{route('about')}}">Τι είναι το ΓΡΙΦΟΜΠΟΤ</a> | <a href="{{route('help')}}">Οδηγίες</a>
                </div>
                <div style="font-size:18px;">
                    <br/><br/>
                    Application designed with <i class="fas fa-heart" style="color: red;"></i> by <a href="http://gav.uop.gr"><img src="{{ asset('images/gav.png') }}" style="max-width:20px;">ΓΑΒ LAB</a><br/><br/>
                </div>

                <hr/>
                <small>
                    Images for human avatars created by Yannis Aggelakos<br/>
                    Images for animal avatars by freepik (<a href="http://www.freepik.com" target="_blank">Designed by Freepik</a>)
                </small>
            </div>
        </div>
    </body>
</html>
