@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Ολοκληρωμένα Τουρνουά</h4></div>
                    <div id="messagespace"></div>
                    <div class="card-body">
                        <button class="btn btn-info btn-sm" onclick="javascript:history.go(-1);"><i class="fa fa-chevron-left"></i> Πίσω</button>

                        <table class="table table-bordered table-striped table-responsive-sm">
                            <thead>
                            <tr>
                                <th>
                                    Τουρνουά
                                </th>
                                <th>
                                    Ημερομηνία
                                </th>
                                <th>
                                    Ενέργεια
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tournaments as $tournament)
                                <tr>
                                    <td>
                                        {{$tournament->name}}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($tournament->start_date)->format('d / m / Y')}}<br/>
                                        {{ $tournament->start_time }} - {{ $tournament->end_time }}
                                    </td>
                                    <td>
                                        <a href="{{ route('results_tournament', ['tournament'=>$tournament->id]) }}" class="btn btn-sm btn-info">Αποτελέσματα Τουρνουά</a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
