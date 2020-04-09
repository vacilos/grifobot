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
            grid-template-columns: repeat({{ $size }}, [col] 10vw);
            grid-template-rows: repeat({{$size}}, [row] 10vw);
            width: {{$size*10}}vw;
            border: 3px solid @if($plan->id%2 == 0)red @else blue @endif ;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
            background-color: #fff;
        }

        .grid b {
            font-size: calc(1.5vw);
            padding-top: 1vw;
            text-align: center;
            border: 1px solid  @if($plan->id%2 == 0)red @else blue @endif ;

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
                <h3>{{ $tournament->name }} | Παιχνίδι {{ $game }}/6</h3>
                <main class="grid">
                    @foreach($pattern as $pat)
                        <b id="pos{{$pat->id}}">
                            @if($pat->player == true) <div id="pos{{$pat->id}}p"><img src="{{asset('images')}}/{{Auth::user()->avatar}}" style="overflow: hidden;display:inline;" /></div> @endif
                            @if($pat->math == true) <div id="pos{{$pat->id}}e"><img src="{{asset('images')}}/kinder{{$pat->matheq}}.jpg" style="overflow: hidden;display:inline; max-width: calc(8vw);" /></div> @endif
                            @if($pat->blocked == true) <div id="pos{{$pat->id}}b"><img src="{{asset('images')}}/dog0.jpg" style="overflow: hidden;display:inline; max-width: calc(8vw);" /></div> @endif
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
                    <hr/>
                    <h4>Εικόνες που πρέπει να πας</h4>
                    <div class="row">
                        @foreach($pattern as $pat)
                            @if($pat->math == true) <div class="col-sm-3"><img src="{{asset('images')}}/kinder{{$pat->matheq}}.jpg" class="img-fluid" /></div> @endif
                        @endforeach
                    </div>
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


    <div class="modal fade" id="collisionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ΟΥΠΣ</h5>
                </div>
                <div class="modal-body text-center">
                    <p class="text-center">
                        <img src="{{asset('images/dog2.jpg')}}" style="max-width:150px;" /><br/>
                        Ξύπνησες το σκυλο...
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
                <div class="modal-body text-center">
                    <p class="text-center">
                        <img src="{{asset('images/dog1.jpg')}}" style="max-width:150px;" /><br/>
                        Εικόνες που πήγες: <span id="currentVisited"></span>!
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
                <div class="modal-body text-center">
                    <p class="text-center">
                        <i class="fa fa-frown-o fa-5" style="color: red; font-size:48px;"></i><Br/>

                        Δεν πέρασες από κάποια εικόνα!
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
                    <h5 class="modal-title" id="exampleModalLabel">Οδηγίες | Βρες το δρόμο για τις εικόνες</h5>
                </div>
                <div class="modal-body">
                    <p>
                        Σκοπός του παιχνιδιού είναι να περάσει ο παίκτης πάνω από τις εικόνες με μια μόνο εντολή κινήσεων.
                    </p>
                    <p>
                        <b>Βήμα 1: </b> Χρησιμοποίησε τα μπλε βέλη για να σχεδιάσεις τη διαδρομή σου<br/>
                        <b>Βήμα 2: </b> Πάτα το πράσινο κουμπί "ΞΕΚΙΝΑ"<br/>
                        <b>Βήμα 3: </b> Αν πέρασες από τις εικόνες που πρέπει να πας παίρνεις πόντους<br/>
                    </p>
                    <p>
                        <b>Προσοχή!</b>
                        <ul>
                            <li>Κάθε φορά έχεις μία ευκαιρία να φτιάξεις ολόκληρη τη διαδρομή.</li>
                            <li>Απαγορεύεται να χτυπήσεις στις άκρες ή να ξυπνήσεις το σκυλο!</li>
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
            //disableArrows();
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
        var questions = [];
        var visited = [];
        var patternSize = {{ $size }};
        var collision = 0;
        var counter = 0;
        var todo = 0;
        var score = 0;
        var totalscore = 0;
        var plan = {{ $plan->id }};
        var userId = {{ Auth::user()->id }}
        var totalQuestions = {{ sizeof($questions) }};
        var isSameSet = function( arr1, arr2 ) {
            return  $( arr1 ).not( arr2 ).length === 0 && $( arr2 ).not( arr1 ).length === 0;
        }

        var completedQuestions = 0;

        @foreach($pattern as $pat)
            @if($pat->player == true)
                var player = {{ $pat->id }}
            @endif
        @endforeach

        @foreach($blocked as $block)
            blocks.push({{ $block }});
        @endforeach
        @foreach($questions as $question)
            questions.push({{ $question }});
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
                console.log('hit');
                endGame();
            } else {
                movePlayer(moves[counter], counter);
                counter++;
                console.log("player is at"+player);
                if (counter < moves.length && collision != 1) {
                    // check if we are on a special place
                    if(questions.includes(player)) {
                        $("#pos"+player+"e").html("");
                       visited.push(player);
                    } // if the player is in a place where a symbol is
                    setTimeout(printCounter, 900);
                } else if(collision == 1) {
                    $("#collisionModal").modal('show');
                    endGame();
                } else {
                    // if visited is the same as questions
                    if(questions.includes(player)) {
                        $("#pos"+player+"e").html("");
                        visited.push(player);
                    } // if the player is in a place where a symbol is

                    // var result = isSameSet(visited, questions);
                    var result = visited.length;

                    if(result > 0) {
                        score = result * 100;

                        $('#currentMoves').html(moves.length);
                        $('#currentVisited').html(visited.length);
                        $("#currentPoints").html(score);
                        submitScore(score, plan, userId, moves.length);
                        $("#score").html(score);
                        $("#correctPlaceModal").modal('show');
                        $('#pos'+currentQuestion).css('background-color', 'white');
                    } else {
                        if(collision == 1) {
                            $("#collisionModal").modal('show');
                            endGame();
                        } else {
                            $("#incorrectPlaceModal").modal('show');
                        }
                    }
                    endGame();
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
                    }
                    break;
                case "D":
                    todo = player + patternSize;
                    if(todo < 0 || todo > patternSize*patternSize || blocks.includes(todo)) {
                        collision = 1;
                    }
                    break;
                case "R":
                    todo = player + 1;
                    if(todo < 0 || todo > patternSize*patternSize || player%patternSize==0 || blocks.includes(todo)) {
                        collision = 1;
                    }
                    break;
                case "L":
                    todo = player - 1;
                    if(todo < 0 || todo > patternSize*patternSize || player%patternSize==1 || blocks.includes(todo)) {
                        collision = 1;
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

        function endGame() {
            //check what happens
                $("#collisionModal").on('hidden.bs.modal', function(e) {
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

    </script>
@endsection

@section('footer')
    Images on this level <a href="http://www.freepik.com">Designed by macrovector / Freepik</a>
@endsection
