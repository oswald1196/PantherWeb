<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Agenda</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/agendas.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/estilos.css" />

	</head>

	<body>

<?php
	include('header.php');

?>

<form class="navbar-form">
      <div class="form-group">
        <input type="text" placeholder="&#xe003" name="search">
      </div>
    </form> 
 <h1 class="page-header" align="center" color="white">AGENDA <i class="fas fa-calendar-alt"></i></h1> 

<form class="main-form">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="inputfecha1">Fecha <i class="fas fa-calendar-alt"></i></label>
      <input type="date" class="form-control" id="inputfecha1">
    </div>
    <div class="col-md-4 mb-3">
      <label for="inputhoraini">Hora inicio <i class="fas fa-hourglass-start"></i> </label>
      <input type="time" class="form-control" id="inputhoraini">
    </div>
  <div class="col-md-4 mb-3">
    <label for="inputHoraFin">Hora fin <i class="fas fa-hourglass-end"></i></label>
    <input type="time" class="form-control" id="inputHoraFin">
  </div>
 </div>
  <div class="form-row">
  	<div class="col-md-3 mb-3">
      <label for="inputState">Motivos</label>
      <select id="inputState" class="form-control">
        <option selected>Motivo</option>
        <option>...</option>
      </select>
    </div>
  	<div class="col-md-6 md-3">
    <label for="inputMotivo">Agregar motivo</label>
    <input type="text" class="form-control" id="inputMotivo" placeholder="Escribe el nuevo motivo">
  	<button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i></button>
  	</div>
    
  </div>
	<div class="form-group">
  		<button type="submit" class="btn btn-primary">Agregar</button>
 	</div>
</form>    
</body>
</html>