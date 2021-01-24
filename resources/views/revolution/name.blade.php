@extends('layouts.app_revolution')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $quiz->name }}</h2>
                    </div>
                    <div class="card-body">
                        <p>{{ $quiz->description }}</p>

                        <form method="post" action="{{ route('quiz_play_revolution') }}" id="userForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-xl manouri manouri-xl" name="username" id=username" aria-describedby="pinHelp" placeholder="Ψευδώνυμο">
                                <small id="pinHelp" class="form-text text-muted">Γράψε το ψευδώνυμο σου!</small>
                                <input type="hidden" name="quiz" id="quiz" value="15" />
                            </div>
                            <button type="submit" class="btn btn-success btn-lg manouri btn-block manouri-lg"><i class="fa fa-shield"></i> Φύγαμε!</button>
                            <br/><br/>
                            <div class="text-center">
                                <a href="{{ route('quiz_results_revolution', ['pin' => 1]) }}" class="text-center"><i class="fa fa-bar-chart-o"></i> Αποτελέσματα</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
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
