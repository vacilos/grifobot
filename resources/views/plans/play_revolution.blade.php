@extends('layouts.app_1821')

@section('userdata')
    {{ Session::get('grif1821_user')}}: <strong>{{ number_format($userstat->totalScore, 0, ",", ".") }}</strong>
@endsection

@section('menu')
    <a href="{{ route('plan_invalidate', ['town' => $town->id]) }}">Log Out</a>
    <a href="{{ route('plan_init', ['town' => $town]) }}"><i class="fa fa-door-open"></i> Έξοδος</a>
    <a href="{{ route('welcome_town', ['town' => $town->slug]) }}"><i class="fa fa-book"></i> Ιστορία</a>
    <a href="#" onclick="toggleMusic();"><i class="fa fa-music"></i> </a>
    <a href="#" onclick="showHelp();"><i class="fa fa-question-circle"></i> </a>
@endsection

@section('abovetitle')
    <div class="container-fluid">
        <div class="row mt-sm-1">
            <div class="col-sm-6 text-left">
                Καλώς ήρθες <strong> {{ $person->username }}</strong>
            </div>
            <div class="col-sm-6 text-right">


            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mt-sm-1">
            <div class="col-sm-12 text-right">

            </div>
        </div>
    </div>
@endsection
@section('pagetitle')
    <img src="{{ asset("pubimg/pubimg") }}/{{ $plan->town->logo }}" class="img-fluid"/> {{ $plan->town->title }} - Γριφομπότ 1821
@endsection
@section('stylesheet')
    <!-- Scripts -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .btn-info {
            background-color: #5697AA !important;
        }
        .btn-success {
            background-color: #576E50 !important;
        }

        .col {
            padding-top: 8.3333333%;
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
            grid-template-columns: repeat({{$size}}, [col] 7vw);
            grid-template-rows: repeat({{$size}}, [row] 7vw);
            {{--width: {{ 7*$size }}vw;--}}
            /*justify-content: center;*/
            /*align-content: center;*/
            margin: 0 auto;
            /*background-color: #fff;*/
        }

        .grid b {
            font-size: calc(1.5vw);
            padding-top: 0.1vw;
            text-align: center;
            background-image: url("@if( $town->game_background != null) {{asset('pubimg/pubimg')}}/{{$town->game_background}} @else {{asset('images/blank_tile.png')}} @endif");
            background-size:cover;
        }

        .grid b img {
            padding-top:10px;
            max-width: calc(5vw);
        }

        #answer {
            height: calc(2.19rem + 20px);
        }

        body {
            background-color: #fafafa !important;
        }

        .button_answer {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/3.3.1/introjs.min.css" integrity="sha512-631ugrjzlQYCOP9P8BOLEMFspr5ooQwY3rgt8SMUa+QqtVMbY/tniEUOcABHDGjK50VExB4CNc61g5oopGqCEw==" crossorigin="anonymous" />
@endsection
@section('content')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-6">
                <h5 class="manouri">Οδήγησε τον ήρωα στην απελευθέρωση</h5>
                <main class="grid" id="first-show" data-step="2" data-intro="Αρχικά θα πρέπει να επιλέξεις κάποιο τετράγωνο που περιλαμβάνει κάποιον εχθρό και να λύσεις το γρίφο που εμφανίζεται! Αν απαντήσεις σωστά θα εμφανιστεί η εικόνα της απελευθέρωσης!">
                    @foreach($pattern as $pat)
                        <b id="pos{{$pat->id}}" @if($pat->blocked == true)style="background-image: url('@if( $town->game_obstacle != null) {{asset('pubimg/pubimg')}}/{{$town->game_obstacle}} @else {{ asset('images/bomb.png') }} @endif ') !important; background-size:cover"@endif>
                        @if($pat->player == true) <div id="pos{{$pat->id}}p" data-step="1" data-intro="Αυτός είναι ο ήρωας σου!"><img src="@if( $town->game_player != null) {{asset('pubimg/pubimg')}}/{{$town->game_player}} @else {{asset('images/Iosif_Androusis.png')}} @endif" style="overflow: hidden;display:inline;" /></div> @endif
                            @if($pat->math == true) <div id="pos{{$pat->id}}e"><a href="javascript:mathClicked({{$pat->matheq}}, {{$pat->id}});" class="manouri" style="color:firebrick;"><img src="@if( $town->game_question != null) {{asset('pubimg/pubimg')}}/{{$town->game_question}} @else {{asset('images/Imbrahim.png')}} @endif"></a></div> @endif
                        </b>
                @endforeach
                </main>
            </div>
            <div class="col-4">
                <h5>Μετακίνησε</h5>
                <div class="sticky-top" id="second-show" data-step="3" data-intro="Αν απαντήσεις σωστά, θα ενεργοποιηθούν τα βελάκια και θα πρέπει να δημιουργήσεις μια διαδρομή από το σημείο που είναι ο ήρωας προς την εικόνα της ελευθερίας!">
                    <h2 class="text-center manouri"></h2>

                        <button id="bl" onclick="selectedAction('L');" class="btn  btn-info btn-sm" style="height: 2.5em !important;"><i class="fa fa-arrow-left"></i></button>
                        <button id="br" onclick="selectedAction('R');" class="btn  btn-info btn-sm" style="height: 2.5em !important;"><i class="fa fa-arrow-right"></i></button>
                        <button id="bu" onclick="selectedAction('U');" class="btn  btn-info btn-sm" style="height: 2.5em !important;"><i class="fa fa-arrow-up"></i></button>
                        <button id="bd" onclick="selectedAction('D');" class="btn  btn-info btn-sm" style="height: 2.5em !important;"><i class="fa fa-arrow-down"></i></button>
                    <button id="bdel" onclick="clearMoves();" class="btn btn-danger btn-sm float-right" style="height: 2.5em !important;"><i class="fa fa-trash"></i></button>

                    <h5 class="manouri">Κινήσεις </h5>
                    <span id="moves" style="font-size:26px;">

                    </span>
                    <button id="bgo" onclick="go();" class="btn btn-lg btn-block btn-success manouri" data-step="4" data-intro="Αφού σχεδιάσεις σωστά τη διαδρομή πατάς αυτό το κουμπί για να μετακινηθεί ο ήρωας!"> Προχώρησε! &nbsp;<i class="fa fa-walking"></i></button>
                </div>
            </div>
            <div class="col-sm-2" data-step="5" data-intro="Όσο περισσότερες ερωτήσεις απαντήσεις τόσο μεγαλύτερο το ΣΚΟΡ! Πρόσοχη! Το σκορ είναι μεγαλύτερο αν λύσεις το γρίφο με τα λιγότερα δυνατά βήματα (μικρότερη διαδρομή!)">
                <h5>Σκορ</h5>
                <h1><span id="score">0</span></h1>

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
                            <h1>Τελικό σκορ: <span id="endGameScore"></span></h1>
                            <a href="{{ route('plan_init', ['town' => $town]) }}" class="btn btn-success">Επιστροφή</a>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-success" id="exampleModalLabel">ΜΠΡΑΒΟ</h1>
                </div>
                <div class="modal-body">
                    <h3>Η ιστορία λέει:</h3>
                    <p style="font-size: 20px;"><span id="thehistory"></span></p>
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
                    <h1 class="modal-title text-danger" id="exampleModalLabel">ΚΡΙΜΑ</h1>
                </div>
                <div class="modal-body">
                    <h3>Η ιστορία λέει:</h3>
                    <p style="font-size: 20px;"<span id="thehistoryf"></span></p>
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
                    <h3 class="modal-title manouri" id="exampleModalLabel">Οδήγησε τον ήρωα στην απελευθέρωση!</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Βήμα 1: </b> Πάτα σε ένα τετράγωνο που έχει έναν εχθρό <img src="@if( $town->game_question != null) {{asset('pubimg/pubimg')}}/{{$town->game_question}} @else {{asset('images/Imbrahim.png')}} @endif" style="max-width: 30px;" /> για να δεις μία άσκηση<br/>
                        <b>Βήμα 2: </b> Λύσε την άσκηση που θα εμφανιστεί<br/>
                        <b>Βήμα 3: </b> Χρησιμοποίησε τα βελάκια <button class="btn  btn-info btn-sm"><i class="fa fa-arrow-left"></i></button>&nbsp;<button class="btn  btn-info btn-sm"><i class="fa fa-arrow-right"></i></button>&nbsp;<button class="btn  btn-info btn-sm"><i class="fa fa-arrow-up"></i></button>&nbsp;<button class="btn  btn-info btn-sm"><i class="fa fa-arrow-down"></i></button>
για να οδηγήσεις τον ήρωα <img src="@if( $town->game_player != null) {{asset('pubimg/pubimg')}}/{{$town->game_player}} @else {{asset('images/Iosif_Androusis.png')}} @endif" style="max-width: 30px;" /> στο στόχο <img src="{{asset('images/target.png')}}" style="max-width: 30px;" />. Έχεις μια ευκαιρία!<br/>
                    </p>
                    <p>
                        <b>Προσοχή!</b>
                        <ul>
                            <li>Κάθε φορά έχεις μία ευκαιρία να φτάσεις μέχρι το στόχο.</li>
                            <li>Απαγορεύεται να χτυπήσεις στις άκρες ή να πατήσεις τις βόμβες <img src="{{asset('images/bomb.png')}}" style="max-width: 30px;" />!</li>
                            <li>Πρέπει να ακολουθήσεις της συντομότερη διαδρομή!</li>
                        </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <audio id="epicAudio" autoplay loop>
        <source src="{{ asset("sound/epic2.mp3") }}" type="audio/mp3" />
    </audio>

    <audio id="successAudio">
        <source src="{{ asset("sound/success.mp3") }}" type="audio/mp3" />
    </audio>
    <audio id="failAudio">
        <source src="{{ asset("sound/fail.mp3") }}" type="audio/mp3" />
    </audio>

    <span id="footer_msg"></span>
@endsection

@section('javascript')
    <script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/3.3.1/intro.min.js" integrity="sha512-NC1GtvckWJQLUHrSQp5+4ydIv6gW8kfP4Ewrwv8Y1xU1h9GTTaXDTnWl+kjHcZNCaX8ySFNSpPmtt/B4SUaDsQ==" crossorigin="anonymous"></script>

    <script type="text/javascript">

        function isPlaying(audelem)
        {
            return !audelem.paused;
        }


        $(document).ready(function() {
            disableArrows();
            @if($userstat->totalScore < 300)
                introJs().start();
            @endif

            $('#exampleModal').on("shown.bs.modal", function() {
                $('#answer').focus();
            });

            $("#failModal").on('hidden.bs.modal', function(e) {
                $("#thehistoryf").html("");
            });
            $("#successModal").on('hidden.bs.modal', function(e) {
                $("#thehistory").html("");
            });
        });

        function toggleMusic() {
            var x = document.getElementById("epicAudio");
            if(isPlaying(x)) {
                x.pause();
                music = 0;
            } else {
                x.play();
                music = 1;
            }
        }

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
        var username = {{ $person->id }};
        var plan = {{ $plan->id }};
        var music = 1;
        var story = "";
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
                $('#moves').append('<span id=movement'+move+' class="manouri">'+move+'. <i class="fa fa-arrow-left"></i> #Α</span><br/>');
                moves.push('L');
                move++;
            }
            else if(i== "R") {
                $('#moves').append('<span id=movement'+move+' class="manouri">'+move+'.  <i class="fa fa-arrow-right"></i> #Δ</span><br/>');
                moves.push('R');
                move++;
            }
            else if(i== "U") {
                $('#moves').append('<span id=movement'+move+' class="manouri">'+move+'.  <i class="fa fa-arrow-up"></i> #Π</span><br/>');
                moves.push('U');
                move++;
            }
            else if(i== "D") {
                $('#moves').append('<span id=movement'+move+' class="manouri">'+move+'. <i class="fa fa-arrow-down"></i> #Κ</span><br/>');
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
            solvingEquation = 0;
            disableArrows();

            //check if the user is already at the correct place
            if(player == currentQuestion && moves.length == 0) {
                var currentMoves = 0;
                totalmoves += 0;
                score += 100;

                $('#currentMoves').html(currentMoves);
                $("#currentPoints").html(100);
                submitScore(score, plan, username, totalmoves);
                $("#score").html(score);
                $("#correctPlaceModal").modal('show');
                // $('#pos'+currentQuestion).empty();
                $("#target").remove();
                currentQuestion = -10;
            } else if(moves.length == 0) {
                collision = 1;
                $("#incorrectPlaceModal").modal('show');
                // $('#pos'+currentQuestion).empty();
                $("#target").remove();
                currentQuestion = -10;
                clearMoves();
                checkEndGame();
            } else {
                printCounter();
            }


        }

        function printCounter() {
            if(collision == 1) {
                $("#incorrectPlaceModal").modal('show');
                // $('#pos'+currentQuestion).empty();
                $("#target").remove();
                currentQuestion = -10;
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
                        submitScore(score, plan, username, totalmoves);
                        $("#score").html(score);
                        $("#correctPlaceModal").modal('show');
                        // $('#pos'+currentQuestion).empty();
                        $("#target").remove();
                        currentQuestion = -10;

                    } else {
                        $("#incorrectPlaceModal").modal('show');
                        // $('#pos'+currentQuestion).empty();
                        $("#target").remove();
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
                $('#pos'+todo).append('<div id="pos'+todo+'p"><img src="@if( $town->game_player != null) {{asset('pubimg/pubimg')}}/{{$town->game_player}} @else {{asset('images/Iosif_Androusis.png')}} @endif" style="overflow: hidden;display:inline;" /></div>');
                player = todo;
            } else {
                $('#pos'+currentQuestion).css('background-color', 'white');

            }

        }

        function mathClicked(mathId, eq) {
            if(solvingEquation == 1) {
                alert('Λύνεις ακόμα κάποια άσκηση! Μετακινήσου με τα βελάκια πριν πας σε επόμενη!')
                return false;
            }
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
                url:'{{ route('quiz_question') }}',
                data:
                    {
                        id: mathId
                    },
                success:function(data) {
                    // OPEN modal
                    currentAnswer = data.answer;
                    story = data.story;
                    var wrong = data.wrong;
                    if(wrong.length > 0) {
                        //create buttons
                        var buttoncode = "<h5>Διάλεξε τη σωστή απάντηση</h5>";
                        for(var i=0; i<wrong.length; i++) {
                            buttoncode += '<button onclick="submitModal(\''+wrong[i]+'\');" class="btn btn-lg btn-info button_answer" style="font-size: 26px; margin:5px 10px;">'+wrong[i]+'</button>';
                        }
                        $('#answerinmodal').hide();
                        $('#multiplechoiceinmodal').show();
                        $('#multiplechoiceinmodal').html(buttoncode);
                    } else {
                        $('#multiplechoiceinmodal').html("");
                        $('#answerinmodal').show();
                        $('#multiplechoiceinmodal').hide();
                    }
                    if(data.image_path == null) {
                        $("#modalquestion").html(data.question);
                    } else {
                        var elquestion = "<p>"+data.question+"</p><p><img src='{{asset("pubimg/pubimg")}}/"+data.image_path+"' class='img-fluid' style='max-width:600px;max-height:600px;'/></p>";
                        $("#modalquestion").html(elquestion);
                    }

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
                url:'{{ route('person_score') }}',
                data:
                    {
                        score: score,
                        plan: plan,
                        userId: userId,
                        movements: movements
                    },
                success:function(data) {

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

            $('#thehistory').html(story);
            $('#thehistoryf').html(story);
            if(answer == currentAnswer) {
                // enable the keys!
                $("#successModal").modal('show');
                if(music == 1) {
                    var x = document.getElementById("successAudio");
                    x.play();
                    var x = document.getElementById("epicAudio");
                    x.play();
                }

                $('#pos'+currentQuestion).append("<img id='target' src='{{asset('images/target.png')}}' />");

                enableArrows();
            } else {
                solvingEquation = 0;

                // remove the current question
                $("#failModal").modal('show');
                if(music == 1) {
                    var x = document.getElementById("failAudio");
                    x.play();
                    var x = document.getElementById("epicAudio");
                    x.play();
                }

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

            if(completedQuestions == totalQuestions) {

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


        function showHelp() {
            introJs().start();
        }
    </script>
@endsection

@section('footer')

@endsection
