@extends('layouts.app_1821')


@section('town')
    {{ $town->title }}
@endsection

@section('userdata')
    {{ Session::get('grif1821_user')}}: <strong>{{ number_format($userstat->totalScore, 0, ",", ".") }}</strong>
@endsection

@section('menu')
    <a href="{{ route('plan_invalidate', ['town' => $town->id]) }}">Log Out</a>
    <a href="{{ route('welcome_town', ['town' => $town->slug]) }}"><i class="fa fa-book"></i> Ιστορία</a>
@endsection

@section('stylesheet')

    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .split .onet {
            width: 33%;
            text-align: center;
        }
        .split .twot {
            width: 33%;
            text-align: center;
        }
        .split .threet {
            width: 33%;
            text-align: center;
            border-left: solid 2px;
            border-left-color: rgba(144, 144, 144, 0.25);
        }

        .vs-team {
            text-align: center;
            padding-top: 80px;
            padding-bottom: 80px;
            -webkit-clip-path: polygon(10% 0%, 90% 0%, 100% 8%, 100% 92%, 90% 100%, 10% 100%, 0% 92%, 0% 8%);
            clip-path: polygon(10% 0%, 90% 0%, 100% 8%, 100% 92%, 90% 100%, 10% 100%, 0% 92%, 0% 8%);
            position: relative;
            margin-bottom: 30px;
        }

        .bg-fluid {
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center center;
        }

        .mb-35 {
            margin-bottom: 35px;
        }

        .manouri {
            font-family: 'Manoyri';
            font-size: 70px;
        }

        .rotate {
            display: inline-block;
            transform: rotate(-15deg);
            /* Legacy vendor prefixes that you probably don't need... */

            /* Safari */
            -webkit-transform: rotate(-15deg);

            /* Firefox */
            -moz-transform: rotate(-15deg);

            /* IE */
            -ms-transform: rotate(-15deg);

            /* Opera */
            -o-transform: rotate(-15deg);
            color: #761b18;
            text-shadow: 2px 2px 5px red;

        }
    </style>
@endsection

@section('pagetitle')
    <img src="{{ asset("pubimg/pubimg") }}/{{ $town->logo }}" class="img-fluid"/> {{ $town->title }} - Γριφομπότ 1821
@endsection

@section('banner')
    <section id="banner-small">
        <div class="inner">
            <section>
                <h2 style="text-align: center;"><img src="{{ asset("pubimg/pubimg") }}/{{ $town->logo }}"  style="vertical-align:middle"/> Επανάσταση 1821 - 2021 | {{ $town->title }}</h2><br/>
            </section>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="vs-team bg-fluid">
                <div class="team-img mb-35">
                    <a href="{{ route('plan_town_start', ['level'=> 1, 'town' => $town]) }}">
                        <img src="{{asset('images/easy.png')}}" class="img-fluid" />
                    </a>
                    <br/>
                    Εύκολο
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="vs-team bg-fluid">
                    <div class="team-img mb-35">
                        <a href="{{ route('plan_town_start', ['level'=> 2, 'town' => $town]) }}">
                            <img src="{{asset('images/medium.png')}}" class="img-fluid" />
                        </a>
                        <br/>
                        Μέτριο
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="vs-team bg-fluid">
                    <div class="team-img mb-35">
                        <a href="{{ route('plan_town_start', ['level'=> 3, 'town' => $town]) }}">
                            <img src="{{asset('images/hard.png')}}" class="img-fluid" />
                        </a>
                        <br/>
                        Δύσκολο
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h4>Top 10</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                    <tr>
                        <td colspan="2" class="text-center">
                            <h6><i class="fas fa-child"></i></h6>
                        </td>
                    </tr>
                    </thead>
                    @foreach($stats as $stat)
                        <tr>
                            <td>
                                {{ $loop->iteration }}. {{$stat->username}}
                            </td>
                            <td>
                                {{number_format($stat->totalScore, 0, ",", ".")}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-sm-4">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                    <tr>
                        <td colspan="2" class="text-center">
                            <h6><i class="fas fa-book-reader"></i></h6>
                        </td>
                    </tr>
                    </thead>
                    @foreach($statsΜ as $stat)
                        <tr>
                            <td>
                                {{ $loop->iteration }}. {{$stat->username}}
                            </td>
                            <td>
                                {{ number_format($stat->totalScore, 0, ",", ".")}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-sm-4">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                    <tr>
                        <td colspan="2" class="text-center">
                            <h6><i class="fas fa-user-ninja"></i></h6>
                        </td>
                    </tr>
                    </thead>
                    @foreach($statsH as $stat)
                        <tr>
                            <td>
                                {{ $loop->iteration }}. {{$stat->username}}
                            </td>
                            <td>
                                {{number_format($stat->totalScore, 0, ",", ".")}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection


@section('javascript')
    <script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
@endsection
