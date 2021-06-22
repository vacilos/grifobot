@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Δημιουργία Άσκησης</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('maths.update', $math) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="mathquestion">Ερώτηση</label><br/>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="javascript:showFractionModal();">Κλάσμα</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="javascript:previewQuestion();">Προεπισκόπηση</button>
                        </div>
                        <textarea name="mathquestion" class="form-control" id="mathquestion" aria-describedby="mathquestionhelp" placeholder="Καταγραφή άσκησης π.χ. 5+3=">{{ $math->question }}</textarea>
                        <small id="mathquestionhelp" class="form-text text-muted">Καταγραφή άσκησης π.χ. 5+3. Για διαίρεση σύμβολο :, για πολλαπλασιασμό σύμβολο *, για ύψωση σε δύναμη σύμβολο ^. Για κλάσμα ακεραίων γράφετε 23/34. Για κλάσμα δεκαδικών χρησιμοποιείτε το κουμπί Κλάσμα πάνω από το πεδίο. Πατήστε προεπισκόπηση για να δείτε το τελικό αποτέλεσμα</small>
                        <small id="previewquestion"></small>
                    </div>
                    <div class="form-group">
                        <label for="mathanswer">Απάντηση</label>
                        <input type="text" name="mathanswer" class="form-control" id="mathanswer" aria-describedby="mathanswerhelp" placeholder="Απάντηση της άσκησης π.χ. 8" value="{{ $math->answer }}">
                        <small id="mathanswerhelp" class="form-text text-muted">Καταγράψτε την απάντηση της άσκησης.</small>
                    </div>
                    <hr/>
                    <h5>Για περιπτώσεις ερωτήσεων πολλαπλής επιλογής συμπληρώστε τουλάχιστον ένα από τα ακόλουθα</h5>
                    <div class="form-group">
                        <label for="mathanswer_alt1">Εναλλακτική Απάντηση 1</label>
                        <input type="text" name="mathanswer_alt1" class="form-control" id="mathanswer_alt1" aria-describedby="mathanswer_alt1help" placeholder="Εναλλατική απάντηση της άσκησης π.χ. 12" value="{{ $math->answer_alt1 }}">
                        <small id="mathanswer_alt1help" class="form-text text-muted">Σε περιπτώσεις πολλαπλής επιλογής γράφετε μία "λάθος" απάντηση.</small>
                    </div>
                    <div class="form-group">
                        <label for="mathanswer_alt2">Εναλλακτική Απάντηση 2</label>
                        <input type="text" name="mathanswer_alt2" class="form-control" id="mathanswer_alt2" aria-describedby="mathanswer_alt2help" placeholder="Εναλλατική απάντηση της άσκησης π.χ. 20"value="{{ $math->answer_alt2 }}">
                        <small id="mathanswer_alt2help" class="form-text text-muted">Σε περιπτώσεις πολλαπλής επιλογής γράφετε μία "λάθος" απάντηση.</small>
                    </div>
                    <div class="form-group">
                        <label for="mathanswer_alt3">Εναλλακτική Απάντηση 3</label>
                        <input type="text" name="mathanswer_alt3" class="form-control" id="mathanswer_alt3" aria-describedby="mathanswer_alt3help" placeholder="Εναλλατική απάντηση της άσκησης π.χ. 22"value="{{ $math->answer_alt3 }}">
                        <small id="mathanswer_alt3help" class="form-text text-muted">Σε περιπτώσεις πολλαπλής επιλογής γράφετε μία "λάθος" απάντηση.</small>
                    </div>
                    <div class="form-group">
                        <label for="mathanswer_alt4">Εναλλακτική Απάντηση 4</label>
                        <input type="text" name="mathanswer_alt4" class="form-control" id="mathanswer_alt4" aria-describedby="mathanswer_alt4help" placeholder="Εναλλατική απάντηση της άσκησης π.χ. 6"value="{{ $math->answer_alt4 }}">
                        <small id="mathanswer_alt4help" class="form-text text-muted">Σε περιπτώσεις πολλαπλής επιλογής γράφετε μία "λάθος" απάντηση.</small>
                    </div>
                    <div class="form-group">
                        <label for="mathstory">Ιστορία</label><br/>
                        <textarea name="mathstory" class="form-control" id="mathstory" aria-describedby="mathstoryhelp" placeholder="Καταγραφή ιστορίας">{{ $math->story }}</textarea>
                        <small id="mathstoryhelp" class="form-text text-muted">Καταγραφή της ιστορίας που σχετίζεται με την ερώτηση</small>
                    </div>
                    <div class="form-group">
                        <label for="mathlevel">Επίπεδο</label>
                        <select name="mathlevel" id="mathlevel" size="1" aria-describedby="mathlevelhelp" class="form-control">
                            <option value="1" @if($math->level == 1) selected @endif>Μικρό</option>
                            <option value="2" @if($math->level == 2) selected @endif>Μεσαίο</option>
                            <option value="3" @if($math->level == 3) selected @endif>Μεγάλο</option>
                            {{--                            <option value="7">Α' Γυμνασίου</option>--}}
                            {{--                            <option value="8">Β' Γυμνασίου</option>--}}
                            {{--                            <option value="9">Γ' Γυμνασίου</option>--}}
                        </select>
                        <small id="mathlevelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>

                    <div class="form-group">
                        <label for="mathtown">Πόλη</label>
                        <select name="mathtown" id="mathtown" size="1"class="form-control">
                            <option value="0">Γενική</option>
                            @foreach($towns as $town)
                                <option value="{{ $town->id }}" @if($math->town_id == $town->id) selected @endif>{{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Υποβολή</button> <a href="{{route('maths.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addfraction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΜΠΡΑΒΟ</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="denom">Αριθμητής</label>
                        <input type="text" id="denom" name="denom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nom">Παρονομαστής</label>
                        <input type="text" id="nom" name="nom" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="javascript:fraction();">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">

        function fraction() {

            var denom = $('#denom').val();
            var nom = $('#nom').val();

            var quote = '<div class="fraction" top="'+denom+'" bottom="'+nom+'"></div>';

            // var quote = '<span class="f"><div class="n">'+denom+'</div><div class="d">'+nom+'</div></span>';

            $('#mathquestion').val(function(i, text) {
                return text + quote;
            });;
        }

        function showFractionModal() {
            $('#addfraction').modal('show');
        }

        function previewQuestion() {

            var thedata = $('#mathquestion').val();
            console.log
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type:'POST',
                url:'{{ route('preview_question') }}',
                data: {
                    question: thedata
                },
                success:function(data) {
                    console.log(data);
                    $("#previewquestion").html(data.answer);
                }
            });
        }
    </script>
@endsection
