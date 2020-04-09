@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ $tournament->name }}</h3> </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col text-left">
                                <button class="btn btn-info btn-sm" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Πίσω</button>
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                Θέση
                                            </th>
                                            <th>
                                                Παίκτης
                                            </th>
                                            <th>
                                                Πόντοι (Κινήσεις/Χρόνος)
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach($stats as $stat)
                                        <tr @if(Auth::user()->name == $stat->name)class="table-success"@endif>
                                            <td>
                                                {{$loop->index+1}}
                                            </td>
                                            <td>
                                                {{$stat->name}}
                                            </td>
                                            <td>
                                                {{$stat->totalScore}}<br/>
                                                <small>{{$stat->totalMoves}}κινήσεις / {{$stat->timedifference}}δευτερόλεπτα</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
