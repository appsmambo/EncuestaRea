@extends('layouts.plantilla')
@section('contenido')
<form id="encuesta-form" name="encuesta-form" method="post" action="/enviarEncuesta" role="form">
	<section class="container">
		<!-- pagina 1: introduccion -->
		<div id="paso-1">
			<div class="page-header">
				<h1>
					REA 2016-2 - Encuesta Parcial
				</h1>
				<p>
					El Programa REA tiene como propósito ser un nexo entre los estudiantes y profesores en búsqueda de una formación más activa. La encuesta constituye un medio para la mejora continua de la educación y recoge la opinión de los alumnos, actores fundamentales. En este sentido, te invitamos a usar esta encuesta como un espacio para expresar tus opiniones y sugerencias, con responsabilidad.
				</p>
			</div>
			<div class="form-horizontal">
				<div class="form-group">
					<label for="departamento_academico" class="col-sm-3 control-label">*Departamento académico</label>
					<div class="col-sm-4">
						<select name="departamento_academico" id="departamento_academico" class="form-control">
							<option value="">-Seleccione-</option>
							@foreach($departamentosAcademicos as $departamento)
							<option value="{{$departamento['id']}}">{{$departamento['descripcion']}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="codigo_salon" class="col-sm-3 control-label">*Código del salón</label>
					<div class="col-sm-3">
						<select name="codigo_salon" id="codigo_salon" class="form-control">
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="nombre_curso" class="col-sm-3 control-label">*Nombre del curso</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nombre_curso" name="nombre_curso" autocomplete="off" maxlength="100">
						<input type="hidden" name="id_curso" id="id_curso">
					</div>
				</div>
				<div class="form-group">
					<label for="seccion" class="col-sm-3 control-label">*Sección</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="seccion" name="seccion" autocomplete="off" maxlength="5">
					</div>
				</div>
				<div class="form-group">
					<label for="nombre_rea" class="col-sm-3 control-label">*Nombre del REA</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nombre_rea" name="nombre_rea" autocomplete="off" maxlength="100">
						<br><br>
						<button type="button" class="btn btn-primary pull-right ir-paso" data-desde="#paso-1" data-hasta="#paso-2">Continuar >>></button>
					</div>
				</div>
			</div>
			<p>
				<br><br>
			</p>
		</div>
		<!-- pagina 2: curso -->
		<div id="paso-2" style="display:none">
			<div class="page-header">
				<h1>
					I. Curso
				</h1>
				<p>
					Califique las siguientes preguntas, donde 1 es la menor puntuación posible y 5 es la máxima.  Se recomienda sustentar el motivo de la calificación para así poder mejorar en esos aspectos. La información será de utilidad para profesores, alumnos y autoridades.
				</p>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="curso_contenido" class="titulo">
							Contenido
						</label>
						<br>
						Los contenidos trabajados fueron realizados de manera adecuada, no quedaron dudas.
						<select id="curso_contenido" name="curso_contenido" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
						<textarea name="curso_contenido_sustentacion" id="curso_contenido_sustentacion" class="form-control" rows="3" placeholder="Tus opiniones son importante para mejorar nuestro aprendizaje"></textarea>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="curso_exigencia" class="titulo">
							Exigencia
						</label>
						<br>
						El curso reta a esforzarse y usar todo mi potencial.
						<select id="curso_exigencia" name="curso_exigencia" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
						<textarea name="curso_exigencia_sustentacion" id="curso_exigencia_sustentacion" class="form-control" rows="3" placeholder="Tus opiniones son importante para mejorar nuestro aprendizaje"></textarea>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="curso_proposito" class="titulo">
							Propósito
						</label>
						<br>
						El curso aporta en mi formación como profesional integral, de acuerdo a los valores que la UP promueve: "Libertad de pensamiento y opinión", "Honestidad y veracidad", "Respeto al otro", "Ética y responsabilidad social".
						<select id="curso_proposito" name="curso_proposito" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
						<textarea name="curso_proposito_sustentacion" id="curso_proposito_sustentacion" class="form-control" rows="3" placeholder="Tus opiniones son importante para mejorar nuestro aprendizaje"></textarea>
					</div>
					<p>&nbsp;</p>
					<button type="button" class="btn btn-primary pull-right ir-paso" data-desde="#paso-2" data-hasta="#paso-3">Continuar >>></button>
					<p>&nbsp;<br>&nbsp;<br>&nbsp;</p>
				</div>
			</div>
		</div>
		<!-- pagina 3: alumnos -->
		<div id="paso-3" style="display:none">
			<div class="page-header">
				<h1>
					II. Alumnos
				</h1>
				<p>
					Califique las siguientes preguntas, donde 1 es la menor puntuación posible y 5 es la máxima.  Se recomienda sustentar el motivo de la calificación para así poder mejorar en esos aspectos. La información será de utilidad para profesores, alumnos y autoridades.
				</p>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="alumno_esfuerzo" class="titulo">
							Esfuerzo
						</label>
						<br>
						Doy lo mejor de mí para alcanzar los resultados adecuados
						<select id="alumno_esfuerzo" name="alumno_esfuerzo" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="alumno_actitud" class="titulo">
							Actitud
						</label>
						<br>
						Muestro una actitud positiva hacia el curso.
						<select id="alumno_actitud" name="alumno_actitud" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="alumno_participacion" class="titulo">
							Participación
						</label>
						<br>
						Participo activamente en las clases y pregunto si tengo dudas.
						<select id="alumno_participacion" name="alumno_participacion" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<p>&nbsp;</p>
					<button type="button" class="btn btn-primary pull-right ir-paso" data-desde="#paso-3" data-hasta="#paso-4">Continuar >>></button>
					<p>&nbsp;<br>&nbsp;<br>&nbsp;</p>
				</div>
			</div>
		</div>
		<!-- pagina 4: profesor -->
		<div id="paso-4" style="display:none">
			<div class="page-header">
				<h1>
					III. Profesor
				</h1>
				<p>
					Califique las siguientes preguntas, donde 1 es la menor puntuación posible y 5 es la máxima.  Se recomienda sustentar el motivo de la calificación para así poder mejorar en esos aspectos. La información será de utilidad para profesores, alumnos y autoridades.
				</p>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="profesor_motivacion" class="titulo">
							Motivación
						</label>
						<br>
						El profesor procura estimular la participación y compromiso con el curso.
						<p>&nbsp;</p>
						<select id="profesor_motivacion" name="profesor_motivacion" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="profesor_tiempo" class="titulo">
							Tiempo
						</label>
						<br>
						La gestión del tiempo es la adecuada para cubrir los temas trabajados.
						<p>&nbsp;</p>
						<select id="profesor_tiempo" name="profesor_tiempo" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="profesor_contenido" class="titulo">
							Contenido
						</label>
						<br>
						La información proporcionada es clara, completa y correcta.
						<p>&nbsp;</p>
						<select id="profesor_contenido" name="profesor_contenido" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="profesor_retroalimentacion" class="titulo">
							Retroalimentación
						</label>
						<br>
						Atiende consultas y comentarios sobre los temas trabajados.
						<p>&nbsp;</p>
						<select id="profesor_retroalimentacion" name="profesor_retroalimentacion" class="califica">
							<option value=""></option>
							<option value="1">Malo</option>
							<option value="2">Regular</option>
							<option value="3">Bueno</option>
							<option value="4">Muy bueno</option>
							<option value="5">Excelente</option>
						</select>
					</div>
					<p>&nbsp;</p>
					<button type="button" class="btn btn-primary pull-right ir-paso" data-desde="#paso-4" data-hasta="#paso-5">Continuar >>></button>
					<p>&nbsp;<br>&nbsp;<br>&nbsp;</p>
				</div>
			</div>
		</div>
		<!-- pagina 5: otros temas -->
		<div id="paso-5" style="display:none">
			<div class="page-header">
				<h1>
					IV. Recomendaciones adicionales
				</h1>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="otros_1">
							¿Crees que hubo situaciones en particular que hayan dificultado el desarrollo del curso?
						</label>
						<textarea name="otros_1" id="otros_1" class="form-control" rows="4" placeholder="Tus opiniones son importantes para mejorar nuestro aprendizaje."></textarea>
					</div>
					<div class="separador"></div>
					<div class="form-group">
						<label for="otros_2">
							¿Qué sugerencias darías para un mejor desempeño de la clase? Según lo analizado/reflexionado en las preguntas anteriores; o algún otro aporte que quisiera mencionar será bienvenido.
						</label>
						<textarea name="otros_2" id="otros_2" class="form-control" rows="4" placeholder="Tus opiniones son importantes para mejorar nuestro aprendizaje."></textarea>
					</div>
					<p>&nbsp;</p>
					<button id="enviar" type="submit" class="btn btn-success pull-right">Enviar</button>
					<p>&nbsp;<br>&nbsp;<br>&nbsp;</p>
				</div>
			</div>
		</div>
	</section>
</form>
@stop