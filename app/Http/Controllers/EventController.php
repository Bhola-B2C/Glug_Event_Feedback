<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\feedback;
use Session;
use Khill\Lavacharts\Lavacharts;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function getAdminDashboard()
    {
        return view('admin_dashboard');
    }

    public function getFeedbackDashboard()
    {
        $events=Event::all();
        return view('feedback_dashboard')->withEvents($events);
    }
    public function getFeedbackResult($id)
    {
        /*$population = Lava::DataTable();

        $population->addDateColumn('Year')
           ->addNumberColumn('Number of People')
           ->addRow(['2006', 623452])
           ->addRow(['2007', 685034])
           ->addRow(['2008', 716845])
           ->addRow(['2009', 757254])
           ->addRow(['2010', 778034])
           ->addRow(['2011', 792353])
           ->addRow(['2012', 839657])
           ->addRow(['2013', 842367])
           ->addRow(['2014', 873490]);

        Lava::AreaChart('Population', $population, [
                'title' => 'Population Growth',
                'legend' => [
                'position' => 'in'
                            ]
        ]);*/

        $event=Event::where('id','=',$id)->first();
        return view('feedback_result')->withEvent($event);
    }
}
