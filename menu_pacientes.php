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
	$codigo = $_GET['id'];
	$codigoPaciente = $_GET['cod'];
	$cMedico = $_GET['cm'];

	include('header.php');

?>
<div class="container">
<div id="opc_agenda">
	<a id="a_ecto" href="panel_agenda.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>&cm=<?php echo base64_encode($cMedico)?>"> <span id="titulo_citas">Citas </span> <img id="img_cal" src="https://img.icons8.com/ultraviolet/100/000000/calendar.png"> </a>
</div>

<div id="opc_estetica">
	<a id="a_ecto" href="panel_estetica.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <span id="titulo_est"> Estéticas </span> <img id="img_est" src="https://img.icons8.com/ultraviolet/100/000000/hair-dryer.png"> </a>
</div>

<div id="opc_vacuna">
	<a id="a_ecto" href="vacunas_carnet.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <span id="titulo_vac"> Vacunas </span> <img id="img_vac" src="https://img.icons8.com/ultraviolet/100/000000/syringe.png"> </a>
</div>

<div id="opc_desp">
	<a id="a_ecto" href="desp_carnet.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <span id="titulo_desp">Desparasitaciones </span> <img id="img_desp" src="https://img.icons8.com/ultraviolet/100/000000/caterpillar.png"> </a>
</div>


<div id="opc_ecto">
	<a id="a_ecto" href="ecto_carnet.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <span id="titulo_ecto"> Ectoparásitos </span> <img id="img_ecto" src="https://img.icons8.com/ultraviolet/100/000000/insect.png"> </a>
</div>
<div id="opc_consulta">
	<a id="a_consulta" href="informe_medico.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <span id="titulo_consultas">Consultas </span> <img id="img_inf" src="https://img.icons8.com/ultraviolet/100/000000/stethoscope.png">  </a>
</div>
</div>
</body>
