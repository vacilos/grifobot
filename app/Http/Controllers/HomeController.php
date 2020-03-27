<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {

        $dateTime = new \DateTime('-1 day');
        $compareDate = $dateTime->format("Y-m-d H:i:s");
        $stats = Score::selectRaw('sum(score) as totalScore, users.name as username')
            ->join('users', 'users.id', '=', 'scores.user_id')
            ->where('scores.updated_at', '>', $compareDate)
            ->groupBy('users.name')
            ->orderBy('totalScore', 'desc')
            ->take(10)
            ->get();

        $scores = Score::all();
        $total = 0;
        $moves = 0;
        $answers = 0;
        $count = sizeof($scores);
        foreach($scores as $score) {
            $total += $score->score;
            $moves += $score->movements;
            $answers += intval($score->total);
        }
        return view('welcome', compact('count', 'total', 'moves', 'answers', 'stats'));
    }

    public function test() {

        $number = 'βρείτε το αποτέλεσμα της πράξης: 12.4:17.5 και βρείτε το κλάσμα 0.1/100 και κάντε την πράξη 5^3';

        // fix power
        $pattern = '/(\d+)\^(\d+)/';
        $replace = '${1}<sup>${2}</sup>';
        $number = preg_replace($pattern, $replace, $number);

//        $pattern = '/(\d+)\/(\d+)/';
//        $replace = '<span class="f"><div class="n">${1}</div><div class="d">${2}</div></span>';
//        $number = preg_replace($pattern, $replace, $number);


        // replace dot with comma
        $pattern = '/(\d+).(\d+)/';
        $replace = '${1},${2}';
        $number = preg_replace($pattern, $replace, $number);

        // replace : with divide sign
        $pattern = '/(\d+):(\d+)/';
        $replace = '${1}&divide;${2}';
        $number = preg_replace($pattern, $replace, $number);

        return view('test');
    }

}
