@extends('main')
@section('content')
<div class="jumbotron text-center">
	<h1>Overall Feedback</h1>
</div>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<th>#</th>
				<th>Date</th>
				<th>Name</th>
				<th>Description</th>
				<th>Venue</th>
				<th>Created at</th>
			</thead>
			<tbody id="ch">
				@foreach ($events as $event)
					<tr class="sel" onclick="document.location='/feedback_result/{{$event->id}}'">
						<th>{{ $event->id }}</th>
						<td>{{ $event->date }}</td>
						<td>{{ $event->name }}</td>
						<td>{{ $event->description }}</td>
						<td>{{ $event->venue }}</td>
						<td>{{ date('M j, Y', strtotime($event->created_at)) }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="blank"></div>
@endsection