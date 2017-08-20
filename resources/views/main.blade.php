<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title> Glug Storehouse</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('/Font-Awesome/css/font-awesome.min.css')}}">
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