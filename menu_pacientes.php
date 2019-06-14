<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Menú Pacientes</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/menu_pacientes.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />

	</head>

	<body>

<?php
	$codigoE = $_GET['id'];
	$codigoPaciente = $_GET['cod'];
	$correo = $_GET['mail'];
    $pais = $_GET['p'];
    $estado = $_GET['e'];
    $ciudad = $_GET['c'];

	include('header.php');

?>
<div class="container">
<div id="opc_agenda">
	<a id="a_ecto" href="agenda_agregar.php?id=<?php echo base64_encode($codigoE)?>&co=<?php echo base64_encode($correo)?>&p=<?php echo base64_encode($pais)?>&e=<?php echo base64_encode($estado)?>&c=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> <h1>Citas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/calendar.png"> </a>
</div>

<div id="opc_estetica">
	<a id="a_ecto" href="agenda_estetica_agregar.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> <h1> Estéticas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/hair-dryer.png"> </a>
</div>

<div id="opc_vacuna">
	<a id="a_ecto" href="vacunas_carnet.php?id=<?php echo base64_encode($codigoE)?>&co=<?php echo base64_encode($correo)?>&p=<?php echo base64_encode($pais)?>&e=<?php echo base64_encode($estado)?>&c=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> <h1> Vacunas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/syringe.png"> </a>
</div>

<div id="opc_desp">
	<a id="a_ecto" href="desparasitacion.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> <h1>Desparasitaciones </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/caterpillar.png"> </a>
</div>


<div id="opc_ecto">
	<a id="a_ecto" href="ectoparasito.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> <h1>Ectoparásitos </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/insect.png"> </a>
</div>
<div id="opc_consulta">
	<a id="a_consulta" href="consultas.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> <h1>Consultas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/stethoscope.png">  </a>
</div>
</div>
</body>
