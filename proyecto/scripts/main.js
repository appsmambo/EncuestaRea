var cursos, encuestaForm;

function LlenarCursos(cursos) {
	var arr = [];
	for (var x in cursos) {
		arr.push(cursos[x].descripcion);
	}
	return arr;
}

function BuscarCurso(curso) {
	var id;
	for (var x in cursos) {
		if (cursos[x].descripcion === curso) {
			id = cursos[x].id;
			break;
		}
	}
	return id;
}

// para configurar el autocomplete - linea 80
var options = {
	data: [],
	list: {
		maxNumberOfElements:6,
		match: {
			enabled:true
		},
		onSelectItemEvent: function() {
			var curso = $("#nombre_curso").getSelectedItemData();
			$('#id_curso').val(BuscarCurso(curso));
		}
	}
};

function ValidarCampos(pagina) {
	var res;
	switch (pagina) {
		case '#paso-1':
			res = encuestaForm.element('#departamento_academico') && 
					encuestaForm.element('#codigo_salon') && 
					encuestaForm.element('#id_curso') && 
					encuestaForm.element('#seccion') && 
					encuestaForm.element('#nombre_rea');
			break;
		case '#paso-2':
			res = encuestaForm.element('#curso_contenido') && 
					encuestaForm.element('#curso_exigencia') && 
					encuestaForm.element('#curso_proposito');
			break;
		case '#paso-3':
			res = encuestaForm.element('#alumno_esfuerzo') && 
					encuestaForm.element('#alumno_actitud') && 
					encuestaForm.element('#alumno_participacion');
			break;
		case '#paso-4':
			res = encuestaForm.element('#profesor_motivacion') && 
					encuestaForm.element('#profesor_tiempo') && 
					encuestaForm.element('#profesor_contenido') && 
					encuestaForm.element('#profesor_retroalimentacion');
			break;
	}
	return res;
}

$(window).scroll(function () {
	var scroll = $(this).scrollTop();
	if (scroll >= 140) {
		$('#subir').fadeIn('slow');
	} else {
		$('#subir').fadeOut('slow');
	}
});

$(document).ready(function () {
	$('a[href*="#"]:not([href="#"])').click(function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});
	$('.califica').barrating('show', {
		theme:'bars-movie'
	});
	$('.califica').change(function () {
		var control = $(this).siblings('.br-widget');
		var rating = $(this).val();
		var clases = 'score1 score2 score3 score4 score5', clase = 'score' + rating;
		$('.br-current-rating', control).removeClass(clases).addClass(clase);
	});
	$('.ir-paso').click(function () {
		var desde = $(this).data('desde');
		var hasta = $(this).data('hasta');
		if (ValidarCampos(desde))
			$(desde).fadeOut('fast', function () {
				$(hasta).fadeIn();
			});
	});
	$('#departamento_academico').change(function () {
		var id = $(this).val();
		if (!parseInt(id)) {
			return;
		}
		$('#codigo_salon').html('');
		$('#nombre_curso').val('');
		$.ajax({
			type:'POST',
			url:baseUrl + '/consulta_DA',
			data:{id:id},
			dataType:'json',
			success:function (data) {
				var i, html, option;
				// cargar salones
				var salones = data.salones;
				html = '<option value="" selected>-Seleccione-</option>';
				for (i=1;i<=salones.cantidad;i++) {
					if (i <= 9)
						option = salones.prefijo + '0' + i;
					else
						option = salones.prefijo + i;
					html += '<option value="' + option + '">' + option + '</option>';
				}
				$('#codigo_salon').html(html);
				// cargar cursos
				cursos = data.cursos;
				options.data = LlenarCursos(cursos);
				$('#nombre_curso').easyAutocomplete(options);
			}
		});
	});
	encuestaForm = $("#encuesta-form").validate({
		ignore:[],
		rules: {
			departamento_academico:'required',
			codigo_salon:'required',
			id_curso:'required',
			seccion:'required',
			nombre_rea:{
				required:true,
				minlength:5 // pe. Yu Li
			},
			curso_contenido:'required',
			curso_exigencia:'required',
			curso_proposito:'required',
			alumno_esfuerzo:'required',
			alumno_actitud:'required',
			alumno_participacion:'required',
			profesor_motivacion:'required',
			profesor_tiempo:'required',
			profesor_contenido:'required',
			profesor_retroalimentacion:'required'
		},
		submitHandler: function(form) {
			$('#enviar').html('Procesando datos...').attr('disabled','disabled');
			var data = $('#encuesta-form').serialize();
			$.ajax({
				type:'POST',
				url:baseUrl + '/enviarEncuesta',
				data:data,
				dataType:'json',
				success:function (data) {
					if (data.status === 'ok') {
						document.location.href = baseUrl + '/gracias';
					} else {
						alert('Se produjo un error al procesar tus datos, por favor vuelve a intentarlo.');
					}
				}
			});
			return false;
		}
	});
});

