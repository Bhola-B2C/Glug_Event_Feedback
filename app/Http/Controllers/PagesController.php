<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Redirect;
use Mail;
use Session;
use App\Event;

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
    public function postFeedback()
    {
    	$data=Input::all();
		$rules=array(
			'event_name' => 'required',
			'event_heard_from' => 'required',						// => is separator for assosciative array
			'one' => 'required',
			'two' => 'required',
			'three' => 'required',
			'four' => 'required',
			'five' => 'required',
			'organized' => 'required',
			'overall' =>'required'
		);

		$validator=Validator::make($data,$rules);
		if($validator->fails()){
		return Redirect::to('feedback')->withErrors($validator)->withInput();
		}

		$feedbackcontent=array(
			'event_name' => $data['event_name'],					// key(just like indexes) => value;
			'event_heard_from' => $data['event_heard_from'],
			'one' => $data['one'],
			'two' => $data['two'],
			'three' => $data['three'],
			'four' => $data['four'],
			'five' => $data['five'],
			'organized' => $data['organized'],
			'overall' => $data['overall'],
			'suggestions' => $data['suggestions']
		);
	
		Mail::send('pages.send_mail_template',$feedbackcontent,function($message)
		{
			$message->to('bholajrs@gmail.com','Bhola')->subject('Someone gave feedback to GLUG Event')->from('feedback@glug.com');
		});
		Session::flash('success','The feedback has been submitted!!');
		return Redirect::to('feedback');
    }
}
