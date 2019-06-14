<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Buscar Pacientes</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/tablas.css" />

  		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<script src="buscar.js"></script>


	</head>

	<body class="login-layout">

<?php
    $codigoE = base64_decode($_GET['id']);
	include('header.php');
	include('conexion.php');
?>

      <div class="form-busqueda">
     	<label for="caja_busqueda" id="lblBusqueda"> Buscar </label>
     	<?php echo $codigoE?>
        <input type="text" name="caja_busqueda" id="caja_busqueda">
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
</table>
</body>
</html>