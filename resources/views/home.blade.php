@extends('layouts.app')

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/el_GR/sdk.js#xfbml=1&autoLogAppEvents=1&version=v6.0&appId=713822995484844"></script>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
        @if(sizeof($challenges) > 0)
            <div class="alert alert-danger alert-dismissible fade show">  <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Έχεις Challenge!</h4>
            <p>
                Κάποιος χρήστης σου έχει κάνει challenge να παίξεις μία πίστα. Λεπτομέρειες: <a href="{{ route('user_challenges') }}" class="btn btn-info">εδώ</a>
            </p>
            </div>
        @endif
            <div class="alert alert-danger alert-dismissible fade show">  <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Γριφομπότ ΚΟΥΙΖ!</h4>
                <p>
                    Ήρθαν τα Γριφομπότ ΚΟΥΙΖ. Δοκίμασε κι εσύ!
                    <br/>
                    <a href="{{route('quiz_public')}}" class="btn btn-lg btn-danger">Γριφομπότ ΚΟΥΙΖ!</a>
                </p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>Ελεύθερο Παιχνίδι</h3> </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col text-center">

                            @if(Auth::user()->level == 7)
                                <a href="{{ route('start_plan_kinder', ['size'=> 4, 'level' => Auth::user()->level, 'diff' => 1]) }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ απλό</a>
                                <a href="{{ route('start_plan_kinder', ['size'=> 4, 'level' => Auth::user()->level, 'diff' => 2]) }}" class="btn btn-warning btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ μέτριο</a>
                                <a href="{{ route('start_plan_kinder', ['size'=> 4, 'level' => Auth::user()->level, 'diff' => 3]) }}" class="btn btn-danger btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ δύσκολο</a>
                            @elseif(Auth::user()->level > 7)
                                Δεν υπάρχουν ακόμα ελεύθερα ταμπλό για τάξεις Γυμνασίου και Λυκείου. Μπορείτε να δείτε τα ΚΟΥΙΖ για να δείτε αν υπάρχει κάποιο ελεύθερο διαθέσιμο!
                            @else
                                <a href="{{ route('start_plan_ex', ['size'=> 6, 'level' => Auth::user()->level]) }}" class="btn btn-success btn-lg btn-block"><br/><i class="fa fa-play-circle"></i> ΠΑΙΞΕ ΤΩΡΑ<Br/><br/></a>
                                <small>Παίξε στο ελεύθερο παιχνίδι μία πίστα και στη συνέχεια προσκάλεσε φίλους σου να δεις αν μπορούν να φτάσουν στο σκορ σου!</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>Τουρνουά</h3> </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            @if($activeTournament != null)
                                @if(date('Y-m-d') == $activeTournament->start_date && date('H:i') < $activeTournament->end_time && date('H:i') >= $activeTournament->start_time)
                                    <a href="{{ route('start_tournament', ['tournament'=> $activeTournament]) }}" class="btn btn-danger btn-lg btn-block"><br/><i class="fa fa-play-circle"></i> ΕΚΚΙΝΗΣΗ ΤΟΥΡΝΟΥΑ<Br/><br/></a>
                                @elseif( (date('Y-m-d') == $activeTournament->start_date && date('H:i') < $activeTournament->start_time) || date('Y-m-d') < $activeTournament->start_date )
                                    Το επόμενο τουρνουά για το επίπεδο <b>{{ Auth::user()->showSMG() }}</b> είναι στις <br/>
                                    <h2 style="color: red;">{{ \Carbon\Carbon::parse($activeTournament->start_date)->format('d / m / Y')}}<br/>
                                    {{ $activeTournament->start_time }} - {{ $activeTournament->end_time }}</h2>
                                    <small>θα εμφανιστεί σε αυτό το σημείο κουμπί συμμετοχής την ώρα έναρξης του τουρνουά</small>
                                @else
                                    Δεν έχει οριστεί κάποιο τουρνουά

                                @endif
                            @else
                                Δεν έχει οριστεί κάποιο τουρνουά
                            @endif
                            <br/><br/>
                            <a href="{{ route('list_tournament') }}" class="btn btn-sm btn-info">Ολοκληρωμένα Τουρνουά</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3><img src="{{asset('images')}}/{{ Auth::user()->avatar }}" class="img-fluid" style="max-width:50px;" /> {{ Auth::user()->name }} <a href="{{ route("user_change_profile") }}" class="btn btn-sm btn-info">Αλλαγή προφίλ</a></h3> </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            Έχεις παίξει <b>{{$count}}</b> παιχνίδια<br/>
                            Έχεις κερδίσει <b>{{$total}}</b> πόντους <br/>
                            Έχεις κάνει <b>{{$moves}}</b> κινήσεις<br/>
                            <hr/>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            {{ Auth::user()->showSMG() }}
                            <Br/>
                            @if (Auth::user()->municipality)
                                {{ Auth::user()->municipality }}
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            <a href="{{ route('user_badges') }}" class="btn btn-warning"><i class="fa fa-certificate"></i> Μετάλλια</a>
                            <a href="{{ route('user_challenges') }}" class="btn btn-danger"><i class="fa fa-users"></i> Challenges</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>10 πρόσφατα</h3></div>
                <div class="card-body">
                    <div>
                        <h3></h3>
                        <table class="table table-bordered table-striped table-sm table-responsive-sm">
                            <thead>
                                <tr>
                                   <th>
                                       Παιχνίδι
                                   </th>
                                    <th>
                                        Σκορ
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scores as $score)
                                    <tr>
                                        <td>
                                            {{$score->plan->id}}

                                        </td>
                                        <td>
                                            {{ number_format($score->score) }} <br/>
                                            <small>{{ $score->movements }} κινήσεις</small>
                                        </td>
{{--                                        <td>--}}
{{--                                            {{ \Carbon\Carbon::parse($score->updated_at)->format('d.m.Y H:i')}}--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('user_games') }}" class="btn btn-sm btn-info">Όλα τα παιχνίδια μου</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>Top 10 / 24h</h3></div>

                <div class="card-body">
                    <div>
                        <table class="table table-bordered table-striped table-sm table-responsive-sm">
                            <thead>
                            <tr>
                                <th colspan="3">24 ωρών στο επίπεδο {{ Auth::user()->showSMG() }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stats as $stat)
                                <tr @if(Auth::user()->name == $stat->username)class="table-success"@endif>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        <img src="{{asset('images')}}/{{$stat->avatar}}" class="img-fluid" style="max-width:30px;"/>&nbsp; {{$stat->username}}
                                    </td>
                                    <td>
                                        {{number_format($stat->totalScore, 0, ',','.')}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('user_stats') }}" class="btn btn-sm btn-info">Όλη η κατάταξη</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>Top 10 / 7d</h3></div>

                <div class="card-body">
                    <div>
                        <table class="table table-bordered table-striped table-sm table-responsive-sm">
                            <thead>
                            <tr>
                                <th colspan="3">7 ημερών στο επίπεδο {{ Auth::user()->showSMG() }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stats7 as $stat)
                                <tr @if(Auth::user()->name == $stat->username)class="table-success"@endif>
                                    <td>
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        <img src="{{asset('images')}}/{{$stat->avatar}}" class="img-fluid" style="max-width:30px;"/>&nbsp; {{$stat->username}}
                                    </td>
                                    <td>
                                        {{number_format($stat->totalScore, 0, ',','.')}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('user_stats') }}" class="btn btn-sm btn-info">Όλη η κατάταξη</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <br/><br/>
                <div class="fb-like m-b-md" data-href="https://facebook.com/grifobot" data-width="480" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
            </div>
        </div>

</div>


<div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ΣΥΓΧΑΡΗΤΗΡΙΑ!</h5>
            </div>
            <div class="modal-body">
                <p>
                    Κέρδισες ένα καινούριο μετάλλιο!
                </p>
                <p>
                    <a href="{{ route('user_badges') }}" class="btn btn-info">Δες τα μετάλλιά σου</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

    <script type="text/javascript">
        $(document).ready(function() {
            @if($hasBadge == true)
            $('#instructionsModal').modal('show');
            @endif

        });


        </script>
@endsection
