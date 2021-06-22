<?php

namespace App\Http\Controllers;

use App\Municipality;
use App\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $towns = \DB::table('towns')->paginate(15);

        return view('town.index', compact('towns'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipalities = Municipality::orderBy('municipality', 'asc')->get();
        //
        return view('town.create', compact('municipalities'));

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
            'townname' => 'required',
            'towntitle' => 'required',
            'towninfo' => 'required',
            'townslug' => 'required',
        ]);

        $name = $request->townname;
        $title = $request->towntitle;
        $info = $request->towninfo;
        $slug = $request->townslug;
        $css = $request->towncss;
        $municipality_id = $request->municipality;

        $town = new Town();
        $town->name = $name;
        $town->title = $title;
        $town->info = $info;
        $town->slug = $slug;
        if($request->townlogo != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->townlogo->getClientOriginalExtension();
            $logo = $request->townlogo;
            $town->logo = $fileName;
            $request->townlogo->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->townbackground != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->townbackground->getClientOriginalExtension();
            $logo = $request->townbackground;
            $town->background = $fileName;
            $request->townbackground->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngamebackground != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngamebackground->getClientOriginalExtension();
            $logo = $request->towngamebackground;
            $town->game_background = $fileName;
            $request->towngamebackground->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngameplayer != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngameplayer->getClientOriginalExtension();
            $logo = $request->towngameplayer;
            $town->game_player = $fileName;
            $request->towngameplayer->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngamequestion != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngamequestion->getClientOriginalExtension();
            $logo = $request->towngamequestion;
            $town->game_question = $fileName;
            $request->towngamequestion->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngameobstacle != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngameobstacle->getClientOriginalExtension();
            $logo = $request->towngameobstacle;
            $town->game_obstacle = $fileName;
            $request->towngameobstacle->storeAs('pubimg', $fileName, 'mypublic');
        }
        $css ? $town->css = $css:null;
        $municipality_id ? $town->municipality_id = $municipality_id: null;

        $town->save();

        return redirect(route('town.show'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function show(Town $town)
    {

        return view('town.show', compact('town'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function edit(Town $town)
    {
        //
        $municipalities = Municipality::orderBy('municipality', 'asc')->get();

        return view('town.edit', compact('town', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $town)
    {
        //
        $validatedData = $request->validate([
            'townname' => 'required',
            'towntitle' => 'required',
            'towninfo' => 'required',
            'townslug' => 'required',
        ]);

        $name = $request->townname;
        $title = $request->towntitle;
        $info = $request->towninfo;
        $slug = $request->townslug;
        $css = $request->towncss;
        $municipality_id = $request->municipality;

        $town->name = $name;
        $town->title = $title;
        $town->info = $info;
        $town->slug = $slug;
        if($request->townlogo != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->townlogo->getClientOriginalExtension();
            $logo = $request->townlogo;
            $town->logo = $fileName;
            $request->townlogo->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngamebackground != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngamebackground->getClientOriginalExtension();
            $logo = $request->towngamebackground;
            $town->background = $fileName;
            $request->towngamebackground->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngamebackground != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngamebackground->getClientOriginalExtension();
            $logo = $request->towngamebackground;
            $town->background = $fileName;
            $request->towngamebackground->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngameplayer != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngameplayer->getClientOriginalExtension();
            $logo = $request->towngameplayer;
            $town->game_player = $fileName;
            $request->towngameplayer->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngamequestion != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngamequestion->getClientOriginalExtension();
            $logo = $request->towngamequestion;
            $town->game_question = $fileName;
            $request->towngamequestion->storeAs('pubimg', $fileName, 'mypublic');
        }
        if($request->towngameobstacle != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->towngameobstacle->getClientOriginalExtension();
            $logo = $request->towngameobstacle;
            $town->game_obstacle = $fileName;
            $request->towngameobstacle->storeAs('pubimg', $fileName, 'mypublic');
        }
        $css ? $town->css = $css:null;
        $municipality_id ? $town->municipality_id = $municipality_id: null;

        $town->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $town)
    {
        //
    }
}
