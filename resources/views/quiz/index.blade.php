@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Λίστα ΚΟΥΙΖ</h1>
                <a href="{{ route('quiz.create') }}" class="btn btn-success">Δημιουργία Κουιζ</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                Κουίζ
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
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>
                                {{$quiz->name}}
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
