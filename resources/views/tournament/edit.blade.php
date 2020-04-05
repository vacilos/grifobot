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
                <form method="post" action="{{ route('tournaments.update', $math) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="category">Κατηγορία ερωτήσεων</label>
                        <select id="category" name="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $tournament->categry) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="level">Επίπεδο</label>
                        <select name="level" id="level" size="1" aria-describedby="levelhelp" class="form-control">
                            <option value="1" @if($category->level == 1) selected @endif>Α' Δημοτικού</option>
                            <option value="2" @if($category->level == 1) selected @endif>Β' Δημοτικού</option>
                            <option value="3" @if($category->level == 1) selected @endif>Γ' Δημοτικού</option>
                            <option value="4" @if($category->level == 1) selected @endif>Δ' Δημοτικού</option>
                            <option value="5" @if($category->level == 1) selected @endif>Ε' Δημοτικού</option>
                            <option value="6" @if($category->level == 1) selected @endif>ΣΤ' Δημοτικού</option>
                        </select>
                        <small id="levelhelp" class="form-text text-muted">Καταγράψτε το επίπεδο του τουρνουά</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Τίτλος</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="namehelp" placeholder="Ονομασία Τουρνουά" value="{{$tournament->name}}">
                        <small id="namehelp" class="form-text text-muted">Καταγράψτε το όνομα του τουρνουά.</small>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Ημερομηνία έναρξης</label>
                        <input type="text" name="start_date" class="form-control" id="start_date" aria-describedby="start_datehelp" placeholder="Ημερομηνία" value="{{ $tournament->start_date }}">
                        <small id="start_datehelp" class="form-text text-muted">Καταγράψτε ημερομηνία έναρξης YYYY-MM-DD.</small>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Ώρα έναρξης</label>
                        <input type="text" name="start_time" class="form-control" id="start_time" aria-describedby="start_timehelp" placeholder="Ημερομηνία" value="{{ $tournament->start_time }}">
                        <small id="start_timehelp" class="form-text text-muted">Καταγράψτε την ώρα έναρξης του τουρνουά.</small>
                    </div>
                    <div class="form-group">
                        <label for="end_time">Ώρα λήξης</label>
                        <input type="text" name="end_time" class="form-control" id="end_time" aria-describedby="end_timehelp" placeholder="Ημερομηνία"  value="{{ $tournament->end_time }}">
                        <small id="end_timehelp" class="form-text text-muted">Καταγράψτε την ώρα έναρξης του τουρνουά.</small>
                    </div>
                    <div class="form-group">
                        <label for="active">Ενεργό</label>
                        <input type="text" name="active" class="form-control" id="active" aria-describedby="activehelp" placeholder="Ενεργό (0,1)"  value="{{ $tournament->active }}">
                        <small id="activehelp" class="form-text text-muted">Ενεργό (0,1).</small>
                    </div>
                    <button type="submit" class="btn btn-success">Υποβολή</button> <a href="{{route('tournaments.index')}}" class="btn btn-default">Επιστροφή</a>
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
