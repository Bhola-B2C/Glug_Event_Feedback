<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body style="font-style: bold">
<h2>Feedback form</h2>
<div> Someone just feedbacked us:</div>
<div> <h3> Event Name: {{ $event_name }} </h3></div>
<div> Event heard by: {{ $event_heard_from }} </div>
<div> Ratings:
	<br>
	<br>
	Content: {{ $one }}/5;
	<br>
	Presentation: {{ $two }}/5;
	<br>
	Speaker: {{ $three }}/5;
	<br>
	Support Staff: {{ $four }}/5;
	<br>
	Location: {{ $five }}/5;
	<br>
</div>

<div>How well organized was the event? {{ $organized }}/9</div>
<div>Overall Satisfaction {{ $overall }}/9</div>
<div>Suggestions: {{ $suggestions }}</div>
</body>
</html>