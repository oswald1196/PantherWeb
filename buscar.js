$(buscar_datos());

function buscar_datos(consulta){
	$.ajax({
		var id = <?= json_encode($codigo) ?>;

		url: 'buscar.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta, id: id},
	})
	.done(function(respuesta){
		$('#datos').html(respuesta);
	});
}

$(document).on('keyup', '#caja_busqueda', function(){
	var valor = $(this).val();

	if (valor != "") {
		buscar_datos(valor);
	}
	else{
		buscar_datos();
	}

});
