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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/estilos.css" />

	</head>

	<body>

<?php
	include('header.php');

?>

 <p class="page-header" align="center" color="white">AGENDA <i class="fas fa-calendar-alt"></i></p> 

<div class="container-fluid">
<form class="main-form col-xl-12">
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label for="inputfecha1">Fecha</label>
      <input type="date" class="form-control input-append date" id="inputfecha1">
    </div>
    <div class="col-md-3 mb-3">
      <label for="inputhoraini">Hora inicio </label>
      <input type="time" class="form-control" id="inputhoraini">
    </div>
  <div class="col-md-3 mb-3">
    <label for="appt">Hora fin <i class="fas fa-hourglass-end"></i></label>
    <input type="time" class="form-control" id="appt">
  </div>
 </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label for="inputMotivos" class="lblMotivos">Motivos</label>
      <select id="inputMotivos" class="form-control">
        <option value=0>Seleccione un motivo</option>
        <?php
        $consulta = "SELECT * FROM CatMotivos";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchMotivo'].'</option>';
                  }
        ?>
      </select>
    </div>
  	<div class="col-md-5">
    <label for="inputMotivo" class="lblMotivoC">Agregar nueva cita</label>
    <input type="text" class="form-control" id="inputMotivo" placeholder="Escribe el nuevo motivo">
  	<button type="submit" class="input-group-append" id="btnAddMotivo"><i class="fas fa-plus-square"></i></button>
  	</div>  
  </div>
    <div class="form-group col-md-5">
      <div class="boton">
      <button type="submit" class="form control btn btn-primary">Agregar cita</button>
      </div>
	   </div>
</form>  
</div>  
</body>
</html>