@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Παιχνίδια</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                Παιχνίδι
                            </th>
                            <th>
                                Σκορ
                            </th>
                            <th>
                                Ώρα
                            </th>
                            <th>
                                Ενέργεια
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td>
                                    {{$game->plan_id}}
                                </td>
                                <td>
                                    {{ number_format($game->score) }} <br/>
                                    <small>{{ $game->movements }} κινήσεις</small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($game->updated_at)->format('d.m.Y H:i')}}
                                </td>
                                <td>
                                    <a href="{{ route("play_plan", ['plan'=> $game->plan_id]) }}" class="btn btn-sm btn-info">Παίξε πάλι</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $games->links() }}
                </div>
            </div>
        </div>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
