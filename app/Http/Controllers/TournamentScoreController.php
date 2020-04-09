<?php

namespace App\Http\Controllers;

use App\Plan;
use App\TournamentScore;
use App\Tournament;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TournamentScoreController extends Controller
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
     * @param  \App\TournamentScore  $tournamentScore
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentScore $tournamentScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TournamentScore  $tournamentScore
     * @return \Illuminate\Http\Response
     */
    public function edit(TournamentScore $tournamentScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TournamentScore  $tournamentScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TournamentScore $tournamentScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TournamentScore  $tournamentScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentScore $tournamentScore)
    {
        //
    }


    public function recordScore(Request $request) {
        $plan = $request->plan;
        $user = $request->userId;
        $score = $request->score;
        $movements = $request->movements;
        $tournament = $request->tournament;
        $game = $request->game;

        $planObj = Plan::find($plan);
        if($planObj == null) {
            return response()->json(['answer' => "Δε βρέθηκε το πλάνο"]);
        }
        $userObj = User::find($user);
        if($userObj == null || $userObj->id != Auth::user()->id) {
            return response()->json(['answer' => "Δε βρέθηκε ο χρήστης"]);
        }
        $tournamentObj = Tournament::find($tournament);
        if($tournamentObj == null) {
            return response()->json(['answer' => "Δε βρέθηκε το τουρνουά"]);
        }

        $existingScore = TournamentScore::where('user_id', $userObj->id)->where('tournament_id', $tournamentObj->id)->where('game', $game)->first();

        if($existingScore == null) {
            return response()->json(['answer' => "Δε βρέθηκε το σκορ"]);
        }

        if($score > 900 || $score < 0) {
            return response()->json(['answer' => "Προσπάθεια κλοπής"]);
        }
        $existingScore->score = $score;
        $existingScore->movements = $movements;

        $existingScore->save();

        return response()->json(['answer' => "Γράφτηκε το σκορ $score με $movements κινήσεις."]);

    }

}
