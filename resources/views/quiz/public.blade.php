@extends('layouts.app_quiz')

@section('stylesheet')
    <style>
        .manouri-16 {
            font-size: 18px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="manouri">Ελεύθερα ΚΟΥΙΖ</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{route('welcome')}}" class="btn btn-info btn-lg manouri"><i class="fa fa-home"></i> Αρχική</a><a href="{{route('quiz_play_start')}}" class="btn btn-lg btn-warning manouri"><i class="fa fa-code"></i> Έχω PIN</a>
                        <table class="table table-bordered table-striped manouri manouri-16 table-responsive-sm">
                            <thead>
                            <tr>
                                <td>Όνομα</td>
                                <td>Επίπεδο</td>
                                <td>Ημερομηνία λήξης</td>
                                <td>Ενέργειες</td>
                            </tr>
                            </thead>
                        @foreach($quizzes as $quiz)
                            <tr>
                                <td class="manouri">
                                    {{ $quiz->name }}
                                </td>
                                <td  class="manouri">
                                    {{ display_level($quiz->level) }}
                                </td>
                                <td>
                                    @if($quiz->end_date == null) χωρίς λήξη @else{{ date('d-m-Y H:i', strtotime($quiz->end_date))}} @endif
                                </td>
                                <td class="manouri">
                                    <a href="{{route('quiz_play_start', ['pin'=>$quiz->pin])}}" class="btn btn-info manouri"><i class="fa fa-play"></i> Παίξε</a>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
