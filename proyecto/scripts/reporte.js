$(document).ready(function () {
	$('#reporte').submit(function(event) {
		$('#descarga').val('Obteniendo el reporte. Espere un momento.').attr('disabled','disabled');
	});
});