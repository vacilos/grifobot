<?php

namespace App\Http\Controllers;

use App\Math;
use App\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
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

        $mathQuestions = Math::where('level', $level)->orderBy(\DB::raw('RAND()'))->take(10)->get();
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
    public function play(Plan $plan)
    {
        $pattern = $plan->code;
        $pattern = json_decode($pattern);
        $size = $plan->size;
        $level = $plan->level;
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
        //
        return view('plans.play', compact('pattern', 'size', 'blocked', 'plan', 'questions'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function playKinder(Plan $plan)
    {
        $pattern = $plan->code;
        $pattern = json_decode($pattern);
        $size = $plan->size;
        $level = $plan->level;
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
        //
        return view('plans.play_kinder', compact('pattern', 'size', 'blocked', 'plan', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }

    /**
     * start and play
     */
    public function startPlan($size, $level) {
        //
        $size = $size;
        $level = $level;
        $pattern = array();

        $mathQuestions = Math::where('level', $level)->orderBy(\DB::raw('RAND()'))->take(10)->get();
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

        return redirect(route('play_plan', ['plan' => $finalPlan->id]));
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
}
