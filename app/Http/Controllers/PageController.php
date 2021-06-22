<?php

namespace App\Http\Controllers;

use App\Page;
use App\Town;
use Illuminate\Http\Request;

class PageController extends Controller
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
    public function create(Town $town)
    {
        //
        return view('page.create', compact('town'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Town $town)
    {
        //
        $validatedData = $request->validate([
            'pagetitle' => 'required',
            'pageslug' => 'required',
            'pageinfo' => 'required',
            'pageorder' => 'required',
        ]);

        $title = $request->pagetitle;
        $slug = $request->pageslug;
        $description = $request->pageinfo;
        $order = $request->pageorder;

        $page = new Page();

        $page->title = $title;
        $page->slug = $slug;
        $page->description = $description;
        $page->order = $order;

        if($request->pagelogo != null) {
            $fileName = "fileName_".uniqid()."_".time().'.'.$request->pagelogo->getClientOriginalExtension();
            $image = $request->pagelogo;
            $page->image = $fileName;
            $request->pagelogo->storeAs('pubimg', $fileName, 'mypublic');
        }
        $page->town_id = $town->id;

        $page->save();

        return redirect(route('towns.show', ['town'=>$town->id]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
