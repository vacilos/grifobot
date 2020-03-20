@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header"><h3>{{ Auth::user()->name }} <a href="{{ route("user_change_profile") }}" class="btn btn-sm btn-info">Αλλαγή προφίλ</a></h3> </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col text-center">
                            <a href="{{ route('start_plan', ['size'=> 6, 'level' => Auth::user()->level]) }}" class="btn btn-success btn-lg btn-block">ΠΑΙΞΕ ΤΩΡΑ</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Στατιστικά</div>

                <div class="card-body">
                    <div>
                        <h3>5 πιο πρόσφατα δικά σου</h3>
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
                                @foreach($scores as $score)
                                    <tr>
                                        <td>
                                            {{$score->plan->id}}

                                        </td>
                                        <td>
                                            {{ number_format($score->score) }} <br/>
                                            <small>{{ $score->movements }} κινήσεις</small>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($score->updated_at)->format('d.m.Y H:i')}}
                                        </td>
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

    </div>
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
@endsection
