<?php

namespace App\Http\Controllers;

use App\Math;
use App\Plan;
use App\Quiz;
use App\QuizScore;
use App\Score;
use App\TournamentScore;
use Auth;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function questions(Quiz $quiz)
    {
        //
        return view('quiz.questions', ['quiz' => $quiz]);
    }

    public function playName(Request $request) {
        $pin = $request->pin;

        $quiz = Quiz::where('pin', '=',$pin)->first();

        if($quiz == null) {
            return redirect(route('quiz_play_start', array('pin'=>$pin, 'message'=>'Δεν υπάρχει ΚΟΥΙΖ με αυτό το PIN')));
        }

        return view('quiz.name', compact('quiz', 'pin'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function play(Request $request)
    {
        $username = $request->username;
        $quizId = $request->quiz;

        $quiz = Quiz::find($quizId);

        if($quiz == null) {
            return redirect(route('quiz_play_start', array('message'=>'Παρουσιάστηκε πρόβλημα με το ΚΟΥΙΖ')));
        }

        // find scores with that username!
        $existing = QuizScore::where('username', $username)->where('quiz_id', $quiz->id)->first();
        if($existing != null) {
            return redirect(route('quiz_play_start', array('pin'=>$quiz->pin, 'message'=>'Υπάρχει ήδη παίκτης με αυτό το όνομα')));

        }


        $pattern = $quiz->code;
        $pattern = json_decode($pattern);

        $size = $quiz->size;
        $level = $quiz->level;
        $blocked = array();
        $questions = array();
        foreach($pattern as $pat) {
            if($pat->blocked == true) {
                array_push($blocked, $pat->id);
            }
            if($pat->math == true) {
                array_push($questions, $pat->id);
            }
        }
        // create a zero score
        $quizScore = new QuizScore();
        $quizScore->quiz_id = $quiz->id;
        $quizScore->username = $username;
        $quizScore->score = 0;
        $quizScore->movements = 0;
        $quizScore->questions = 0;
        $quizScore->save();

        //
        return view('quiz.play', compact('pattern', 'size', 'blocked', 'quiz', 'questions', 'username'));
    }

    public function myQuizzes() {
        $user = Auth::user();
        $quizzes = Quiz::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('quiz.myquiz', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        //
        $validatedData = $request->validate([
            'quizname' => 'required|max:255',
            'quizdesc' => 'nullable',
            'quizlevel' => 'required',
            'quizsize' => 'required',
            'quizexercise' => 'required',
            'quizpublic' => 'required',
            'quizenddate' => 'nullable',
        ]);

        $quiz = new Quiz();
        $quiz->name = $request->quizname;
        $quiz->size = $request->quizsize;
        $quiz->level = $request->quizlevel;
        $quiz->exercise = $request->quizexercise;
        $quiz->user_id = $user->id;
        $quiz->public = $request->quizpublic;
        $quiz->end_date = ($request->quizdate == NULL)?null:$request->quizdate;
        $quiz->description = ($request->quizdesc==null)?null:$request->quizdesc;

        $quiz->save();

        return redirect(route('quiz_add_question', ['quiz'=>$quiz, 'question'=>1]));
    }

    public function addQuestion(Quiz $quiz, $question) {

        return view('quiz.addquestion', array('quiz' => $quiz, 'question' => $question));
    }

    public function editQuestion(Quiz $quiz, Math $math) {

        return view('quiz.editquestion', array('quiz' => $quiz, 'math' => $math));
    }

    public function storeQuestion(Quiz $quiz, $question, Request $request) {
        $user = Auth::user();
        //
        $validatedData = $request->validate([
            'mathquestion' => 'required|max:255',
            'mathanswer' => 'required|max:255',
        ]);

        $math = new Math();
        $math->level = $quiz->level;
        $math->question = $request->mathquestion;
        $math->answer = $request->mathanswer;
        $math->answer_alt1 = $request->mathanswer_alt1!=null?$request->mathanswer_alt1:null;
        $math->answer_alt2 = $request->mathanswer_alt2!=null?$request->mathanswer_alt2:null;
        $math->answer_alt3 = $request->mathanswer_alt3!=null?$request->mathanswer_alt3:null;
        $math->answer_alt4 = $request->mathanswer_alt4!=null?$request->mathanswer_alt4:null;

        $math->category_id = 1;
        $math->personal = 1;
        $math->creator_user_id = $user->id;
        $math->updater_user_id = $user->id;
        $math->save();

        $quiz->maths()->attach($math->id);

        if($question == $quiz->exercise) {
            // go to end page
            // create the plan and the pin
            $size = $quiz->size;
            $level = $quiz->level;
            $pattern = array();

            $mathQuestions = $quiz->maths()->get();

            $mathQuestionsArray = $mathQuestions->toArray();

            // define blocked
            $quantity_blocked = ceil($size*$size/5.8);
            $quantity_maths = $quiz->exercise;
            $numbers = range(1, $size*$size);

            // blocked arrays are the arrays without 1!!!
            $numbers_block = range(2, $size*$size);

            do {
                shuffle($numbers_block);
                $blocked = array_slice($numbers_block, 0, $quantity_blocked);

                $free_numbers = array_diff($numbers, $blocked);

                // check if all ok with the blocked

                $start = 1;
                $checked = array();
                $tocheck = array();

                array_push($tocheck, $start);

                do {
                    $current = array_pop($tocheck);

//            echo "<br/>this is ".$current;
                    if(in_array($current, $blocked)) { // if current is blocked continue
//                echo "blocked".$current;
                        continue;
                    }
                    if(in_array($current, $checked)) { // if already checked continue
//                echo "<br/>already checked".$current;
                        continue;
                    } else {
                        array_push($checked, $current);
                    }

                    // move up
                    $moveu = $current - $size;
                    if( ($moveu <= 0 || $moveu > $size*$size) || in_array($moveu, $blocked) || in_array($moveu, $checked)) {
//                echo "<br/>move up fails";
                        // out of bounds || blocked || already checked
                    } else {
                        array_push($tocheck, $moveu);
                    }
                    // move down
                    $moved = $current + $size;
                    if( ($moved <= 0 || $moved > $size*$size) || in_array($moved, $blocked) || in_array($moved, $checked)) {
//                echo "<br/>move down fails";
                        // out of bounds || blocked || already checked
                    } else {
                        array_push($tocheck, $moved);
                    }
                    // move left
                    $movel = $current - 1;
                    if( ($movel <= 0 || $movel > $size*$size || $current%$size==1) || in_array($movel, $blocked) || in_array($movel, $checked)) {
                        // out of bounds || blocked || already checked
//                echo "<br/>move left fails";
                    } else {
                        array_push($tocheck, $movel);
                    }
                    // move right
                    $mover = $current + 1;
                    if( ($mover <= 0 || $mover > $size*$size  || $current%$size==0) || in_array($mover, $blocked) || in_array($mover, $checked)) {
//                echo "<br/>move right fails";
                        // out of bounds || blocked || already checked
                    } else {
                        array_push($tocheck, $mover);
                    }

                } while(sizeof($tocheck) > 0);

                $all = array_diff($free_numbers, $checked);

            } while(sizeof($all) > 0);

            shuffle($free_numbers);
            $maths = array_slice($free_numbers, 0, $quantity_maths);

            $remain = array_diff($free_numbers, $maths);
            shuffle($remain);
            $player = array_slice($remain, 0, 1);

            $index = 0;

            for($i = 1; $i <= $size*$size; $i++) {

                $pattern[$i]['id'] = $i;
                $pattern[$i]['blocked'] = false;
                $pattern[$i]['player'] = false;
                $pattern[$i]['solved'] = false;
                $pattern[$i]['math'] = "";
                $pattern[$i]['matheq'] = 0;
                if(in_array($i, $blocked)) {
                    $pattern[$i]['blocked'] = true;
                }
                if(in_array($i, $maths)) {
                    $pattern[$i]['math'] = true;
                    $pattern[$i]['matheq'] = $mathQuestionsArray[$index]['id'];
                    $index++;
                }
                if(in_array($i, $player)) {
                    $pattern[$i]['player'] = true;
                }
            }

            $quiz->code = json_encode($pattern);

            $pin = 0;
            do {
                $pin = random_quiz_token(6);
                $checkPin = Quiz::where('pin', $pin)->first();

            } while($checkPin != null);

            $quiz->pin = $pin;

            $quiz->save();

            // redirect to finished
            return redirect(route('quiz_show', ['quiz'=>$quiz]));
        } else {
            $question = $question + 1;
            return redirect(route('quiz_add_question', ['quiz'=>$quiz, 'question'=>$question]));
        }
    }

    public function updateQuestion(Quiz $quiz, Math $math, Request $request) {
        $user = Auth::user();
        //
        $validatedData = $request->validate([
            'mathquestion' => 'required|max:255',
            'mathanswer' => 'required|max:255',
        ]);

        $math->question = $request->mathquestion;
        $math->answer = $request->mathanswer;
        $math->answer_alt1 = $request->mathanswer_alt1!=null?$request->mathanswer_alt1:null;
        $math->answer_alt2 = $request->mathanswer_alt2!=null?$request->mathanswer_alt2:null;
        $math->answer_alt3 = $request->mathanswer_alt3!=null?$request->mathanswer_alt3:null;
        $math->answer_alt4 = $request->mathanswer_alt4!=null?$request->mathanswer_alt4:null;

        $math->save();

        return redirect(route('quiz_questions', ['quiz'=>$quiz->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
        return view('quiz.show', array('quiz'=>$quiz));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
        return view('quiz.edit', array('quiz'=>$quiz));
    }

    /**
     * Update the specified resource in storage.
 *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
        $user = Auth::user();
        //
        $validatedData = $request->validate([
            'quizname' => 'required|max:255',
            'quizdesc' => 'nullable',
            'quizlevel' => 'required',
            'quizpublic' => 'required',
            'quizenddate' => 'nullable',
        ]);

        $quiz->name = $request->quizname;
        $quiz->level = $request->quizlevel;
        $quiz->user_id = $user->id;
        $quiz->public = $request->quizpublic;
        $quiz->end_date = ($request->quizdate == NULL)?null:$request->quizdate;
        $quiz->description = ($request->quizdesc==null)?null:$request->quizdesc;

        $quiz->save();

        return redirect(route('quiz_show', ['quiz'=>$quiz]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    /**
     * ajax call to fetch math id data
     */
    public function question(Request $request) {
        $mathId = $request->id;

        $math = Math::find($mathId);

        $math->question = fix_equation($math->question);
        $math->answer = fix_equation($math->answer);
        $wrong = array();
        if($math->answer_alt1 != null) {
            $wrong[] = $math->answer_alt1;
        }
        if($math->answer_alt2 != null) {
            $wrong[] = $math->answer_alt2;
        }
        if($math->answer_alt3 != null) {
            $wrong[] = $math->answer_alt3;
        }
        if($math->answer_alt4 != null) {
            $wrong[] = $math->answer_alt4;
        }

        if(sizeof($wrong) > 0) {
            $wrong[] = $math->answer;
        }
        shuffle($wrong);

        return response()->json(['question'=>$math->question, 'id'=>$math->id, 'answer' => $math->answer, 'wrong' => $wrong]);
    }

    public function results($pin) {

        $quiz = Quiz::where('pin', $pin)->first();
        if($quiz == null) {
            abort(404);
        }
        $scores = QuizScore::where('quiz_id', $quiz->id)->get();

        $stats = QuizScore::selectRaw('score, movements, questions,  time_to_sec(TIMEDIFF( updated_at, created_at)) as timedifference, username')
            ->where('quiz_id', '=', $quiz->id)
            ->where('score','>',0)
            ->orderBy('score', 'desc')
            ->orderBY('questions', 'desc')
            ->orderBY('movements', 'asc')
            ->orderBY('timedifference', 'asc')
            ->get();

        return view('quiz.results', compact('scores', 'quiz', 'stats'));
    }
    public function resultsTeacher(Quiz $quiz) {

        $stats = QuizScore::selectRaw('score, movements, questions,  time_to_sec(TIMEDIFF( updated_at, created_at)) as timedifference, username')
            ->where('quiz_id', '=', $quiz->id)
            ->orderBy('score', 'desc')
            ->orderBY('questions', 'desc')
            ->orderBY('movements', 'asc')
            ->orderBY('timedifference', 'asc')
            ->get();

        return view('quiz.resultsteacher', ['quiz'=>$quiz, 'stats'=>$stats]);
    }

    public function publicQuiz() {
        $currentDate = new \DateTime();
        $formattedDate = $currentDate->format("Y-m-d H:i:s");

        $quizzes = Quiz::where('public', 1)->where( function ($query) use ($formattedDate) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', $formattedDate);
        })->get();

        return view('quiz.public', compact('quizzes'));


    }
}
