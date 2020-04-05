<?php

namespace App\Http\Controllers;

use App\Math;
use App\Score;
use App\Challenge;
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


        if ($user->avatar === null || $user->level === null || $user->municipality === null) {
            return redirect()->route('user_create_profile');
        }

        if($user->message == 0) {
            return redirect()->route('user_newsletter');
        }

        $level = $user->level;

        $hasBadge = $this::checkBadge();

        $scores = Score::where('user_id', '=', $user->id)->orderby('updated_at', 'desc')->take(10)->get();

        $games = \DB::table('scores')->where('user_id', $user->id)->get();
        $total = 0;
        $moves = 0;
        $count = sizeof($games);
        foreach ($games as $score) {
            $total += $score->score;
            $moves += $score->movements;
        }

        $dateTime = new \DateTime('-1 day');
        $compareDate = $dateTime->format("Y-m-d H:i:s");
        $stats = Score::selectRaw('sum(score) as totalScore, users.name as username, users.avatar as avatar')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('scores.updated_at', '>', $compareDate)
            ->where('users.level', '=', $level)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->take(10)
            ->get();

        $dateTime7 = new \DateTime('-7 days');
        $compareDate7 = $dateTime7->format("Y-m-d H:i:s");
        $stats7 = Score::selectRaw('sum(score) as totalScore, users.name as username, users.avatar as avatar')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('scores.updated_at', '>', $compareDate7)
            ->where('users.level', '=', $level)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->take(10)
            ->get();

        $challenges = Challenge::where('to_user_id', $user->id)->where('read','=','0')->get();

        foreach($challenges as $challenge) {
            $challenge->read = 1;
            $challenge->save();
        }
        return view('home', compact('total', 'count', 'scores', 'hasBadge', 'stats', 'stats7', 'moves', 'challenges'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function games()
    {
        $user = Auth::user();

        if ($user->avatar === null || $user->level === null || $user->municipality === null) {
            return redirect()->route('user_create_profile');
        }

        $games = \DB::table('scores')->where('user_id', $user->id)->orderby('updated_at', 'desc')->paginate(15);

        $scores = Score::where('user_id', $user->id)->orderby('updated_at', 'desc')->take(10)->get();
        $total = 0;
        $count = sizeof($scores);
        foreach ($scores as $score) {
            $total += $score->score;
        }

        return view('user.games', compact('games', 'total', 'count', 'scores'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stats()
    {
        $user = Auth::user();

        $level = $user->level;


        $dateTime = new \DateTime('-1 day');
        $compareDate = $dateTime->format("Y-m-d H:i:s");
        $stats = Score::selectRaw('sum(score) as totalScore, users.name as username')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('scores.updated_at', '>', $compareDate)
            ->where('users.level', '=', $level)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->take(50)
            ->get();

        $dateTime7 = new \DateTime('-7 days');
        $compareDate7 = $dateTime7->format("Y-m-d H:i:s");
        $stats7 = Score::selectRaw('sum(score) as totalScore, users.name as username')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('scores.updated_at', '>', $compareDate7)
            ->where('users.level', '=', $level)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->take(50)
            ->get();

        return view('user.stats', compact('stats', 'stats7'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function statsAllTime()
    {
        $user = Auth::user();

        $level = $user->level;


        $dateTime = new \DateTime('-1 day');
        $compareDate = $dateTime->format("Y-m-d H:i:s");
        $stats = Score::selectRaw('sum(score) as totalScore, users.name as username')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('users.level', '=', $level)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->get();

        return view('user.statsalltime', compact('stats'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function badges()
    {
        $user = Auth::user();

        $badges = $user->badges()->get();
        $badgeCondition = array();
        foreach ($badges as $badge) {
            $badgeCondition[] = $badge->condition;
        }
        return view('user.badges', compact('user', 'badgeCondition'));
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newsletter($answer)
    {
        $user = Auth::user();

        $user->newsletter = $answer;
        $user->message = 1;

        $user->save();

        return redirect(route('user_home'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
            'newsletter' => 'sometimes'
        ]);


        $user = Auth::user();
        $user->level = $request->level;
        $user->municipality_id = $request->municipality;
        $user->avatar = $request->avatar;
        $user->newsletter = ($request->newsletter==null)?0:1;
        $user->message = 1;

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
     * @param \Illuminate\Http\Request $request
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
            'newsletter' => 'sometimes'
        ]);

        $user = Auth::user();
        $user->level = $request->level;
        $user->municipality_id = $request->municipality;
        $user->avatar = $request->avatar;
        $user->newsletter = ($request->newsletter==null)?0:1;
        $user->message = 1;

        $user->save();

        return redirect(route('user_home'));
    }


    public static function checkBadge()
    {
        $user = Auth::user();

        $games = \DB::table('scores')->where('user_id', $user->id)->get();

        $totalScore = 0;
        $totalMovements = 0;
        $totalGames = sizeof($games);
        foreach ($games as $game) {
            $totalScore += $game->score;
            $totalMovements += $game->movements;
        }

        $badgesArray = array();

        $checkBadges = $user->badges()->get();

        foreach ($checkBadges as $checkBadge) {
            $badgesArray[] = $checkBadge->condition;
        }

        $newBadge = false;

        // checking games ======== started ========
        if ($totalGames >= 1000) {
            // add badge 1000GAME
            if (!in_array("1000GAME", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '1000GAME')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }

        }
        if ($totalGames >= 100) {
            // add badge 100GAME
            if (!in_array("100GAME", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '100GAME')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        if ($totalGames >= 10) {
            // add badge 10GAME
            if (!in_array("10GAME", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '10GAME')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        if ($totalGames >= 1) {
            // add badge 1GAME
            if (!in_array("1GAME", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '1GAME')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        // checking games ======== finished ========
        //
        // checking points ======== started ========
        if ($totalScore >= 1000000) {
            // add badge 1000GAME
            if (!in_array("1MPOINT", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '1MPOINT')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }

        }
        if ($totalScore >= 100000) {
            // add badge 100GAME
            if (!in_array("100KPOINT", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '100KPOINT')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        if ($totalScore >= 10000) {
            // add badge 10GAME
            if (!in_array("10KPOINT", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '10KPOINT')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        if ($totalScore >= 1000) {
            // add badge 1GAME
            if (!in_array("1KPOINT", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '1KPOINT')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        // checking points ======== finished ========

        // checking games ======== started ========
        if ($totalMovements >= 50000) {
            // add badge 1000GAME
            if (!in_array("50KMOVE", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '50KMOVE')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }

        }
        if ($totalMovements >= 5000) {
            // add badge 100GAME
            if (!in_array("5KMOVE", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '5KMOVE')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        if ($totalMovements >= 500) {
            // add badge 10GAME
            if (!in_array("500MOVE", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '500MOVE')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        if ($totalMovements >= 50) {
            if (!in_array("50MOVE", $badgesArray)) {
                $badge = \DB::table('badges')->where('condition', '=', '50MOVE')->first();
                if ($badge != null) {
                    $user->badges()->attach($badge->id);
                    $newBadge = true;
                }
            }
        }
        // checking games ======== finished ========

        return $newBadge;
    }

    public function challenges() {
        $user = Auth::user();

        $challenges = Challenge::where('from_user_id', $user->id)->orWhere('to_user_id', $user->id)->orderBy('created_at','DESC')->get();

        return view('user.challenges', compact('challenges'));

    }

}
