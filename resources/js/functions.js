function FiltrarProcedimientos() {
	filtro = $('#procedimiento').val();
	nvlipress = $('#nivelipress').val();
	$.ajax({
		method: 'POST',
		url: 'App/controller/controller.php',
		data: {
			accion: 'FILTRAR_PROCEDIMIENTO',
			filtro: filtro,
			nvlipress: nvlipress
		}
	}).done(function(respuesta) {
		$('#tbcpt').html(respuesta);
	});
}
function mostrarNivel(ipress) {
	if (ipress === 'HOSPITAL NACIONAL PNP GRAL PNP LUIS N. SAENZ') nvl = 'nvl3';
	else if (
		ipress === 'HOSPITAL PNP "AUGUSTO B. LEGUIA"' ||
		ipress === 'HOSPITAL GERIATRICO PNP SAN JOSE' ||
		ipress === 'HOSPITAL REGIONAL POLICIAL CHICLAYO' ||
		ipress === 'HOSPITAL REGIONAL POLICIAL AREQUIPA'
	)
		nvl = 'nvl2';
	else nvl = 'nvl1';
	$('#nivelipress').val(nvl);
	$('#btnExcel').prop('href', 'resources/libraries/Excel/tarifario.php?nvl=' + nvl);
	return nvl;
}
