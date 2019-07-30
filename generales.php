<?php

require 'conexion.php';
session_start();

if ($_SESSION["autenticado"] != "SI") {
  header("Location: index.html");
}
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
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	</head>

	<body>

<?php
	$codigoE = $_GET['id'];

	include('header.php');

?>
<div class="container">
<div id="opc_agenda">
	<a id="a_ecto" href="agenda_generales.php?id=<?php echo $codigoE?>"> <span id="titulo_citas">Citas </span> <img id="img_cal" src="https://img.icons8.com/ultraviolet/100/000000/calendar.png"> </a>
</div>

<div id="opc_estetica">
	<a id="a_ecto" href="estetica_generales.php?id=<?php echo $codigoE?>"> <span id="titulo_est"> Estéticas </span> <img id="img_est" src="https://img.icons8.com/ultraviolet/100/000000/hair-dryer.png"> </a>
</div>

<div id="opc_vacuna">
	<a id="a_ecto" href="vacunas_generales.php?id=<?php echo $codigoE?>"> <span id="titulo_vac"> Vacunas </span> <img id="img_vac" src="https://img.icons8.com/ultraviolet/100/000000/syringe.png"> </a>
</div>

<div id="opc_desp">
	<a id="a_ecto" href="desparasitaciones_generales.php?id=<?php echo $codigoE?>"> <span id="titulo_desp">Desparasitaciones </span> <img id="img_desp" src="https://img.icons8.com/ultraviolet/100/000000/caterpillar.png"> </a>
</div>


<div id="opc_ecto">
	<a id="a_ecto" href="ectoparasito_general.php?id=<?php echo $codigoE?>"> <span id="titulo_ecto">Ectoparásitos </span> <img id="img_ecto" src="https://img.icons8.com/ultraviolet/100/000000/insect.png"> </a>
</div>
<div id="opc_consulta">
	<a id="a_consulta" href="consultas_generales.php?id=<?php echo $codigoE?>"> <span id="titulo_consultas">Consultas </span> <img id="img_inf" src="https://img.icons8.com/ultraviolet/100/000000/stethoscope.png">  </a>
</div>
</div>
</body>
