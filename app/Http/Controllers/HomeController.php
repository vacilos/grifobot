<?php

namespace App\Http\Controllers;

use App\Score;
use App\Town;
use App\User;
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
        return view('welcome');
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

    public function townWelcome($town) {

        $town = Town::where('slug', $town)->first();

        return view('revolution.'.$town->slug, compact('town'));
    }
    public function townAbout($town) {

        $town = Town::where('slug', $town)->first();

        return view('revolution.about', compact('town'));
    }

}
