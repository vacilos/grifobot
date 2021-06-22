@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Πόλεις</h1>
                <a href="{{ route('towns.create') }}" class="btn btn-success">Δημιουργία Πόλης</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Πόλη
                            </th>
                            <th>
                                Ενέργειες
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($towns as $town)
                        <tr>
                            <td>
                                {{$town->title}}
                            </td>
                            <td>
                                <a href="{{route('towns.edit', ['town' => $town->id])}}">Επεξεργασία</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
