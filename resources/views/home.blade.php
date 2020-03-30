@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding-top:20px;">
        <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
                ΣΗΜΑΝΤΙΚΟ! Χρειαζόμαστε τις ιδέες σου. Πάτα <a href="{{ route('logo') }}">εδώ</a> για να δεις
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>{{ Auth::user()->name }} <a href="{{ route("user_change_profile") }}" class="btn btn-sm btn-info">Αλλαγή προφίλ</a></h3> </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            @if(Auth::user()->level == 7)
                                <a href="{{ route('start_plan_kinder', ['size'=> 4, 'level' => Auth::user()->level, 'diff' => 1]) }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ απλό</a>
                                <a href="{{ route('start_plan_kinder', ['size'=> 4, 'level' => Auth::user()->level, 'diff' => 2]) }}" class="btn btn-warning btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ μέτριο</a>
                                <a href="{{ route('start_plan_kinder', ['size'=> 4, 'level' => Auth::user()->level, 'diff' => 3]) }}" class="btn btn-danger btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ δύσκολο</a>
                            @else
                                <a href="{{ route('start_plan', ['size'=> 6, 'level' => Auth::user()->level]) }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-play-circle"></i> ΠΑΙΞΕ ΤΩΡΑ</a>
                            @endif
                            <hr/>
                            Έχεις παίξει <b>{{$count}}</b> παιχνίδια και έχεις συγκεντρώσει <b>{{$total}}</b> πόντους
                            <hr/>
                            <br/>
                            <img src="{{asset('images')}}/{{ Auth::user()->avatar }}" class="img-fluid" />
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            {{ Auth::user()->showSMG() }}
                            <Br/>
                            @if (Auth::user()->municipality)
                                {{ Auth::user()->municipality }}
                            @endif
                            <br/>
                            <a href="{{ route('user_badges') }}" class="btn btn-warning"><i class="fa fa-certificate"></i> Τα μετάλλιά μου</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>5 πιο πρόσφατα δικά σου</h3></div>
                <div class="card-body">
                    <div>
                        <h3></h3>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                   <th>
                                       Παιχνίδι
                                   </th>
                                    <th>
                                        Σκορ
                                    </th>
                                    <th>
                                        Ενέργεια
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
                                        <td>
                                            <a href="{{ route("play_plan", ['plan'=> $score->plan->id]) }}" class="btn btn-info btn-sm">Παίξε πάλι</a>
                                        </td>
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
                <div class="card-header"><h3>Top5 / 24h</h3></div>

                <div class="card-body">
                    <div>
                        <table class="table table-bordered table-striped table-sm">
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
                                        {{$stat->username}}
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
            <hr/>
            <div class="card">
                <div class="card-header"><h3>Top5 / 7d</h3></div>

                <div class="card-body">
                    <div>
                        <table class="table table-bordered table-striped table-sm">
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
                                        {{$stat->username}}
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
    <hr/>
    <div class="row">
        <div class="col-sm-12 text-center">
            <h3>Στο ίδιο επίπεδο</h3>
        </div>
    </div>
    <div class="row">
        @foreach($otherscores as $score)
            <div class="col">
                <div class="card">
                    <div class="card-header"><h5>{{$score->user->name}}</h5></div>
                    <div class="card-body">
                        Παιχνίδι: {{ $score->plan_id }} | Σκορ: {{number_format($score->score)}} | Κινήσεις: {{$score->movements}}<br/>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('play_plan', ['plan' => $score->plan_id]) }}" class="btn btn-sm btn-block btn-info">Παίξε κι εσύ!</a>
                    </div>
                </div>
            </div>
        @endforeach
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            @if($hasBadge == true)
            $('#instructionsModal').modal('show');
            @endif

        });


        </script>
@endsection
