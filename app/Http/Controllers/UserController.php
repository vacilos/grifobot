<?php

namespace App\Http\Controllers;

use App\Math;
use App\Score;
use Illuminate\Http\Request;
use Auth;
use App\Municipality;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user->avatar === null || $user->level === null || $user->municipality === null) {
           return redirect()->route('user_create_profile');
        }

        $scores = Score::where('user_id', $user->id)->orderby('updated_at', 'desc')->take(5)->get();
        $total = 0;
        $count = sizeof($scores);
        foreach($scores as $score) {
            $total+= $score->score;
        }

        // otherscores
        $otherscores = Score::where('user_id', '!=', $user->id)->join('plans', 'plans.id','=','scores.plan_id')->where('plans.level',$user->level)->orderby('plans.updated_at', 'desc')->take(6)->get();

        return view('home', compact('total', 'count', 'scores', 'otherscores'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function games()
    {
        $user = Auth::user();

        if($user->avatar === null || $user->level === null || $user->municipality === null) {
           return redirect()->route('user_create_profile');
        }

        $games = \DB::table('scores')->where('user_id', $user->id)->orderby('updated_at', 'desc')->paginate(15);

        $scores = Score::where('user_id', $user->id)->orderby('updated_at', 'desc')->take(10)->get();
        $total = 0;
        $count = sizeof($scores);
        foreach($scores as $score) {
            $total+= $score->score;
        }

        return view('user.games', compact('games','total', 'count', 'scores'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createProfile()
    {
        $municipalities = Municipality::orderBy('municipality', 'asc')->get();

        return view('user.createprofile', compact('municipalities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProfile(Request $request)
    {
        //
        //
        $validatedData = $request->validate([
            'level' => 'required',
            'municipality' => 'required',
            'avatar' => 'required',
        ]);

        $user = Auth::user();
        $user->level = $request->level;
        $user->municipality_id = $request->municipality;
        $user->avatar = $request->avatar;

        $user->save();

        return redirect(route('user_home'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeProfile()
    {
        $municipalities = Municipality::orderBy('municipality', 'asc')->get();

        return view('user.updateprofile', compact('municipalities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        //
        //
        $validatedData = $request->validate([
            'level' => 'required',
            'municipality' => 'required',
            'avatar' => 'required',
        ]);

        $user = Auth::user();
        $user->level = $request->level;
        $user->municipality_id = $request->municipality;
        $user->avatar = $request->avatar;

        $user->save();

        return redirect(route('user_home'));
    }



}
