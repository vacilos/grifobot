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

        .grid {
            display: grid;
            grid-gap: 0;
            grid-template-columns: repeat(6, [col] 10vw);
            grid-template-rows: repeat(6, [row] 10vw);
            width: 60vw;
            border: 3px solid #000;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
            background-color: #fff;
        }

        .grid b {
            font-size: calc(1.5vw);
            padding-top: 1vw;
            text-align: center;
            border: 1px solid #000;

        }

        .grid b img {
            max-width: calc(5vw);
        }
    </style>
@endsection
@section('content')
    <div class=" container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <h3>Τουρνουά #{{ $tournament->id }} - {{ $tournament->name }} | Παιχνίδι {{ $game }}/6</h3>
                <main class="grid">
                    @foreach($pattern as $pat)
                        <b id="pos{{$pat->id}}" @if($pat->blocked == true)style="background-color: black;"@endif>
                        @if($pat->player == true) <div id="pos{{$pat->id}}p"><img src="{{asset('images')}}/{{Auth::user()->avatar}}" style="overflow: hidden;display:inline;" /></div> @endif
                            @if($pat->math == true) <div id="pos{{$pat->id}}e"><a href="javascript:mathClicked({{$pat->matheq}}, {{$pat->id}});">Άσκηση</a></div> @endif
                        </b>
                @endforeach
                </main>
            </div>
            <div class="col-4">
                <div class="sticky-top">
                    <h2 class="text-center">{{Auth::user()->name}}</h2>

                        <button id="bl" onclick="selectedAction('L');" class="btn  btn-info btn-lg"><i class="fa fa-arrow-left"></i></button>
                        <button id="br" onclick="selectedAction('R');" class="btn  btn-info btn-lg"><i class="fa fa-arrow-right"></i></button>
                        <button id="bu" onclick="selectedAction('U');" class="btn  btn-info btn-lg"><i class="fa fa-arrow-up"></i></button>
                        <button id="bd" onclick="selectedAction('D');" class="btn  btn-info btn-lg"><i class="fa fa-arrow-down"></i></button>

                    <h4>Κινήσεις</h4>
                    <span id="moves" style="font-size:26px;">

                    </span>
                    <button id="bgo" onclick="go();" class="btn btn-lg btn-block btn-success"><i class="fa fa-play"></i> Ξεκίνα</button>
                    <button id="bdel" onclick="clearMoves();" class="btn btn-danger float-right"><i class="fa fa-trash"></i></button>

                    <hr style="clear:both;"/>
                    <h4>ΣΚΟΡ: <span id="score">0</span></h4>
                </div>
            </div>
        </div>

    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Άσκηση</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1><span id="modalquestion"></span></h1>
                            <br/><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h5>Απάντηση:</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="answerinmodal">
                                <input id="answer" name="answer" type="text" class="form-control" style="font-size:30px;" placeholder="Γράψε την απάντησή σου" autocomplete="off"/>
                            </div>
                            <div id="multiplechoiceinmodal" class="text-center">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalbutton" onclick="javascript:submitModal();">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="endGameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Τέλος παιχνιδιού</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1>ΜΠΡΑΒΟ</h1>
                            <br/><br/>
                            <h4>Ολοκλήρωσες το παιχνίδι {{ $game }} από 6 του τουρνουά</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p>Σκόρ πίνακα: <span id="endGameScore"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($game < 6)
                    <a href="{{ route('play_tournament', ['tournament'=> $tournament, 'game' => $game+1]) }}" class="btn btn-success">Επόμενο</a>
                    @else
                        <a href="{{ route('finish_tournament', ['tournament'=> $tournament]) }}" class="btn btn-success">ΤΕΛΟΣ</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΜΠΡΑΒΟ</h5>
                </div>
                <div class="modal-body">
                    <p>
                    Τώρα χρησιμοποίησε τα βελάκια για να οδηγήσεις τον παίκτη στο χρωματιστό κελι!<Br/>
                    ΠΡΟΣΟΧΗ! Έχεις μόνο μία ευκαιρία και αν δοκιμάσεις να λύσεις άλλη άσκηση θα χάσεις τους πόντους.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΚΡΙΜΑ</h5>
                </div>
                <div class="modal-body">
                    <p>
                    Η απάντηση δεν ήταν σωστή. Προσπάθησε κάποια άλλη άσκηση.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="correctPlaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΜΠΡΑΒΟ</h5>
                </div>
                <div class="modal-body">
                    <p>
                        Έφτασες στο σωστό τετράγωνο με <span id="currentMoves"></span> κινήσεις!
                        <br/>Πήρες <span id="currentPoints"></span> πόντους!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="incorrectPlaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΚΡΙΜΑ</h5>
                </div>
                <div class="modal-body">
                    <p>
                    Δεν έφτασες στο σωστό κουτί!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="instructionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Οδηγίες | Λύσε τους γρίφους με τις λιγότερες κινήσεις</h5>
                </div>
                <div class="modal-body">
                    <p>
                        Σκοπός του παιχνιδιού είναι να απαντήσεις σωστά τις ερωτήσεις του πίνακα κάνοντας με τον παίκτη σου τις λιγότερες κινήσεις.
                    </p>
                    <p>
                        <b>Βήμα 1: </b> Πάτα σε μία άσκηση<br/>
                        <b>Βήμα 2: </b> Λύσε την άσκηση γράφοντας τη σωστή απάντηση<br/>
                        <b>Βήμα 3: </b> Αν βρήκες τη σωστή απάντηση, το τετράγωνο χρωματίζεται<br/>
                        <b>Βήμα 4: </b> Χρησιμοποίησε τα βελάκια για να οδηγήσεις την εικόνα σου στο χρωματισμένο τετράγωνο. Έχεις μια ευκαιρία!<br/>
                        <b>Βήμα 5: </b> Αν φτάσεις στο χρωματισμένο τετράγωνο κερδίζεις πόντους<br/>
                        <b>Βήμα 6: </b> Συνέχισε μέχρι να τελειώσουν όλες οι ασκήσεις στον πίνακα<br/>
                    </p>
                    <p>
                        <b>Προσοχή!</b>
                        <ul>
                            <li>Κάθε φορά έχεις μία ευκαιρία να φτάσεις μέχρι το χρωματισμένο τετράγωνο.</li>
                            <li>Απαγορεύεται να χτυπήσεις στις άκρες ή να πατήσεις στα μαύρα τετράγωνα!</li>
                        </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            disableArrows();
            $('#instructionsModal').modal('show');

            $('#exampleModal').on("shown.bs.modal", function() {
                $('#answer').focus();
            });
        });

        var currentQuestion = 0;
        var currentAnswer = 0;
        var solvingEquation = 0;
        var move = 1;
        var totalmoves = 0;
        var moves = [];
        var blocks = [];
        var patternSize = {{ $size }};
        var collision = 0;
        var counter = 0;
        var todo = 0;
        var score = 0;
        var totalscore = 0;
        var plan = {{ $plan->id }};
        var userId = {{ Auth::user()->id }}
        var totalQuestions = {{ sizeof($questions) }};
        var completedQuestions = 0;

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
                $('#moves').append('<span id=movement'+move+'>'+move+'. <i class="fa fa-arrow-left"></i> #Α</span><br/>');
                moves.push('L');
                move++;
            }
            else if(i== "R") {
                $('#moves').append('<span id=movement'+move+'>'+move+'.  <i class="fa fa-arrow-right"></i> #Δ</span><br/>');
                moves.push('R');
                move++;
            }
            else if(i== "U") {
                $('#moves').append('<span id=movement'+move+'>'+move+'.  <i class="fa fa-arrow-up"></i> #Π</span><br/>');
                moves.push('U');
                move++;
            }
            else if(i== "D") {
                $('#moves').append('<span id=movement'+move+'>'+move+'. <i class="fa fa-arrow-down"></i> #Κ</span><br/>');
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

        }

        function go() {
            disableArrows();

            if(moves.length == 0) {
                collision = 1;
            }

            printCounter();
        }

        function printCounter() {
            if(collision == 1) {
                clearMoves();
                checkEndGame();
            } else {
                movePlayer(moves[counter], counter);
                counter++;
                if (counter < moves.length && collision != 1) {
                    setTimeout(printCounter, 900);
                } else {
                    if(player == currentQuestion && collision != 1) {
                        var currentMoves = moves.length;
                        totalmoves += moves.length;
                        score += parseInt(100/currentMoves);

                        $('#currentMoves').html(currentMoves);
                        $("#currentPoints").html(parseInt(100/currentMoves));
                        submitScore(score, plan, userId, totalmoves);
                        $("#score").html(score);
                        $("#correctPlaceModal").modal('show');
                        $('#pos'+currentQuestion).css('background-color', 'white');
                    } else {
                        $("#incorrectPlaceModal").modal('show');
                        $('#pos'+currentQuestion).css('background-color', 'white');
                        currentQuestion = -10;
                    }
                    setTimeout(clearMoves, 2000);
                    checkEndGame();
                }
            }

        }

        function movePlayer(item, counter) {
            var nextCounter = counter+1;
            $('#movement'+ counter).css('color', 'black');
            $('#movement'+ nextCounter).css('color', 'red');
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
                $('#pos'+todo).append('<div id="pos'+todo+'p"><img src="{{asset("images")}}/{{Auth::user()->avatar}}" style="overflow: hidden;display:inline;" /></div>');
                player = todo;
            } else {
                $('#pos'+currentQuestion).css('background-color', 'white');

            }

        }

        function mathClicked(mathId, eq) {
            solvingEquation = 1;
            currentQuestion = eq;
            completedQuestions++;
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
                    currentAnswer = data.answer;
                    var wrong = data.wrong;
                    console.log(wrong);
                    if(wrong.length > 0) {
                        //create buttons
                        var buttoncode = "<h5>Διάλεξε τη σωστή απάντηση</h5>";
                        for(var i=0; i<wrong.length; i++) {
                            buttoncode += '<button onclick="submitModal(\''+wrong[i]+'\');" class="btn btn-lg btn-info" style="font-size: 26px; margin:5px 10px;">'+wrong[i]+'</button>';
                        }
                        $('#answerinmodal').hide();
                        $('#multiplechoiceinmodal').show();
                        $('#multiplechoiceinmodal').html(buttoncode);
                    } else {
                        $('#multiplechoiceinmodal').html("");
                        $('#answerinmodal').show();
                        $('#multiplechoiceinmodal').hide();
                    }
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

        function submitScore(score, plan, userId, movements) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type:'POST',
                url:'{{ route('user_score_tournament') }}',
                data:
                    {
                        score: score,
                        plan: plan,
                        userId: userId,
                        movements: movements,
                        tournament: {{ $tournament->id }},
                        game: {{ $game }}
                    },
                success:function(data) {
                    $("#footer_msg").html(data.answer);
                },
                error:function(data) {
                    console.log(data)
                }
            });

        }

        function submitModal(i = null) {
            $('#exampleModal').modal('hide');
            var mathId = currentQuestion;

            var answer = $('#answer').val();
            var regex = /(\d+)\./g;
            if (answer.match(regex)) {
                answer = answer.replace(regex, "$1");
            }
            if(i != null) {
                answer = i;
            }

            if(answer == currentAnswer) {
                // enable the keys!
                $("#successModal").modal('show');
                $('#pos'+currentQuestion).css('background-color', 'magenta');
                enableArrows();

            } else {
                // remove the current question
                $("#failModal").modal('show');
                checkEndGame();
            }
            $('#answer').val('');
            $('#pos'+currentQuestion+"e").remove();

        }

        function enableArrows() {
            $('#bl').prop('disabled', false);
            $('#br').prop('disabled', false);
            $('#bu').prop('disabled', false);
            $('#bd').prop('disabled', false);
            $('#bgo').prop('disabled', false);
            $('#bdel').prop('disabled', false);
        }
        function disableArrows() {
            $('#bl').prop('disabled', true);
            $('#br').prop('disabled', true);
            $('#bu').prop('disabled', true);
            $('#bd').prop('disabled', true);
            $('#bgo').prop('disabled', true);
            $('#bdel').prop('disabled', true);
        }

        function checkEndGame() {
            console.log('checking end');
            if(completedQuestions == totalQuestions) {
                console.log('checking end');
                $("#failModal").on('hidden.bs.modal', function(e) {
                    $("#endGameScore").html(score);
                    $('#endGameModal').modal({
                        keyboard: false,
                        backdrop: 'static',
                    });
                });
                $("#correctPlaceModal").on('hidden.bs.modal', function(e) {
                    $("#endGameScore").html(score);
                    $('#endGameModal').modal({
                        keyboard: false,
                        backdrop: 'static',
                    });
                });
                $("#incorrectPlaceModal").on('hidden.bs.modal', function(e) {
                    $("#endGameScore").html(score);
                    $('#endGameModal').modal({
                        keyboard: false,
                        backdrop: 'static',
                    });
                });

            }
        }

    </script>
@endsection
