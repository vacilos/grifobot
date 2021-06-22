<?php

namespace App\Http\Controllers;

use App\Person;
use App\Town;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;

class PersonController extends Controller
{
    public function login(Town $town) {
        return view('person.login_user', compact('town'));
    }

    public function register(Town $town) {
        return view('person.register', compact('town'));
    }

    public function doregister(Request $request, Town $town) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:4',
            'password_confirmation' => 'required|max:4',
        ]);

        $name = $request->name;
        $password = $request->password;
        $passwordConfirm = $request->password_confirmation;

        $person = Person::where('username', $name)->first();
        if($person != null) {
            return back()->withErrors("Το ψευδώνυμο που δώσατε χρησιμοποιείται ήδη");
        }

        if($password != $passwordConfirm) {
            return back()->withErrors("Τα δύο pin πρέπει να είναι ίδια");
        }
        if($password < 1000 || $password > 9999) {
            return back()->withErrors("Το PIN πρέπει να είναι ένας αριθμός από 1000 έως 9999");
        }

        $person = new Person();
        $person->username = $name;
        $person->pin = $password;

        $person->save();

        return redirect(route('plan_init', ['town' => $town->id]));
    }
    public function dologin(Request $request, Town $town) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:4',
        ]);

        $name = $request->name;
        $password = $request->password;

        $person = Person::where('username', $name)->where('pin', $password)->first();
        if($person == null) {

            // check if username exists
            $person = Person::where('username', $name)->first();
            if($person != null) {
                return back()->withErrors("Το username χρησιμοποιείται από άλλο παίκτη");
            }
            $person = new Person();
            $person->username = $name;
            $person->pin = $password;

            $person->save();

        }

        $request->session()->put('grif1821_user', $person->username);

        return redirect(route('plan_init', ['town' => $town->id]));
    }

    public function invalidate(Request $request, Town $town) {
        $request->session()->flush();

        return redirect(route('welcome_town', ['town'=> $town->slug]));
    }
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
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
