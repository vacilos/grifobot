@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $quiz->name }} - Ερωτήσεις</h3>
                <small>{{$quiz->description}}</small>
                <a href="{{ route('quiz_my') }}" class="btn btn-info">Αρχική</a>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>
                            Ερώτηση
                        </th>
                        <th>
                            Ενέργειες
                        </th>
                    </tr>
                    <tbody>
                    @foreach($quiz->maths as $math)
                        <tr>
                            <td>
                                {{$math->question}}
                            </td>
                            <td>
                                <a href="{{route('quiz_edit_math', ['math' => $math->id, 'quiz' => $quiz->id])}}" class="btn btn-warning">Επεξεργασία</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
