@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $quiz->name }}</h3>
                <small>{{$quiz->description}}</small><br/>
                <b class="text-danger">Κάντε αντιγραφή το σύνδεσμο και στείλτε τον στους μαθητές για να παίξουν</b>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>
                            Επίπεδο
                        </th>
                        <td>
                            {{ display_level($quiz->level) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Μέγεθος
                        </th>
                        <td>
                            {{ $quiz->size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Ασκήσεις
                        </th>
                        <td>
                            {{ $quiz->exercise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Σύνδεσμος

                        </th>
                        <td>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="http://grifobot.gr/quiz/start?pin={{ $quiz->pin }}" id="link">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-success" onclick="copyText();"><i class="fa fa-copy"></i> Αντιγραφή</button>
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            PIN
                        </th>
                        <td>
                            {{$quiz->pin}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Δημόσιο
                        </th>
                        <td>
                            @if($quiz->public == 1)ΝΑΙ @else ΌΧΙ @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Ελεύθερο μέχρι
                        </th>
                        <td>
                            @if($quiz->end_date == null) χωρίς λήξη @else{{ date('d-m-Y H:i', strtotime($quiz->end_date))}} @endif

                        </td>
                    </tr>
                </table>
                <a href="{{ route('quiz_my') }}" class="btn btn-info">Αρχική</a>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script type="text/javascript">
        function copyText() {
            var copyText = document.getElementById("link");
            copyText.select();
            document.execCommand("copy");
            alert('Αντιγράφηκε ο σύνδεσμος: '+copyText.value);
        }
    </script>
@endsection
