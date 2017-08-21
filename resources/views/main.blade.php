<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title> GNU Linux User's Group</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('/Font-Awesome/css/font-awesome.min.css')}}">
	<link rel="shortcut icon" href="images/logo.png">
</head>

<body>

	<header>
		@include('partials._navbar')
		@yield('content')
	</header>
	@include('partials._footer')
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</body>

</html>