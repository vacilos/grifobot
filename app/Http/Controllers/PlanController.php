<?php

namespace App\Http\Controllers;

use App\Math;
use App\Plan;
use App\Score;
use App\Town;
use App\Person;
use Auth;
use Illuminate\Http\Request;

class PlanController extends Controller
{


    public function init(Request $request, Town $town) {
        // get the username from a cookie
        $username = null;
        if($request->session()->exists("grif1821_user")) {
            $username = $request->session()->get("grif1821_user");
        }

        if($username === null) {
            return redirect(route('plan_login', ['town' => $town->id]));
        }

        $stats = Score::selectRaw('sum(score) as totalScore, people.username as username')
            ->join('people', 'people.id', '=', 'scores.person_id')
            ->join('plans', 'scores.plan_id', 'plans.id')
            ->where('plans.level', '=', 1)
            ->where('plans.town_id', '=', $town->id)
            ->groupBy('people.username')
            ->orderBy('totalScore', 'desc')
            ->take(10)
            ->get();
        $statsΜ = Score::selectRaw('sum(score) as totalScore, people.username as username')
            ->join('people', 'people.id', '=', 'scores.person_id')
            ->join('plans', 'scores.plan_id', 'plans.id')
            ->where('plans.level', '=', 2)
            ->where('plans.town_id', '=', $town->id)
            ->groupBy('people.username')
            ->orderBy('totalScore', 'desc')
            ->take(10)
            ->get();
        $statsΗ = Score::selectRaw('sum(score) as totalScore, people.username as username')
            ->join('people', 'people.id', '=', 'scores.person_id')
            ->join('plans', 'scores.plan_id', 'plans.id')
            ->where('plans.level', '=', 3)
            ->where('plans.town_id', '=', $town->id)
            ->groupBy('people.username')
            ->orderBy('totalScore', 'desc')
            ->take(10)
            ->get();

        $user = Person::where('username', $username)->first();
        if(!$user) {
            return redirect(route('plan_login', ['town' => $town->id]));
        }

        $stat = Score::selectRaw('sum(score) as totalScore')
            ->join('people', 'people.id', '=', 'scores.person_id')
            ->where('people.id', '=', $user->id)
            ->first();

        return view('revolution.init', ['town' => $town, 'username' => $username, 'stats' => $stats, 'statsΜ' => $statsΜ, 'statsH' => $statsΗ, 'userstat' => $stat]);
        // we may proceed
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = \DB::table('plans')->paginate(15);

        return view('plans.index', ['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('plans.create');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function designStart()
    {
        //
        return view('plans.designstart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function design(Request $request)
    {
        // define pattern
        $validatedData = $request->validate([
            'level' => 'required',
            'size' => 'required',
        ]);


        $level = $request->level;
        $size = $request->size;
        //
        return view('plans.design', compact('level', 'size'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // define pattern
        $validatedData = $request->validate([
            'level' => 'required',
            'size' => 'required',
        ]);

        //
        $size = $request->size;
        $level = $request->level;
        $pattern = array();

        $mathQuestions = Math::where('level', $level)->where('personal',0)->orderBy(\DB::raw('RAND()'))->take(10)->get();
        $mathQuestionsArray = $mathQuestions->toArray();

        // define blocked
        $quantity_blocked = ceil($size*$size/7);
        $quantity_maths = ceil($size*$size/4);
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

        $finalPlan = new Plan();
        $finalPlan->size = $size;
        $finalPlan->level = $level;
        $finalPlan->code = json_encode($pattern);

        $finalPlan->save();

        return redirect(route('plans.index'));
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function play(Request $request, Plan $plan, $town)
    {
        $username = null;
        if($request->session()->exists("grif1821_user")) {
            $username = $request->session()->get("grif1821_user");
        }

        if($username === null) {
            return redirect(route('plan_login', ['town' => $town->id]));
        }

        $person = Person::where('username', $username)->first();
        if($person == null) {
            return redirect(route('plan_login', ['town' => $town->id]));
        }
        $pattern = $plan->code;
        $pattern = json_decode($pattern);
        $size = $plan->size;

        $town = Town::find($town);

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

        $user = Person::where('username', $username)->first();
        if(!$user) {
            return redirect(route('plan_login', ['town' => $town->id]));
        }

        $userstat = Score::selectRaw('sum(score) as totalScore')
            ->join('people', 'people.id', '=', 'scores.person_id')
            ->where('people.id', '=', $user->id)
            ->first();

        return view('plans.play_revolution', compact('pattern', 'size', 'blocked', 'plan', 'questions', 'town', 'person', 'userstat'));
    }
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Plan  $plan
//     * @return \Illuminate\Http\Response
//     */
//    public function playKinder(Plan $plan)
//    {
//        $pattern = $plan->code;
//        $pattern = json_decode($pattern);
//        $size = $plan->size;
//        $level = $plan->level;
//        $blocked = array();
//        $questions = array();
//        foreach($pattern as $pat) {
//            if($pat->blocked == true) {
//                array_push($blocked, $pat->id);
//            }
//            if($pat->math == true) {
//                array_push($questions, $pat->id);
//            }
//        }
//        //
//        return view('plans.play_kinder', compact('pattern', 'size', 'blocked', 'plan', 'questions'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Plan  $plan
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Plan $plan)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Plan  $plan
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Plan $plan)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Plan  $plan
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Plan $plan)
//    {
//        //
//    }

    /**
     * start and play
     */
    public function startPlan($level,  $town) {
        //
        $town = $town;

        $questions  = 8;
        $pattern = array();
        $size = 5;
        switch($level) {
            case 2:
                $size = 6;
                $questions = 12;
                break;
            case 3:
                $size = 7;
                $questions = 15;
                break;
            default:
                $size = 5;
                break;
        }

        $town = Town::find($town);

        $townQuestions = floor(0.5*$questions);

        // get generic questions;
        $mathQuestions = Math::where('level', $level)->where('town_id',null)->orderBy(\DB::raw('RAND()'))->take($questions)->get();
        $mathQuestionsArray = $mathQuestions->toArray();

        // get town questions
        $mathQuestionsTown = Math::where('town_id','=',$town->id)->orderBy(\DB::raw('RAND()'))->take($townQuestions)->get();
        $mathQuestionsTownArray = $mathQuestionsTown->toArray();

        // check how many questions are left after we get the questions of the town (maybe they are fewer than expected!)
        $questionsLeft = $questions - sizeof($mathQuestionsTownArray);
        $mathQuestionsArraySelect = array_slice($mathQuestionsArray, 0, $questionsLeft);

        // form the final questions table!
        $mathQuestionsFinal = array_merge($mathQuestionsTownArray, $mathQuestionsArraySelect);


        // define blocked
        $quantity_blocked = ceil($size*$size/7);
        $quantity_maths = ceil($size*$size/4);
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
                $pattern[$i]['matheq'] = $mathQuestionsFinal[$index]['id'];
                $index++;
            }
            if(in_array($i, $player)) {
                $pattern[$i]['player'] = true;
            }
        }

        $finalPlan = new Plan();
        $finalPlan->size = $size;
        $finalPlan->town_id = $town->id;
        $finalPlan->code = json_encode($pattern);
        $finalPlan->level = $level;

        $finalPlan->save();

        return redirect(route('play_plan', ['plan' => $finalPlan->id, 'town' => $town]));
    }

    public function startExPlan(Request $request, $level, Town $town) {

        $username = $request->session()->get('grif1821_user');

        if($username === null) {
            return redirect(route('plan_login', ['town' => $town->id]));
        }

        $person = Person::where('username', $username)->first();

        $userScores = Score::where('person_id', $person->id)->get()->pluck('plan_id');

        $newPlan = Plan::where('level','=',$level)->where('town_id','=', $town)->whereNotIn('id', $userScores)->orderBy(\DB::raw('RAND()'))->first();

        if($newPlan == null) {
            return redirect(route('start_plan', ['level' => $level, 'town' => $town]));
        }

        return redirect(route('play_plan', ['plan' => $newPlan->id, 'town' => $town]));
    }

    public function startPlanKinder($size, $level, $diff) {
        //
        $size = $size;
        $level = $level;
        $pattern = array();

        // define blocked
        $quantity_blocked = ceil($size*$size/7);

        $quantity_maths = $diff;
        $math_images = range(1, 9);
        shuffle($math_images);

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
                $pattern[$i]['matheq'] = $math_images[$index];
                $index++;
            }
            if(in_array($i, $player)) {
                $pattern[$i]['player'] = true;
            }
        }

        $finalPlan = new Plan();
        $finalPlan->size = $size;
        $finalPlan->level = $level;
        $finalPlan->code = json_encode($pattern);

        $finalPlan->save();

        return redirect(route('play_plan_kinder', ['plan' => $finalPlan->id]));
    }

    public function planDetails(Plan $plan) {

        $scores = Score::where('plan_id', '=', $plan->id)->orderBy('score','DESC')->get();

        return view('plans.details', compact('scores', 'plan'));

    }

}
