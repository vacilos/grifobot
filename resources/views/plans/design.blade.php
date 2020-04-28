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
            grid-template-columns: repeat({{ $size }}, [col] 7vw);
            grid-template-rows: repeat({{$size}}, [row] 7vw);
            width: {{$size*7}}vw;
            border: 1px solid black ;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
            background-color: #fff;
        }

        .grid b {
            font-size: calc(0.8vw);
            padding-top: 1vw;
            text-align: center;
            border: 1px solid  black;
        }

        .grid b img {
            max-width: calc(5vw);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1>Σχεδιασμός Ταμπλώ</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <main class="grid">
                    @for($i=1; $i <= $size*$size; $i++)
                        <b id="pos{{$i}}" onclick="javascript:bclicked({{$i}});">
                            {{ $i }}
                        </b>
                    @endfor
                </main>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h3 id="infoTitle">
                            Δεν έχει επιλεχθεί κάποιο κουτί
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table-responsive table table-borderless table-striped">
                            <tr>
                                <th>
                                    Κενό
                                </th>
                                <td>
                                    <span id="infoTextEmpty"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Παίκτης
                                </th>
                                <td>
                                    <span id="infoTextUser"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Εμπόδιο
                                </th>
                                <td>
                                    <span id="infoTextBlock"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Αντικείμενο
                                </th>
                                <td>
                                    <span id="infoTextObj"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Μαθηματικά
                                </th>
                                <td>
                                    <span id="infoTextMath"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group-lg" role="group" aria-label="Basic example">
                            <button class="btn btn-info" onclick="javascript:setEmpty();" title="Κενό"><i class="fa fa-square-o"></i></button>
                            <button class="btn btn-success" onclick="javascript:setUser();" title="Παίκτης"><i class="fa fa-user"></i></button>
                            <button class="btn btn-danger" onclick="javascript:setBlock();" title="Εμπόδιο"><i class="fa fa-ban"></i></button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#objectModal" title="Αντικείμενο"><i class="fa fa-gift"></i></button>
                            <button class="btn btn-dark" data-toggle="modal" data-target="#mathModal" title="Άσκηση"><i class="fa fa-calculator"></i> </button>
                            <button class="btn btn-primary" data-toggle="collapse" data-target="#winObjectives" aria-expanded="false" aria-controls="winObjectives" title="Σύνθετες συνθήκες νίκης"><i class="fa fa-trophy"></i> </button>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="winObjectives">
                    <div class="card">
                        <div class="card-header">
                            <h4>Σύνθετες συνθήκες Νίκης</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                Να απαντηθούν σωστά
                                <select name="winAnswers">
                                    @for($i = 0; $i <= $size*$size; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                ερωτήσεις
                                <button class="btn btn-success btn-sm" onclick="javascript:setWinAnswers();"><i class="fa fa-plus"></i></button>
                            </div>
                            <div>
                                <hr/>
                                Ο παίκτης να βρεθεί στη θέση:
                                <select name="winPlayerPosition">
                                    @for($i = 1; $i <= $size*$size; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button class="btn btn-success btn-sm" onclick="javascript:setWinAnswers();"><i class="fa fa-plus"></i></button>

                            </div>
                            <div>
                                <hr/>
                                Ο παίκτης να βρεθεί στο αντικείμενο:
                                <select name="playerObject" class="objectList">
                                </select>
                                <button class="btn btn-success btn-sm" onclick="javascript:setWinAnswers();"><i class="fa fa-plus"></i></button>

                            </div>
                            <div>
                                <hr/>
                                Το αντικείμενο:
                                <select name="winObject" class="objectList">

                                </select>
                                να βρεθεί στη θέση:
                                <select name="winObjectPosition">
                                    @for($i = 1; $i <= $size*$size; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button class="btn btn-success btn-sm" onclick="javascript:setWinAnswers();"><i class="fa fa-plus"></i></button>

                            </div>
                            <div>
                                <hr/>
                                Το αντικείμενο:
                                <select name="winObjectOn" class="objectList">

                                </select>
                                να βρεθεί πάνω στο αντικείμενο:
                                <select name="winObjectOnObject" class="objectList">

                                </select>
                                <button class="btn btn-success btn-sm" onclick="javascript:setWinAnswers();"><i class="fa fa-plus"></i></button>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="{{ route('design_store') }}">
                    @csrf
                    <textarea name="code"></textarea>
                    <button type="submit" class="btn btn-success">Δημιουργία</button> <a href="{{route('maths.index')}}" class="btn btn-default">Επιστροφή</a>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="objectModal" tabindex="-1" role="dialog" aria-labelledby="objectModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="objectModal">Προσθήκη Αντικειμένου</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="objectName">Όνομα</label>
                        <input type="text" name="objectName" class="form-control" id="objectName" aria-describedby="namehelp" placeholder="Γράψτε το όνομα του αντικειμένου">
                        <small id="namehelp" class="form-text text-muted">Καταγράψτε ένα όνομα του αντικειμένου (π.χ. ΣΚΥΛΟΣ)</small>
                    </div>
                    <div class="form-group">
                        <label for="objectName">Δύναμη</label>
                        <input type="text" name="objectPower" class="form-control" id="objectPower" aria-describedby="powerhelp" placeholder="Δύναμη για να μετακινηθεί">
                        <small id="powerhelp" class="form-text text-muted">Γράψτε πόση δύναμη χρειάζεται το αντικείμενο για να μετακινηθεί 0: δεν καταναλώνει δύναμη, -1: δεν μετακινείται</small>
                    </div>
                    <div class="form-group">
                        <label for="objectPoints">Πόντοι</label>
                        <input type="text" name="objectPoints" class="form-control" id="objectPoints" aria-describedby="pointhelp" placeholder="Πόντοι που κερδίζεις αν το πατήσεις">
                        <small id="pointhelp" class="form-text text-muted">Γράψτε πόσους πόντους κερδίζει κάποιος όταν το πατήσει</small>
                    </div>
                    <div class="form-group">
                        <label for="objectPoints">Ενέργεια</label>
                        <input type="text" name="object;Energy" class="form-control" id="Energy" aria-describedby="energyhelp" placeholder="Πόντοι που κερδίζεις αν το πατήσεις">
                        <small id="energyhelp" class="form-text text-muted">Γράψτε πόση ενέργεια κερδίζει ο παίκτης όταν το πατήσει</small>
                    </div>
                    <div class="form-group">
                        <label for="objectImage">Εικόνα</label>
                        <select name="objectImage" id="objectImage" size="1" aria-describedby="levelhelp" class="form-control">
                            <option value="1">Εικόνα 1</option>
                            <option value="2">Εικόνα 2</option>
                            <option value="3">Εικόνα 3</option>
                        </select>
                        <small id="levelhelp" class="form-text text-muted">Διαλέξτε μια εικόνα για το αντικείμενο (default image: ΚΟΥΤΙ)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="javascript:setObject();">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mathModal" role="dialog" aria-labelledby="mathModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="objectModal">Προσθήκη Άσκησης</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mathName">Άσκηση</label>
                        <select id="mathName" name="mathName" class="form-control-lg">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="javascript:setMath();">Πάμε!</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("javascript")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#mathName').select2({
                placeholder: 'Διαλέξτε μία άσκηση',
                minimumInputLength: 2,
                ajax: {
                    delay: 250,
                    url: '{{route('maths_select')}}',
                    dataType: 'json'
                }
            });

        });

        var active = 0; // what is the active cell
        var objectIds = 1;
        var size = {{ $size*$size }};
        var tableau = [];
        tableau = {
            "name": "Λύσε το γρίφο με τις λιγότερες κινήσεις",
            "description": "Προσπάθησε να πας σε όλα τα τετράγωνα κάνοντας όσο πιο λίγες κινήσεις μπορείς",
            "userPower": -1, // Η δύναμη που θα έχει ο παίκτης όταν ξεκινάει
        };
        var objects = [];
        @for($k = 1; $k <= $size*$size; $k++)
            var id = "id"+{{$k}};
            tableau[{{ $k }}] = {
                'id': id,
                'name': "Anonymous",
                'empty': true,
                'user': false,
                'block': false,
                'object': false,
                'math': false,
                'pickable': false,
                'matheq': 0
            }
        @endfor
        function bclicked(i) {
            active = i;
            $('#infoTitle').html("Κουτί: "+i);
            $('#infoTextEmpty').html(tableau[i].empty);
            $('#infoTextUser').html(tableau[i].user);
            $('#infoTextBlock').html(tableau[i].block);
            $('#infoTextMath').html(JSON.stringify(tableau[i].mathobj));
            $('#infoTextObj').html(JSON.stringify(tableau[i].object));
        }

        function setUser() {
            if(active == 0) {
                alert('nothing selected');
            } else {
                clearUserPlace();
                $('#pos'+active).css('background-color', 'green');
                clearAll();
                tableau[active].user = true;

                bclicked(active);
            }

        }
        function setBlock() {
            if(active == 0) {
                alert('nothing selected');
            } else {
                $('#pos'+active).css('background-color', 'red');
                clearAll();
                tableau[active].block = true;
                bclicked(active);
            }
        }
        function setObject() {
            if(active == 0) {
                alert('nothing selected');
            } else {
                var objectName = $("#objectName").val();
                var objectPower = $("#objectPower").val();
                var objectPoints = $("#objectPoints").val();
                var objectImage = $("#objectImage").val();
                $('#pos'+active).css('background-color', 'yellow');
                // clear anything else in the field
                clearAll();

                // add the tableau code
                tableau[active].object = {"id": "obj"+objectIds, "name": objectName, "power": objectPower,"points": objectPoints, "image": objectImage};

                // add to the array of objects
                objects["obj"+objectIds] = objectName;

                // add to the object list
                $(".objectList").append("<option value='obj"+active+"'>"+objectName +"["+active+"]</option>")
                objectIds++

                bclicked(active);
            }

        }
        function setMath() {
            if(active == 0) {
                alert('nothing selected');
            } else {

                var mathId = $("#mathName" ).val();
                var mathEq = $("#mathName option:selected" ).text();

                $('#pos'+active).css('background-color', 'grey');
                clearAll();
                tableau[active].math = true;
                tableau[active].mathobj = {"id": mathId, "eq": mathEq};

                bclicked(active);
            }

        }
        function setEmpty() {
            if(active == 0) {
                alert('nothing selected');
            } else {
                $('#pos'+active).css('background-color', 'white');
                clearAll();
                bclicked(active);
            }

        }

        function clearUserPlace() {
            for(i = 1; i<=size; i++) {
                if(tableau[i].user == true) {
                    $('#pos'+i).css('background-color', 'white');
                    tableau[i].user = false;
                }

            }
        }

        function clearAll() {
            tableau[active].user = false;
            tableau[active].block = false;
            tableau[active].object = false;
            if (objects["obj"+active] !== 'undefined') {
                // your code here
                delete objects["obj"+active];
                $(".objectList option[value='obj"+active+"']").remove();

            }
            tableau[active].empty = false;
            tableau[active].math = false;
            tableau[active].matheq = 0;
            tableau[active].power = 0;
        }
    </script>
@endsection
