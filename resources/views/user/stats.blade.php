@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><h3>Top</h3></div>
                <div class="card-body">
                    <div class="row text-center">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th colspan="3">24 ωρών στην {{ Auth::user()->showSMG() }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stats as $stat)
                                <tr @if(Auth::user()->name == $stat->username)class="table-success"@elseif($loop->index==0)class="table-danger"@elseif($loop->index==1)class="table-warning"@endif>
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
                        <a href="{{ route('user_stats_all_time') }}" class="btn btn-sm btn-info">Hall of Fame</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
