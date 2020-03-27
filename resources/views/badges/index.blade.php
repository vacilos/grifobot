@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Badges</h1>
                <a href="{{ route('badges.create') }}" class="btn btn-success">Δημιουργία badge</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Badge
                            </th>
                            <th>
                                Ενέργειες
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($badges as $badge)
                        <tr>
                            <td>
                                {{$badge->name}}
                            </td>
                            <td>
                                <a href="{{route('badges.edit', ['badge' => $badge->id])}}">edit</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
