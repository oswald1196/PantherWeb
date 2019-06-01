<?php

require 'conexion.php';

?>

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
		<link rel="stylesheet" href="assets/css/menu_pacientes.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />

	</head>

	<body>

<?php

	$codigoPaciente = $_GET['id'];
	include('header.php');

?>
<div class="container">
<section>
	<a href="agenda_agregar.php?id=<?php echo $codigoPaciente ?>"> <h1>Agregar cita <br> <i class="fas fa-calendar-alt"></i></h1> </a>
</section>

<section>
	<a href="#"> <h1>Agenda estética <br> <img src="https://img.icons8.com/metro/26/000000/hair-dryer.png"> </h1> </a>
</section>

<section>
	<a href="vacuna.php"> <h1>Agregar vacuna <br> <i class="fas fa-syringe"></i></h1> </a>
</section>

<section>
	<a href="desparasitacion.php"> <h1>Agregar desparasitación <br> <img src="https://img.icons8.com/metro/26/000000/caterpillar.png"> </h1> </a>
</section>

<section>
	<a href="ectoparasito.php"> <h1>Agregar ectoparásito <br> <i class="fas fa-bug"></i></h1> </a>
</section>
<section>
	<a href="#"> <h1>Agregar consulta <br> <i class="fas fa-stethoscope"></i> </h1> </a>
</section>
</div>
</body>
