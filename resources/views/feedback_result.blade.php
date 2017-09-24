@extends('main')
@section('content')
<div class="jumbotron text-center">
	<h1>{{$event->name}}</h1>
</div>
<div class="container">
	<div id="event_heard_from" style="height: 400px;"></div>
	<hr>
	<div id="satisfactory_rating" style="height: 400px;"></div>
	<hr>
	<div id="organized_rating" style="height: 200px;"></div>
	<hr>
	<div id="yes_no" style="height: 400px;"></div>
	<hr>
	<div id="overall" style="height: 200px;"></div>
	<hr>
	<div>
		<h2>Suggestions: </h2>
		@foreach($suggestions as $suggestion)
			<li>{{ $suggestion->suggestions }}</li>
		@endforeach
	</div>
	@piechart('event_heard', 'event_heard_from')
	@barchart('Rates', 'satisfactory_rating')
	@barchart('Organize', 'organized_rating')
	@columnchart('Yes_No', 'yes_no')
	@barchart('Overall', 'overall')
</div>
<div class="blank"></div>
@endsection