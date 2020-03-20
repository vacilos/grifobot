<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('home');
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
