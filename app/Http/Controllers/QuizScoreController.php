<?php

namespace App\Http\Controllers;

use App\Plan;
use App\QuizScore;
use App\Score;
use App\User;
use Illuminate\Http\Request;

class QuizScoreController extends Controller
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
     * @param  \App\QuizScore  $quizScore
     * @return \Illuminate\Http\Response
     */
    public function show(QuizScore $quizScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizScore  $quizScore
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizScore $quizScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuizScore  $quizScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizScore $quizScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuizScore  $quizScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizScore $quizScore)
    {
        //
    }

    public function record(Request $request) {
        $quiz = $request->quiz;
        $user = $request->username;
        $score = $request->score;
        $movements = $request->movements;

        $quizObj = Plan::find($quiz);
        if($quizObj == null) {
            return response()->json(['answer' => "Δε βρέθηκε το ΚΟΥΙΖ"]);
        }

        $existingScore = QuizScore::where('username', $user)->where('quiz_id', $quizObj->id)->first();

        if($existingScore == null) {
            $existingScore = new QuizScore();
            $existingScore->username = $user;
            $existingScore->quiz_id = $quizObj->id;
            $existingScore->questions = 0;
        }

        if($score > 900 || $score < 0) {
            return response()->json(['answer' => "Προσπάθεια κλοπής"]);
        }
        $existingScore->score = $score;
        $existingScore->movements = $movements;

        $existingScore->questions = $existingScore->questions+1;

        $existingScore->save();

        return response()->json(['answer' => "Γράφτηκε το σκορ $score με $movements κινήσεις."]);

    }
}
