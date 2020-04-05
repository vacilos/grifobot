@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ $tournament->name }}</h3> </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col text-center">
                                Ολοκλήρωσες το τουρνουά με <span style="font-size: 22px">{{ $totalMoves }}</span> κινήσεις και πήρες <span style="font-size: 22px">{{ $totalScore }}</span> πόντους και ο χρόνος σου ήταν {{ $totalSeconds }}.
                                <hr/>
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                Παιχνίδι
                                            </th>
                                            <th>
                                                Πόντοι
                                            </th>
                                            <th>
                                                Κινήσεις
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach($scores as $score)
                                        <tr>
                                            <td>
                                                {{$score->game}}
                                            </td>
                                            <td>
                                                {{$score->score}}
                                            </td>
                                            <td>
                                                {{$score->movements}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>
                                            Σύνολο
                                        </th>
                                        <th>
                                            <b>{{ $totalScore }}</b>
                                        </th>
                                        <th>
                                            <b>{{ $totalMoves }}</b>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <a href="{{ route('results_tournament', ['tournament'=>$tournament->id]) }}">Αποτελέσματα Τουρνουά</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
