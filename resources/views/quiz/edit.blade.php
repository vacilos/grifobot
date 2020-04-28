@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h3>Επεξεργασία Κουίζ</h3>
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
                <form method="post" action="{{ route('quiz_update', ['quiz' => $quiz]) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="quizname">Όνομα</label>
                        <input type="text" name="quizname" class="form-control" id="quizname" aria-describedby="quiznamehelp" placeholder="π.χ. Κουίζ στα μαθηματικά" value="{{ $quiz->name }}">
                        <small id="quiznamehelp" class="form-text text-muted">Καταγράψτε το όνομα που θα έχει το κουίζ.</small>
                    </div>
                    <div class="form-group">
                        <label for="quizdesc">Περιγραφή</label><br/>
                        <textarea name="quizdesc" class="form-control" id="quizdesc" aria-describedby="mathquestionhelp" placeholder="Περιγράψτε με λίγα λόγια τι περιλαμβάνει το κουίζ">{{ $quiz->description }}</textarea>
                        <small id="mathquestionhelp" class="form-text text-muted">Γράψτε σύντομα τι περιλαμβάνει το κουίζ. ΔΕΝ είναι υποχρεωτικό πεδίο!</small>
                    </div>
                    <div class="form-group">
                        <label for="quizlevel">Επίπεδο</label>
                        <select name="quizlevel" id="quizlevel" size="1" aria-describedby="quizlevelhelp" class="form-control">
                            <option value="1" @if($quiz->level == 1) selected @endif>Α' Δημοτικού</option>
                            <option value="2" @if($quiz->level == 2) selected @endif>Β' Δημοτικού</option>
                            <option value="3" @if($quiz->level == 3) selected @endif>Γ' Δημοτικού</option>
                            <option value="4" @if($quiz->level == 4) selected @endif>Δ' Δημοτικού</option>
                            <option value="5" @if($quiz->level == 5) selected @endif>Ε' Δημοτικού</option>
                            <option value="6" @if($quiz->level == 6) selected @endif>ΣΤ' Δημοτικού</option>
                            <option value="8" @if($quiz->level == 8) selected @endif>Α' Γυμνασίου</option>
                            <option value="9" @if($quiz->level == 9) selected @endif>Β' Γυμνασίου</option>
                            <option value="10" @if($quiz->level == 10) selected @endif>Γ' Γυμνασίου</option>
                            <option value="11" @if($quiz->level == 11) selected @endif>Α' Λυκείου</option>
                            <option value="12" @if($quiz->level == 12) selected @endif>Β' Λυκείου</option>
                            <option value="13" @if($quiz->level == 13) selected @endif>Γ' Λυκείου</option>
                            <option value="100" @if($quiz->level == 100) selected @endif>Άλλο</option>
                        </select>
                        <small id="quizlevelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>

                    <div class="form-group">
                        <label for="quizpublic">Δημόσιο</label>
                        <select name="quizpublic" id="quizpublic" size="1" aria-describedby="quizpublichelp" class="form-control">
                            <option value="0" @if($quiz->public == 0) selected @endif>Όχι - θα αποφασίσω εγώ σε ποιους θα το δώσω</option>
                            <option value="1" @if($quiz->public == 1) selected @endif>Ναι - Να μπορούν να το βλέπουν όλοι και να παίζουν ελεύθερα</option>
                        </select>
                        <small id="quizpublichelp" class="form-text text-muted">Επιλέξτε εάν θέλετε το κουίζ να μπορούν να δουν όλοι οι χρήστες του Γριφομπότ</small>
                    </div>

                    <div class="form-group">
                        <label for="quizdate">Ημ. Λήξης</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="quizdate" id="quizdate" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="{{$quiz->end_date}}"/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <small id="quizdatehelp" class="form-text text-muted">Καταγράψτε την ημερομηνία λήξης του ΚΟΥΙΖ (κενό αν δεν έχει).</small>
                    </div>
                    <button type="submit" class="btn btn-success">Υποβολή</button> <a href="{{route('quiz_my')}}" class="btn btn-default">Επιστροφή</a>
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
        });


    </script>
@endsection
