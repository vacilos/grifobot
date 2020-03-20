@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Κατηγορίες</h1>
                <a href="{{ route('categories.create') }}" class="btn btn-success">Δημιουργία Κατηγορίας</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Κατηγορία
                            </th>
                            <th>
                                Ενέργειες
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit', ['category' => $category->id])}}">Play</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
