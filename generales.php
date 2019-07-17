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

	include('header.php');

?>
<div class="container">
<div id="opc_agenda">
	<a id="a_ecto" href="agenda_generales.php?id=<?php echo $codigoE?>"> <h1>Citas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/calendar.png"> </a>
</div>

<div id="opc_estetica">
	<a id="a_ecto" href="estetica_generales.php?id=<?php echo $codigoE?>"> <h1> Estéticas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/hair-dryer.png"> </a>
</div>

<div id="opc_vacuna">
	<a id="a_ecto" href="vacunas_generales.php?id=<?php echo $codigoE?>"> <h1> Vacunas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/syringe.png"> </a>
</div>

<div id="opc_desp">
	<a id="a_ecto" href="desparasitaciones_generales.php?id=<?php echo $codigoE?>"> <h1>Desparasitaciones </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/caterpillar.png"> </a>
</div>


<div id="opc_ecto">
	<a id="a_ecto" href="ectoparasito_general.php?id=<?php echo $codigoE?>"> <h1>Ectoparásitos </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/insect.png"> </a>
</div>
<div id="opc_consulta">
	<a id="a_consulta" href="consultas_generales.php?id=<?php echo $codigoE?>"> <h1>Consultas </h1> <img src="https://img.icons8.com/ultraviolet/100/000000/stethoscope.png">  </a>
</div>
</div>
</body>
