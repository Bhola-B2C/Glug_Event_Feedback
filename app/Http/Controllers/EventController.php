<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Feedback;
use Session;
use Lava;

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
        $overall = Lava::DataTable();
        $events=Event::all();
        $overall->addStringColumn('Event')->addNumberColumn('Overall Rating');

        foreach ($events as $event) {
                $overall->addRow([$event->name, Feedback::where('event_id',$event->id)->avg('overall')]);
        }

        Lava::AreaChart('Overall', $overall, [
            'title' => 'Overall increment | decrement',
            'legend' => [
            'position' => 'in'
            ]
            ]);

        return view('feedback_dashboard')->withEvents($events);
    }
    public function getFeedbackResult($id)
    {
        $event=Event::where('id','=',$id)->first();
        /* Event heard from */
        $publicity = Lava::DataTable();
        $publicity->addStringColumn('reasons')
                 ->addNumberColumn('Percent')
                 ->addRow(['Posters', Feedback::where([['event_heard_from','posters'],['event_id',$id]])->count()])
                 ->addRow(['Class Orientation', Feedback::where([['event_heard_from','class_orientation'],['event_id',$id]])->count()])
                 ->addRow(['Friends', Feedback::where([['event_heard_from','friends'],['event_id',$id]])->count()])
                 ->addRow(['Seniors', Feedback::where([['event_heard_from','seniors'],['event_id',$id]])->count()])
                 ->addRow(['Others', Feedback::where([['event_heard_from','others'],['event_id',$id]])->count()]);
        Lava::PieChart('event_heard', $publicity, [
            'title'  => 'Publicity of Event',
            'is3D'   => true
            ]);

        /* Satisfactory level of event */
        $rates  = Lava::DataTable();
        $rates->addStringColumn('Subject')
                ->addNumberColumn('Rates')
                ->addRow(['Content',Feedback::where('event_id',$id)->avg('content')])
                ->addRow(['Presentation', Feedback::where('event_id',$id)->avg('presentation')])
                ->addRow(['Speaker',  Feedback::where('event_id',$id)->avg('speaker')])
                ->addRow(['Support Staff', Feedback::where('event_id',$id)->avg('support_staff')])
                ->addRow(['Location',   Feedback::where('event_id',$id)->avg('location')]);
        Lava::BarChart('Rates', $rates, [ 'title' => 'Part rating of event']);

        /* How organized was the event */
        $organized  = Lava::DataTable();
        $organized->addStringColumn('Subject')
                ->addNumberColumn('How organized was the event ?')
                ->addRow(['Organized',Feedback::where('event_id',$id)->avg('organized')]);
        Lava::BarChart('Organize', $organized, ['title'=>'How organized was the event ?']);

        /* Want such Event to be conducted */
        $options = Lava::DataTable();
        $options->addStringColumn('Event')
        ->addNumberColumn('Yes')
        ->addNumberColumn('No')
        ->addRow( [$event->name, Feedback::where([['yes_no',1],['event_id',$id]])->count(), Feedback::where([['yes_no',0],['event_id',$id]])->count()] );
        Lava::ColumnChart('Yes_No', $options, ['title' => 'Want such event to be conducted again ?']);

        /* Overall rating */
        $overall  = Lava::DataTable();
        $overall->addStringColumn('Subject')
                ->addNumberColumn('Overall Rating')
                ->addRow(['Overall',Feedback::where('event_id',$id)->avg('overall')]);
        Lava::BarChart('Overall', $overall, ['title'=>'Overall Rating of the Event']);
        /*Suggestions */
        $feedbacks=Feedback::where('event_id',$id)->get();
        return view('feedback_result')->withEvent($event)->withFeedbacks($feedbacks);
    }
}
