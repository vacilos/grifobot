@extends('layouts.app')
@section('stylesheet')

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
                <h3>Οδηγίες</h3>
                <p>
                    Για τη δημιουργία ενός νέου κουίζ ακολουθείτε την εξής διαδικασία:
                    <ol>
                        <li>Καταγράφετε τα στοιχεία του κουίζ που εμφανίζονται σε αυτή τη σελίδα</li>
                        <li>Δημιουργείτε τις ασκήσεις που θα περιέχονται στο κουίζ</li>
                        <li>Παίρνετε ένα pin και ένα σύνδεσμο για το κουίζ που φτιάξατε</li>
                        <li>Στέλνετε το σύνδεσμο και το pin στους μαθητές</li>
                    </ol>
                </p>
                <form method="post" action="{{ route('quiz_store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="quizname">Όνομα</label>
                        <input type="text" name="quizname" class="form-control" id="quizname" aria-describedby="quiznamehelp" placeholder="π.χ. Κουίζ στα μαθηματικά">
                        <small id="quiznamehelp" class="form-text text-muted">Καταγράψτε το όνομα που θα έχει το κουίζ.</small>
                    </div>
                    <div class="form-group">
                        <label for="quizdesc">Περιγραφή</label><br/>
                        <textarea name="quizdesc" class="form-control" id="quizdesc" aria-describedby="mathquestionhelp" placeholder="Περιγράψτε με λίγα λόγια τι περιλαμβάνει το κουίζ"></textarea>
                        <small id="mathquestionhelp" class="form-text text-muted">Γράψτε σύντομα τι περιλαμβάνει το κουίζ. ΔΕΝ είναι υποχρεωτικό πεδίο!</small>
                    </div>
                    <div class="form-group">
                        <label for="quizlevel">Επίπεδο</label>
                        <select name="quizlevel" id="quizlevel" size="1" aria-describedby="quizlevelhelp" class="form-control">
                            <option value="1">Α' Δημοτικού</option>
                            <option value="2">Β' Δημοτικού</option>
                            <option value="3">Γ' Δημοτικού</option>
                            <option value="4">Δ' Δημοτικού</option>
                            <option value="5">Ε' Δημοτικού</option>
                            <option value="6">ΣΤ' Δημοτικού</option>
                            <option value="8">Α' Γυμνασίου</option>
                            <option value="9">Β' Γυμνασίου</option>
                            <option value="10">Γ' Γυμνασίου</option>
                            <option value="11">Α' Λυκείου</option>
                            <option value="12">Β' Λυκείου</option>
                            <option value="13">Γ' Λυκείου</option>
                        </select>
                        <small id="quizlevelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>

                    <div class="form-group">
                        <label for="">Μέγεθος</label>
                        <select name="quizsize" id="quizsize" size="1" aria-describedby="quizsizehelp" class="form-control">
                            <option value="4">4x4 (κατάλληλο για 3-5 ασκήσεις)</option>
                            <option value="5">5x5 (κατάλληλο για 3-10 ασκήσεις)</option>
                            <option value="6">6x6 (κατάλληλο για 5-14 ασκήσεις)</option>
                            <option value="7">7x7 (κατάλληλο για 8-20 ασκήσεις)</option>
                        </select>
                        <small id="quizsizehelp" class="form-text text-muted">Μέγεθος πίνακα (4x4 για πολύ μικρές τάξεις, χωράει μέχρι 5 ασκήσεις. 7x7 για μεγάλες τάξεις, χωράει μέχρι 20 ασκήσεις)</small>
                    </div>
                    <div class="form-group">
                        <label for="quizexercise">Αριθμός Ασκήσεων</label>
                        <select name="quizexercise" id="quizexercise" size="1" aria-describedby="quizexercisehelp" class="form-control"></select>
                        <small id="quizexercisehelp" class="form-text text-muted">Επιλέξτε τον αριθμό των ασκήσεων που θέλετε να βάλετε στο παζλ</small>
                    </div>
                    <div class="form-group">
                        <label for="quizpublic">Δημόσιο</label>
                        <select name="quizpublic" id="quizpublic" size="1" aria-describedby="quizpublichelp" class="form-control">
                            <option value="0">Όχι - θα αποφασίσω εγώ σε ποιους θα το δώσω</option>
                            <option value="1">Ναι - Να μπορούν να το βλέπουν όλοι και να παίζουν ελεύθερα</option>
                        </select>
                        <small id="quizpublichelp" class="form-text text-muted">Επιλέξτε εάν θέλετε το κουίζ να μπορούν να δουν όλοι οι χρήστες του Γριφομπότ</small>
                    </div>

                    <div class="form-group">
                        <label for="quizdate">Ημ. Λήξης</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <small id="quizdatehelp" class="form-text text-muted">Καταγράψτε την ημερομηνία λήξης του ΚΟΥΙΖ (κενό αν δεν έχει).</small>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('quiz_my')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    <script src="{{ asset('dt/moment.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    'format': 'YYYY-MM-DD hh:ii'
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
