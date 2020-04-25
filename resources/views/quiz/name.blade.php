@extends('layouts.app_quiz')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $quiz->name }}</h2>
                    </div>
                    <div class="card-body">
                        <p>{{ $quiz->description }} (<small>{{ display_level($quiz->level) }}</small>)</p>

                        <form method="post" action="{{ route('quiz_play') }}" id="userForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-xl manouri manouri-xl" name="username" id=username" aria-describedby="pinHelp" placeholder="Δώσε ένα ψευδώνυμο">
                                <small id="pinHelp" class="form-text text-muted">Γράψε το ψευδώνυμο που θέλεις να έχεις για το KOYIZ!</small>
                                <input type="hidden" name="quiz" id="quiz" value="{{ $quiz->id }}" />
                            </div>
                            <button type="submit" class="btn btn-success btn-lg manouri btn-block manouri-lg">Φύγαμε!</button>
                            <br/><br/><a href="{{ route('quiz_results', ['pin'=>$quiz->pin]) }}" class="text-center">Αποτελέσματα</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $("#userForm").on("submit", function(){
                var username = $("#username").val();
                if(username == "") {
                    alert('Πρέπει να συμπληρώσεις ένα ψευδώνυμο!');
                    return false;
                }
                return true;
            })
        });
    </script>
@endsection
