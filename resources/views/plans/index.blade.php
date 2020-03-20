@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Λίστα Πλάνων</h1>
                <a href="{{ route('plans.create') }}" class="btn btn-success">Δημιουργία Πλάνου</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Άσκηση
                            </th>
                            <th>
                                Ενέργειες
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>
                                {{$plan->id}}
                            </td>
                            <td>
                                <a href="{{route('play_plan', ['plan' => $plan->id])}}">Play</a>
                            </td>
                        </tr>
                    @endforeach
                    {{ $plans->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
