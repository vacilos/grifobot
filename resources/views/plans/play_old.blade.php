@extends('layouts.app')

@section('stylesheet')
    <style>
        .col {
            padding-top: 8.3333333%;
            border:1px solid #000;
            position: relative; /* If you want text inside of it */
        }

        .data {
            position: absolute;
            top: 3px;
            left: 3px;
            max-height: 3.3333333%
        }


    </style>
@endsection
@section('content')
    <div class=" container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                Main puzzle
                <div class="row">
                    @foreach($pattern as $pat)

                    <div class="col" @if($pat->blocked == true)style="background-color: red;"@endif>
                        <div class="row">
                            <div class="data" class="col-sm-12" id="pos{{$pat->id}}">
                                @if($pat->player == true) <div id="pos{{$pat->id}}p"><img src="{{asset('images')}}/{{Auth::user()->avatar}}" style="overflow: hidden;display:inline;" /></div> @endif

                                @if($pat->math == true) <a href="javascript:mathClicked({{$pat->matheq}});">Ερώτημα</a> @endif
                            </div>
                        </div>
                    </div>
                        @if($loop->iteration % $size == 0)
                            </div><div class="row">
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <h2>Όνομα παίκτη</h2>

                    <button id="bl" onclick="selectedAction('L');" class="btn  btn-info"><i class="fas fa-arrow-left"></i></button>
                    <button id="br" onclick="selectedAction('R');" class="btn  btn-info"><i class="fas fa-arrow-right"></i></button>
                    <button id="bu" onclick="selectedAction('U');" class="btn  btn-info"><i class="fas fa-arrow-up"></i></button>
                    <button id="bd" onclick="selectedAction('D');" class="btn  btn-info"><i class="fas fa-arrow-down"></i></button>


                <h3>Κινήσεις</h3>
                <span id="moves" style="font-size:26px;">

                </span>
                <button id="bgo" onclick="go();" class="btn btn-lg btn-block btn-success"><i class="fas fa-play"></i> Εκκίνηση</button>
                <button id="bdel" onclick="clearMoves();" class="btn btn-danger float-right"><i class="fas fa-trash"></i></button>
            </div>
        </div>

    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Άσκηση</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1><span id="modalquestion"></span></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1>=</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input id="answer" name="answer" type="text" class="form-control" style="font-size:30px;" placeholder="Γράψε την απάντησή σου"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalbutton" onclick="javascript:submitModal();">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΜΠΡΑΒΟ</h5>
                </div>
                <div class="modal-body">
                    <p>
                    Τώρα χρησιμοποίησε τα βελάκια για να οδηγήσεις τον παίκτη στο κελί που μόλις βρήκε!<Br/>
                    ΠΡΟΣΟΧΗ! Έχεις μόνο μία ευκαιρία.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <div id="successAlert" class="alert alert-success alert-dismissible fade collapse" role="alert">
        <h4>ΜΠΡΑΒΟ!</h4>
        <p>
            Τώρα χρησιμοποίησε τα βελάκια για να οδηγήσεις τον παίκτη στο κελί που βρήκες τη σωστή ερώτηση.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection

@section('javascript')
    <script>
        var currentQuestion = 0;
        var currentAnswer = 0;
        var solvingEquation = 0;
        var move = 1;
        var moves = [];
        var blocks = [];
        var patternSize = {{ $size }};
        var collision = 0;
        var counter = 0;
        var todo = 0;

        @foreach($pattern as $pat)
            @if($pat->player == true)
                var player = {{ $pat->id }}
            @endif
        @endforeach

        @foreach($blocked as $block)
            blocks.push({{ $block }});
        @endforeach


        function selectedAction(i) {
            if(i == "L") {
                $('#moves').append(move+'. <i class="fas fa-arrow-left"></i> #Α<br/>');
                moves.push('L');
                move++;
            }
            else if(i== "R") {
                $('#moves').append(move +'. <i class="fas fa-arrow-right"></i> #Δ<br/>');
                moves.push('R');
                move++;
            }
            else if(i== "U") {
                $('#moves').append(move +'. <i class="fas fa-arrow-up"></i> #Π<br/>');
                moves.push('U');
                move++;
            }
            else if(i== "D") {
                $('#moves').append(move +'. <i class="fas fa-arrow-down"></i> #Κ<br/>');
                moves.push('D');
                move++;
            }

        }

        function clearMoves() {
            $('#moves').empty();
            move = 1;
            moves = [];
            counter = 0;
            collision = 0;
            todo = 0;

            $('#bl').prop('disabled', false);
            $('#br').prop('disabled', false);
            $('#bu').prop('disabled', false);
            $('#bd').prop('disabled', false);
            $('#bgo').prop('disabled', false);
            $('#bdel').prop('disabled', false);
        }

        function go() {
            $('#bl').prop('disabled', true);
            $('#br').prop('disabled', true);
            $('#bu').prop('disabled', true);
            $('#bd').prop('disabled', true);
            $('#bgo').prop('disabled', true);
            $('#bdel').prop('disabled', true);

            printCounter();

        }

        function printCounter() {
            if(collision == 1) {
                clearMoves()
            } else {
                movePlayer(moves[counter]);
                counter++;
                if (counter < moves.length && collision != 1) {
                    setTimeout(printCounter, 2000);
                } else {
                    setTimeout(clearMoves, 2100);
                }
            }

        }

        function movePlayer(item) {
            switch (item) {
                case "U":
                    todo = player - patternSize;
                    if(todo < 0 || todo > patternSize*patternSize || blocks.includes(todo)) {
                        collision = 1;
                        alert('ΧΤΥΠΗΣΕ');
                    }
                    break;
                case "D":
                    todo = player + patternSize;
                    if(todo < 0 || todo > patternSize*patternSize || blocks.includes(todo)) {
                        collision = 1;
                        alert('ΧΤΥΠΗΣΕ');
                    }
                    break;
                case "R":
                    todo = player + 1;
                    if(todo < 0 || todo > patternSize*patternSize || player%patternSize==0 || blocks.includes(todo)) {
                        collision = 1;
                        alert('ΧΤΥΠΗΣΕ');
                    }
                    break;
                case "L":
                    todo = player - 1;
                    if(todo < 0 || todo > patternSize*patternSize || player%patternSize==1 || blocks.includes(todo)) {
                        collision = 1;
                        alert('ΧΤΥΠΗΣΕ');
                    }
                    break;
            }

            if(collision == 0) {
                $('#pos'+player+"p").remove();
                $('#pos'+todo).append('<span id="pos'+todo+'p">Player</span>');
                player = todo;
            }
            console.log(todo);


        }

        function mathClicked(mathId) {
            solvingEquation = 1;
            currentQuestion = mathId;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type:'POST',
                url:'{{ route('mathquestion') }}',
                data:
                    {
                        id: mathId
                    },
                success:function(data) {
                    // OPEN modal
                    currentQuestion = data.id;
                    currentAnswer = data.answer;
                    $("#modalquestion").html(data.question);
                    $('#exampleModal').modal({
                        keyboard: false,
                        backdrop: 'static',

                    });
                },
                error:function(data) {
                    console.log(data)
                }
            });

        }

        function submitModal() {
            $('#exampleModal').modal('hide');
            var mathId = currentQuestion;
            var answer = $('#answer').val();
            if(answer == currentAnswer) {
                // enable the keys!
                $("#successModal").modal('show');
            } else {
                // remove the current question
                $("#failModal").modal('show');
            }

        }

    </script>
@endsection
