<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Mail;
use Session;
use App\Event;
use App\Feedback;

class PagesController extends Controller
{
    public function getHome()
    {
    	$events=Event::all();
    	return view('pages.home')->withEvents($events);
    }
    public function getDownload()
    {
    	//return view('')
    }
    public function getFeedback()
    {
    	$events=Event::all();
    	return view('pages.feedback')->withEvents($events);
    }
    public function postFeedback(Request $request)
    {
    	$data=Input::all();
		$rules=array(
			'event_name' => 'required',
			'event_heard_from' => 'required',						// => is separator for assosciative array
			'one' => 'required',		//one=>content
			'two' => 'required',		//two=>presentation
			//'three' => 'required',		//three=>speaker
			'four' => 'required',		//four=>support_staff
			'five' => 'required',		//five=>location
			'organized' => 'required',
			'overall' =>'required',
			'yes_no'=>'required'
		);

		$validator=Validator::make($data,$rules);
		if($validator->fails()){
		return Redirect::to('/feedback')->withErrors($validator)->withInput();
		}
		$event=Event::find($request->event_name);
		$feedback=new Feedback;
		$feedback->event_heard_from = $request->event_heard_from;
        $feedback->content  = $request->one;
        $feedback->presentation = $request->two;
        $feedback->speaker='0';
        //$feedback->speaker = $request->three;
        $feedback->support_staff = $request->four;
        $feedback->location = $request->five;
        $feedback->organized = $request->organized;
        $feedback->overall = $request->overall;
        $feedback->yes_no = $request->yes_no;
        $feedback->suggestions =$request->suggestions;
        $feedback->event()->associate($event);
        $feedback->save();


		/* If you want to use mailing technology simply uncomment the below section*/

		/*$feedbackcontent=array(
			'event_name' => $data['event_name'],					// key(just like indexes) => value;
			'event_heard_from' => $data['event_heard_from'],
			'one' => $data['one'],
			'two' => $data['two'],
			'three' => $data['three'],
			'four' => $data['four'],
			'five' => $data['five'],
			'organized' => $data['organized'],
			'overall' => $data['overall'],
			'yes_no' => $data['yes_no'],
			'suggestions' => $data['suggestions']
		);
	
		Mail::send('pages.send_mail_template',$feedbackcontent,function($message)
		{
			$message->to('bholajrs@gmail.com','Bhola')->subject('Someone gave feedback to GLUG Event')->from('feedback@glug.com');
		});*/
		Session::flash('success_f','The feedback has been submitted!!');
		return Redirect::to('/');
    }
}
