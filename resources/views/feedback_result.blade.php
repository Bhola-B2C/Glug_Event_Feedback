@extends('main')
@section('content')
<div class="jumbotron text-center">
	<h1>{{$event->name}}</h1>
</div>
<div class="container">
	<div class="pop_div"></div>
	@areachart('Population', 'pop_div')
</div>
<div class="blank"></div>
@endsection