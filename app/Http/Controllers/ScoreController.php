<?php

namespace App\Http\Controllers;

use App\Math;
use App\Score;
use App\Plan;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }

    public function recordScore(Request $request) {
        $plan = $request->plan;
        $user = $request->userId;
        $score = $request->score;
        $movements = $request->movements;

        $planObj = Plan::find($plan);
        if($planObj == null) {
            return response()->json(['answer' => "Δε βρέθηκε το πλάνο"]);
        }
        $userObj = User::find($user);
        if($userObj == null || $userObj->id != Auth::user()->id) {
            return response()->json(['answer' => "Δε βρέθηκε ο χρήστης"]);
        }

        $existingScore = Score::where('user_id', $userObj->id)->where('plan_id', $planObj->id)->first();

        if($existingScore == null) {
            $existingScore = new Score();
            $existingScore->user_id = $userObj->id;
            $existingScore->plan_id = $planObj->id;
            $existingScore->total = 0;
        }

        if($score > 900 || $score < 0) {
            return response()->json(['answer' => "Προσπάθεια κλοπής"]);
        }
        $existingScore->score = $score;
        $existingScore->movements = $movements;

        $existingScore->total = $existingScore->total+1;

        $existingScore->save();

        return response()->json(['answer' => "Γράφτηκε το σκορ $score με $movements κινήσεις."]);

    }
}
