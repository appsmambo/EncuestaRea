@extends('layouts.plantilla')
@section('contenido')
<section class="container">
	<div class="page-header">
		<h1>
			REA 2016-2 - Encuesta Parcial
		</h1>
	</div>
	<p>
		<br>
	</p>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
			<form id="reporte" action="{{url('/postReporte_hf6d890w')}}" method="post">
				<h4>
					<strong>
						Haz click en el boton para descargar el reporte
					</strong>
				</h4>
				<input id="descarga" type="submit" value="Descargar reporte" class="btn btn-danger">
			</form>
		</div>
	</div>
	<p>
		<br><br>
	</p>
</section>
@stop
@section('scripts')
<script src="{{url('scripts/reporte.js')}}"></script>
@stop