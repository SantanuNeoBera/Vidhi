<!DOCTYPE html><html>
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"><title>@yield('title')</title>
<script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/vue.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/vuetify.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/velocity.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/vuetify.min.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bulma.css') }}"> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.0/css/bulma.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flexboxgrid.min.css') }}">

<script type="text/javascript" src="{{ URL::asset('js/semantic.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.css') }}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js">
</script>
</head>
<body>
	@include('Layouts.Vidhikarya.Lawyer.Header')

	<div id="Main">
		@yield('content')
	</div>

	@include('Layouts.Vidhikarya.Lawyer.Footer')
</body>
</html>