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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
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
  $codigoE = base64_decode($_GET['id']);
  $codigoP = base64_decode($_GET['codigo']);
  include('header.php');
  include ('conexion.php');
?>

 <p id="titulo-pagina">AGENDA</p> 

<div class="contenedor_principal">
<form class="form_add_cita" action="agregar_cita.php?id=<?php echo $codigoP?>" method="POST">
    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="container-titulo">
    <p id="lblCita"> Cita para <?php echo $row['vchNombrePaciente']; ?> </p>
  </div>
  <div id="fechas_cita">
      <label for="inputfecha1" id="lblFechaA">Fecha</label>
      <input type="date" class="input-append date" id="inputfecha1" name="fecha">
      <label for="inputhoraini" id="lblHoraInicio">Hora inicio </label>
      <input type="time" id="inputhoraini" name="horaInicio">
      <label for="inputMotivo" id="lblTodoDia">Todo el día</label>
      <input type="checkbox" id="chkTodoDia" name="dia">
 </div>
  <div id="div_motivos">
      <label for="inputMotivos" id="lblMotivos">Motivos</label>
      <select id="inputMotivos" name="motivo">
        <option value=0>SELECCIONE UN MOTIVO</option>
        <?php
        $consulta = "SELECT * FROM CatMotivos WHERE iCodEmpresa = '$codigoE'";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchMotivo'].'</option>';
                  }
        ?>
      </select>
    <label for="inputMotivo" id="lblNuevaCita">Escribe nueva cita</label>
    <input type="text" id="inputMotivo" placeholder="Nuevo motivo" name="nuevoMotivo">
  	<button type="submit" id="btnAddMotivo"><i class="fas fa-plus-square"></i></button>
  </div>
  <div id="div_boton">
      <button class="botonAgregar" type="submit">Agregar cita</button>
    </div>
</form>  
</div>  
</body>
</html>