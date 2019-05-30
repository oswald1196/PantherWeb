<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Vacuna</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/preventivos.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/estilos.css" />

	</head>

	<body>

<?php
  $codigoP = $_GET['id'];
	include('header.php');
  include ('conexion.php');
?>

 <p id="titulo-pagina">Agregar vacuna</p> 

<div class="container">
<form class="form_add_cita" action="" method="POST">
    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="contenedor-titulo">
      <p id="lblCita"> Paciente: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
  <div class="form-left">
      <label id="lblFecha">Fecha</label>
      <input type="date" class="input-append date" id="inputfecha" name="fecha" tabindex="1">
      <label id="lblLab" for="inputLab"> Laboratorio </label>
      <select id="inputLab" name="laboratorio" tabindex="2">
        <option value=0>Elegir laboratorio</option>
        <?php
        $consulta = "SELECT * FROM CatMarcas";
        $result = mysqli_query($conn,$consulta);
        while ($marcas = mysqli_fetch_array($result)) {
          echo '<option>'.$marcas['vchMarca'].'</option>';
                  }
        ?>
      </select>
      <label id="lblVac"> Vacuna </label>
      <select id="inputVac" name="vacuna">
        <option value=0>Elegir vacuna</option>
        <?php
        $consulta = "SELECT * FROM CatProductos WHERE iCodTipoProducto = 5";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchDescripcion'].'</option>';
                  }
        ?>
      </select>
      <label id="lblLote"> Lote </label>
      <select id="inputLote" name="lote">
        <option value=0>Elegir Lote</option>
        <?php
        $consulta = "SELECT * FROM RelProductos WHERE iCodTipoProducto = 5";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchMotivo'].'</option>';
                  }
        ?>
      </select>
      <label id="lblPrecio">Precio</label>
      <input type="text" id="inputPrecio" name="dia">
      <label for="inputfechacad" id="lblFechaCad">Fecha Cad</label>
      <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
      <label id="lblPeso">Peso</label>
      <input id="inputPeso" name="peso">
  </div>
      <div class="form-right">
        <label id="lblCitaP">Programar cita</label>
        <input type="checkbox" id="inputCitaP" class="form-inline" name="dia">
        <label id="lblCitaP">Próxima vacuna</label>
        <select id="selectProxima" name="dia"></select>
        <label id="lblFechaCita"> Fecha de la cita </label>
        <input type="date" name="fecha">
        <input type="time" name="fecha">
        <button class="boton" type="submit">Agregar vacuna</button>
      </div>
    </div>
</form>  
</div>  
</body>
</html>