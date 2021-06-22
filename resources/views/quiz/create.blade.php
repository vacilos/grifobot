@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h3>Δημιουργία Νέου Κουίζ</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('quiz.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="quizname">Όνομα</label>
                        <input type="text" name="quizname" class="form-control" id="quizname" aria-describedby="quiznamehelp" placeholder="π.χ. Κουίζ στα μαθηματικά">
                        <small id="quiznamehelp" class="form-text text-muted">Καταγράψτε το όνομα που θα έχει το κουίζ.</small>
                    </div>

                    <div class="form-group">
                        <label for="">Πόλη</label>
                        <select name="quiztown" id="quiztown" size="1" class="form-control">
                            @foreach($towns as $town)
                                <option value="{{ $town->id }}">{{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quizdesc">Περιγραφή</label><br/>
                        <textarea name="quizdesc" class="form-control" id="quizdesc" aria-describedby="mathquestionhelp" placeholder="Περιγράψτε με λίγα λόγια τι περιλαμβάνει το κουίζ"></textarea>
                        <small id="mathquestionhelp" class="form-text text-muted">Γράψτε σύντομα τι περιλαμβάνει το κουίζ. ΔΕΝ είναι υποχρεωτικό πεδίο!</small>
                    </div>
                    <div class="form-group">
                        <label for="quizlevel">Επίπεδο</label>
                        <select name="quizlevel" id="quizlevel" size="1" aria-describedby="quizlevelhelp" class="form-control">
                            <option value="1">Μικρό</option>
                            <option value="2">Μεσαίο</option>
                            <option value="3">Μεγάλο</option>
                        </select>
                        <small id="quizlevelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (επίπεδο)</small>
                    </div>

                    <div class="form-group">
                        <label for="">Μέγεθος</label>
                        <select name="quizsize" id="quizsize" size="1" aria-describedby="quizsizehelp" class="form-control">
                            <option value="5">5x5 (κατάλληλο για 8 ασκήσεις)</option>
                            <option value="6">6x6 (κατάλληλο για 12 ασκήσεις)</option>
                            <option value="7">7x7 (κατάλληλο για 16 ασκήσεις)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('quiz.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script src="{{ asset('dt/moment.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    'format': 'YYYY-MM-DD HH:mm'
                });
            });

            // get value from dropdown
            var size = $("#quizsize").val();
            setExercise(size);


            $('#quizsize').on('change', function() {
                setExercise( this.value );
            });
        });

        function setExercise(size) {
            $("#quizexercise").empty();
            if(size == 4) {
                for(i = 3; i<= 5; i++) {
                    $("#quizexercise").append('<option value="'+i+'">'+i+'</option>');
                }
            } else if (size == 5) {
                for(i = 3; i<= 10; i++) {
                    $("#quizexercise").append('<option value="'+i+'">'+i+'</option>');
                }
            } else if (size == 6) {
                for(i = 5; i<= 14; i++) {
                    $("#quizexercise").append('<option value="'+i+'">'+i+'</option>');
                }
            } else if (size == 7) {
                for(i = 8; i<= 20; i++) {
                    $("#quizexercise").append('<option value="'+i+'">'+i+'</option>');
                }
            }
        }


    </script>
@endsection
