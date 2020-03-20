@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Λίστα Ασκήσεων επιπέδου {{ $levelString }}</h1>
                <a href="{{ route('maths.create') }}" class="btn btn-success">Δημιουργία Άσκησης</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Άσκηση / Απάντηση
                            </th>
                            <th>
                                Ενέργειες
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($maths as $math)
                        <tr>
                            <td>
                                {{$math->question}} => {{$math->answer}}
                            </td>
                            <td>
                                <a href="{{route('maths.edit', ['math' => $math->id])}}" class="btn btn-sm btn-info">Επεξεργασία</a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
                {{ $maths->links() }}
            </div>
        </div>
    </div>

@endsection
