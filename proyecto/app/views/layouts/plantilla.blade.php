<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>REA 2016-2 - Encuesta Parcial</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap:400,700">
	<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('scripts/jquery-bar-rating-master/dist/themes/bars-movie.css')}}">
	<link rel="stylesheet" href="{{url('scripts/EasyAutocomplete-1.3.5/easy-autocomplete.min.css')}}">
	<link rel="stylesheet" href="{{url('scripts/EasyAutocomplete-1.3.5/easy-autocomplete.themes.min.css')}}">
	<link rel="stylesheet" href="{{url('css/estilos.css')}}">
	<script>
		var baseUrl = '{{url()}}';
	</script>
</head>
<body>
	<header class="container">
		<img src="{{url('images/rea-encuesta-parcial-2016-2.jpg')}}" class="img-responsive center-block">
	</header>
	@yield('contenido')
	<footer class="container">
		
	</footer>
	<script src="{{url('scripts/jquery-1.9.1.min.js')}}"></script>
	<script src="{{url('scripts/jquery-bar-rating-master/dist/jquery.barrating.min.js')}}"></script>
	<script src="{{url('scripts/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js')}}"></script>
	<script src="{{url('scripts/jquery-validation-1.15.0/dist/jquery.validate.min.js')}}"></script>
	<script src="{{url('scripts/jquery-validation-1.15.0/dist/additional-methods.min.js')}}"></script>
	<script src="{{url('scripts/jquery-validation-1.15.0/dist/localization/messages_es_PE.min.js')}}"></script>
	<script src="{{url('scripts/main.js')}}"></script>
	@yield('scripts')
</body>
</html>