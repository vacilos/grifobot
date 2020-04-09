<?php

namespace App\Http\Controllers;

use App\Challenge;
use Auth;
use App\User;
use Illuminate\Http\Request;

class ChallengeController extends Controller
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
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        //
    }

    public function challengeFriend(Request $request) {
        $from_user = Auth::user();
        $to_user = $request->username;
        $plan = $request->plan;

        $findUser = User::where('name', '=', $to_user)->orWhere('email', '=', $to_user)->first();

        if($findUser == null) {
            return response()->json(['code' => -1, 'answer' => "Δε βρέθηκε χρήστης με αυτά τα στοιχεία"]);
        }

        $challengeExists = Challenge::where('to_user_id', $findUser->id)->where('read','=','0')->where('plan_id', $plan)->first();
        if($challengeExists != null) {
            return response()->json(['code' => -1, 'answer' => "Έχεις ήδη στείλει challenge γι αυτή την πίστα που ο παίκτης δεν έχει δει ακόμα!"]);
        }

        $challenge = new Challenge();
        $challenge->from_user_id = $from_user->id;
        $challenge->to_user_id = $findUser->id;
        $challenge->plan_id = $plan;
        $challenge->read = false;

        $challenge->save();

        return response()->json(['code' => 1, 'answer' => "Το challenge στάλθηκε στον παίκτη με στοιχεία $to_user. Πες του να κάνει είσοδο στο σύστημα για να το δει."]);

    }
}
