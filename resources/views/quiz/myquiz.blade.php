@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Λίστα Κουίζ</h1>
                <a href="{{ route('quiz_start') }}" class="btn btn-success">Δημιουργία Κουίζ</a>
                <small>Από τα "Στοιχεία" του κάθε ΚΟΥΙΖ βρίσκετε το σύνδεσμο που πρέπει να δώσετε στους μαθητές για να παίξουν</small>
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
                                {{ display_level($quiz->level) }}
                            </td>
                            <td>
                                <a href="{{ route('quiz_play_start', ['pin'=> $quiz->pin]) }}" class="btn btn-success">Παίξε</a>
                                <a href="{{ route('quiz_show', ['quiz'=> $quiz->id]) }}" class="btn btn-info">Στοιχεία</a>
                                <a href="{{ route('quiz_edit', ['quiz'=> $quiz->id]) }}" class="btn btn-warning">Επεξεργασία</a>
                                <a href="{{ route('quiz_questions', ['quiz'=> $quiz->id]) }}" class="btn btn-dark">Ερωτήσεις</a>
                                <a href="{{ route('quiz_teacher_results', ['quiz'=> $quiz->id]) }}" class="btn btn-secondary">Απαντήσεις</a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
