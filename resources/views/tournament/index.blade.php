@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Τουρνουά</h1>
                <a href="{{ route('tournaments.create') }}" class="btn btn-success">Δημιουργία Τουρνουά</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Ονομασία
                            </th>
                            <th>
                                Επίπεδο
                            </th>
                            <th>
                                Ενέργειες
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tournaments as $tournament)
                        <tr>
                            <td>
                                {{$tournament->name}} / {{$tournament->start_date}}<br/>
                            </td>
                            <td>
                                {{ display_level($tournament->level) }}
                            </td>
                            <td>
                                <a href="{{route('tournaments.edit', ['tournament' => $tournament->id])}}" class="btn btn-sm btn-info">Επεξεργασία</a>
                                <a href="{{route('begin_tournament', ['tournament' => $tournament->id])}}" class="btn btn-sm btn-info">Έναρξη</a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                {{ $tournaments->links() }}
            </div>
        </div>
    </div>

@endsection
