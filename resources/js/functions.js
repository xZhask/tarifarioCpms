/* window.addEventListener('load', () => {
	const contLoader = document.querySelector('.preloader');
	contLoader.style.opacity = 0;
	contLoader.style.visibility = 'hidden';
}); */
const listadoUnidades = ListarUnidades();
const nombreUnidades = listadoUnidades.map((unidad) => unidad.ipress);
let nivel;
function ListarUnidades() {
	let resultado;
	$.ajax({
		type: 'POST',
		url: 'App/controller/controller.php',
		data: {
			accion: 'LISTAR_UNIDADES'
		},
		async: false,
		dataType: 'JSON',
		error: function() {
			alert('Error occured');
		},
		success: function(respuesta) {
			resultado = respuesta;
		}
	});
	return resultado;
}

$(document).ready(function() {
	$('#ipress').autocomplete({
		source: nombreUnidades,
		select: function(event, item) {
			let unidad = item.item.value;
			let position = nombreUnidades.indexOf(unidad);
			nivel = listadoUnidades[position].nivel;
			console.log(nivel);
			$('#procedimiento').val('');
			$.ajax({
				method: 'POST',
				url: 'App/controller/controller.php',
				data: {
					accion: 'LISTAR_TARIFARIO',
					nvlipress: nivel
				}
			}).done(function(respuesta) {
				$('#tbcpt').html(respuesta);
				$('.bg-dark').css('display', 'none');
				document.getElementById('ipress').blur();
				$('#btnExcel').prop('href', `resources/libraries/Excel/tarifario.php?nvl=${nivel}`);
			});
		}
	});
});

function FiltrarProcedimientos() {
	let filtro = $('#procedimiento').val();
	$.ajax({
		method: 'POST',
		url: 'App/controller/controller.php',
		data: {
			accion: 'FILTRAR_PROCEDIMIENTO',
			filtro: filtro,
			nvlipress: nivel
		}
	}).done(function(respuesta) {
		$('#tbcpt').html(respuesta);
	});
}
const txtProcedimiento = document.querySelector('#procedimiento');
txtProcedimiento.addEventListener('keyup', FiltrarProcedimientos);

posicionarBuscador();

$(window).scroll(function() {
	posicionarBuscador();
});

function posicionarBuscador() {
	var alturaHeader = $('header').outerHeight(true);

	if ($(window).scrollTop() >= alturaHeader) {
		$('.cont-search').addClass('fixed');
		$('.cont-table').css('margin-top', '135px');
	} else {
		$('.cont-search').removeClass('fixed');
		$('.cont-table').css('margin-top', '0');
	}
}
