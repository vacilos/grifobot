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
                <form method="post" action="{{ route('maths.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="category">Κατηγορία</label>
                        <select id="category" name="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mathquestion">Ερώτηση</label><br/>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="javascript:showFractionModal();">Κλάσμα</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="javascript:previewQuestion();">Προεπισκόπηση</button>
                        </div>
                        <textarea name="mathquestion" class="form-control" id="mathquestion" aria-describedby="mathquestionhelp" placeholder="Καταγραφή άσκησης π.χ. 5+3="></textarea>
                        <small id="mathquestionhelp" class="form-text text-muted">Καταγραφή άσκησης π.χ. 5+3. Για διαίρεση σύμβολο :, για πολλαπλασιασμό σύμβολο *, για ύψωση σε δύναμη σύμβολο ^. Για κλάσμα ακεραίων γράφετε 23/34. Για κλάσμα δεκαδικών χρησιμοποιείτε το κουμπί Κλάσμα πάνω από το πεδίο. Πατήστε προεπισκόπηση για να δείτε το τελικό αποτέλεσμα</small>
                        <small id="previewquestion"></small>
                    </div>
                    <div class="form-group">
                        <label for="mathanswer">Απάντηση</label>
                        <input type="text" name="mathanswer" class="form-control" id="mathanswer" aria-describedby="mathanswerhelp" placeholder="Απάντηση της άσκησης π.χ. 8">
                        <small id="mathanswerhelp" class="form-text text-muted">Καταγράψτε την απάντηση της άσκησης.</small>
                    </div>
                    <div class="form-group">
                        <label for="mathlevel">Επίπεδο</label>
                        <select name="mathlevel" id="mathlevel" size="1" aria-describedby="mathlevelhelp" class="form-control">
                            <option value="1">Α' Δημοτικού</option>
                            <option value="2">Β' Δημοτικού</option>
                            <option value="3">Γ' Δημοτικού</option>
                            <option value="4">Δ' Δημοτικού</option>
                            <option value="5">Ε' Δημοτικού</option>
                            <option value="6">ΣΤ' Δημοτικού</option>
{{--                            <option value="7">Α' Γυμνασίου</option>--}}
{{--                            <option value="8">Β' Γυμνασίου</option>--}}
{{--                            <option value="9">Γ' Γυμνασίου</option>--}}
                        </select>
                        <small id="mathlevelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο της άσκησης (τάξη)</small>
                    </div>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('maths.index')}}" class="btn btn-default">Επιστροφή</a>
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
            // var quote = '' +
            //     '<span class="f"><div class="n">'+denom+'</div><div class="d">'+nom+'</div></span>';

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
