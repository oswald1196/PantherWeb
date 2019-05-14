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

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<script type="text/javascript" src="peticion.js"></script>

	</head>

	<body class="login-layout">

<?php
	include('header.php');

?>

<form class="navbar-form">
      <div class="form-group">
        <input type="text" class="form-control input-group-text" aria-label="Large" name="search" id="search"> <i class="fas fa-plus-square"></i>
      </div>
</form>

    <style type="text/css">
    	h1 {
    		color: white;
    	}
    </style>
<h1 class="page-header" align="center">LISTADO DE PACIENTES</h1>
    
<section id="tabla_resultado">

</section>
</body>
</html>