<?php

namespace App\Http\Controllers;

use App\Category;
use App\Math;
use App\Plan;
use App\Score;
use App\Tournament;
use App\TournamentPlan;
use App\TournamentScore;
use App\User;
use Illuminate\Http\Request;
use Auth;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $tournaments = \DB::table('tournaments')->orderBy('start_date', 'desc')->paginate(15);

        return view('tournament.index', compact('tournaments'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTournament()
    {
        $user = Auth::user();

        $datetimeNow = new \DateTime('now');
        $date = $datetimeNow->format("Y-m-d");
        $time = $datetimeNow->format("H:i");
        $tournaments = \DB::select(\DB::raw("SELECT * from tournaments where level = :level AND ((start_date = :date AND end_time < :time) OR start_date < :date2)"), array("level"=>$user->level,"date"=>$date, "time"=>$time,"date2"=>$date));

        return view('tournament.list', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        //
        return view('tournament.create', compact('categories'));
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
        $validatedData = $request->validate([
            'category' => 'required',
            'level' => 'required',
            'name' => 'required|max:255',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $tournament = new Tournament();
        $tournament->category_id = $request->category;
        $tournament->level = $request->level;
        $tournament->name = $request->name;
        $tournament->start_date = $request->start_date;
        $tournament->start_time = $request->start_time;
        $tournament->end_time = $request->end_time;
        $tournament->active = $request->active!=null?$request->active:1;

        $tournament->save();

        // attach plans to tournament
        // fetch plans for each class
        $plans = Plan::where('level', $tournament->level)->orderBy(\DB::raw('RAND()'))->take(6)->get();
        $index = 1;

        $tournament->plans()->sync($plans);

        foreach($plans as $plan) {
            $attr = ['order' => $index];

            $tournament->plans()->updateExistingPivot($plan, $attr);
            $index++;
        }

        return redirect(route('tournaments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        //
        $categories = Category::all();
        //
        return view('tournament.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        //
        $validatedData = $request->validate([
            'category' => 'required',
            'level' => 'required',
            'name' => 'required|max:255',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $tournament->category_id = $request->category;
        $tournament->level = $request->level;
        $tournament->name = $request->name;
        $tournament->start_date = $request->start_date;
        $tournament->start_time = $request->start_time;
        $tournament->end_time = $request->end_time;
        $tournament->active = $request->active!=null?$request->active:1;

        $tournament->save();

        return redirect(route('tournaments.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        //
    }

    public function startTournament(Tournament $tournament) {
        return view('tournament.start', compact('tournament'));
    }

    public function beginTournament(Tournament $tournament) {
        $user = Auth::user();

        $currentDate = new \DateTime();
        $formattedDate = $currentDate->format("Y-m-d H:is");
        // check dates
        $startDate = $tournament->start_date." ".$tournament->start_time.":00";
        $endDate = $tournament->start_date." ".$tournament->end_time.":00";

        if($startDate > $formattedDate || $endDate < $formattedDate || $tournament->active == 0) {
            return view('tournament.end', compact('tournament'));
        }

        $result = \DB::table('tournament_scores')->where('tournament_id', '=', $tournament->id)->where('user_id', '=', $user->id)->get();

        if(sizeof($result) > 0) {
            // it has already started before we have to do smg
            // check if there is any plan that he has not played
            $resultNP = \DB::table('tournament_scores')->where('tournament_id', '=', $tournament->id)->where('user_id', '=', $user->id)->where('started', 0)->first();
            if($resultNP == null) {
                return redirect(route('finish_tournament', compact('tournament')));
            } else {
               return redirect(route('play_tournament', ['tournament' => $tournament, 'game' => $resultNP->game ] ));
            }

        } else {
            foreach($tournament->plans as $plan) {
                $tournamentScore = new TournamentScore();
                $tournamentScore->tournament_id = $tournament->id;
                $tournamentScore->user_id = $user->id;
                $tournamentScore->started = 0;
                $tournamentScore->score = 0;
                $tournamentScore->movements = 0;
                $tournamentScore->game = $plan->pivot->order;

                $tournamentScore->save();
            }

        }

        return redirect(route('play_tournament', ['tournament'=>$tournament, 'game' => 1]));


    }
    public function playTournament(Tournament $tournament, $game) {
        $user = Auth::user();

        $currentDate = new \DateTime();
        $formattedDate = $currentDate->format("Y-m-d H:is");
        // check dates
        $startDate = $tournament->start_date." ".$tournament->start_time.":00";
        $endDate = $tournament->start_date." ".$tournament->end_time.":00";

        if($startDate > $formattedDate || $endDate < $formattedDate || $tournament->active == 0) {
            return view('tournament.end', compact('tournament'));
        }

        $score = \DB::table('tournament_scores')->where('tournament_id', '=', $tournament->id)->where('user_id', '=', $user->id)->where('game', '=', $game)->first();

        if($score == null) {
            // it has already started before we have to do smg
            return view('tournament.end', compact('tournament'));
        } else {
//            if($score->started == 1) {
//                //dd('has played again');
//            } else {

                // set that the user started
                $started = array(
                    'started' => 1
                );
                //update started
                $dbResult = \DB::table('tournament_scores')->where('tournament_id', '=', $tournament->id)->where('user_id', '=', $user->id)->where('game', '=', $game)->update($started);

                // get plan to play
                $tournamentPlan = \DB::table('tournament_plans')->where('tournament_id', '=', $tournament->id)->where('order', '=', $game)->first();
                if($tournamentPlan == null) {
                    return view('tournament.end', compact('tournament'));
                } else {
                    // we play
                    $plan = Plan::find($tournamentPlan->plan_id);
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
                    if($user->level == 7) {
                        return view('plans.play_tournament_kinder', compact('pattern', 'size', 'blocked', 'plan', 'questions', 'tournament', 'game'));
                    }
                    return view('plans.play_tournament', compact('pattern', 'size', 'blocked', 'plan', 'questions', 'tournament', 'game'));
//                }
            }
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finishTournament(Tournament $tournament)
    {
        $user = Auth::user();
        $scores = TournamentScore::where('tournament_id', $tournament->id)->where('user_id', $user->id)->orderBy('game','asc')->get();
        $totalScore = 0;
        $totalMoves = 0;
        $lowerTime = 0;
        $higherTime = 0;
        foreach($scores as $score) {
            if($lowerTime == 0) {
                $lowerTime = strtotime($score->created_at);
            } else if($lowerTime > strtotime($score->created_at) ) {
                $lowerTime = strtotime($score->created_at);
            }
            if($higherTime == 0) {
                $higherTime = strtotime($score->updated_at);
            } else if($higherTime < strtotime($score->updated_at) ) {
                $higherTime = strtotime($score->updated_at);
            }
            $totalScore += $score->score;
            $totalMoves += $score->movements;
        }

        $totalSeconds = gmdate("H:i:s", $higherTime - $lowerTime);



        return view('tournament.finish', compact('tournament', 'scores', 'totalScore', 'totalMoves', 'totalSeconds'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resultsTournament(Tournament $tournament)
    {
        $user = Auth::user();

        $stats = TournamentScore::selectRaw('sum(score) as totalScore, sum(movements) as totalMoves,  time_to_sec(TIMEDIFF( max(tournament_scores.updated_at), min(tournament_scores.created_at))) as timedifference, users.name')
            ->join('users', 'tournament_scores.user_id', '=', 'users.id')
            ->where('tournament_id', '=', $tournament->id)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->orderBY('totalMoves', 'asc')
            ->orderBY('timedifference', 'asc')
            ->get();

        return view('tournament.results', compact('stats', 'tournament'));
    }
}
