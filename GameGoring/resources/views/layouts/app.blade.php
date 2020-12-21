<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title-block')</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	@include('includes.header')



	<div class="container mt-5">
		<div class="row">
			<div class="col-10">
				@yield('content')
			</div>
		</div>
	</div>


</body>
</html>
