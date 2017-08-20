<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events=Event::all();
        return view('events.index')->withEvents($events);
    }

    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,array(
                'date'=>'required|max:255',
                'name' =>'required|max:255',
                'desc'=>'required',
                'venue' =>'required',
            ));
        $event=new Event;
        $event->date = $request->date;
        $event->name  = $request->name;
        $event->description = $request->desc;
        $event->venue = $request->venue;
        $event->save();
        Session::flash('success','The event was successfully saved !');
        return redirect()->route('events.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        return view('events.edit')->withEvent($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event=Event::find($id);
        $this->validate($request,array(
                'date'=>'required|max:255',
                'name' =>'required|max:255',
                'description'=>'required',
                'venue' =>'required',
            ));
        $event->date = $request->date;
        $event->name  = $request->name;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->save();
        Session::flash('success','The event was successfully saved !');
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        $event->delete();
        Session::flash('success','The event was successfully deleted');
        return redirect()->route('events.index');
    }
}
