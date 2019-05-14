$(obtener_registros());

function obtener_registros(afiliado){
	$.ajax({
		url: 'consulta.php',
		type: 'POST',
		dataType: 'html',
		data: { afiliado: afiliado },
	})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	});
}

$(document).on('keyup', '#search', function(){
	var valorBusqueda = $(this).val();
		if (valorBusqueda!=""){
			obtener_registros(valorBusqueda);
		}
		else{
			obtener_registros();
		}
});
