<!DOCTYPE html>
<?php
session_start();
//echo $_SESSION["autenticado"];

if ($_SESSION["autenticado"] != "SI") {
 	header("Location: index.html");
}
?>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Buscar Pacientes</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

		<link rel="stylesheet" href="assets/css/tablas.css" />

  		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<!--<script src="buscar.js"></script>-->


	</head>

	<body class="login-layout">

<?php
    $codigo = base64_decode($_GET['id']);
	$cMedico = base64_decode($_GET['cm']);
    
	include('header.php');
	include('conexion.php');
?>

      <div class="form-busqueda">
     	<!--<label for="caja_busqueda" id="lblBusqueda" > Buscar </label>-->
     	<!--<div data-tip="Puedes realizar la búsqueda por raza, nombre de paciente, fecha de nacimiento; nombre, apellido paterno, teléfono o correo del propietario">-->
        <input type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar">
    	</div>
      </div>


    <style type="text/css">
    	h1 {
    		margin-top: 30px;
    		color: white;
  			font-family: 'Nunito', sans-serif;	
    	}
    </style>
<h1 align="center">LISTADO DE PACIENTES</h1>
 
		<div id="datos">
			
		</div>

<script type="text/javascript">
$(buscar_datos());

function buscar_datos(consulta){
    var id = <?= json_encode($codigo) ?>;
    var cm = <?= json_encode($cMedico) ?>;
	$.ajax({
		url: 'buscar.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta, id: id, cm: cm},
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

</script>

</table>
</body>
</html>