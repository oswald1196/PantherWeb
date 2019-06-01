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
<script type="text/javascript">
window.onload = function(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('inputfecha').value=ano+"-"+mes+"-"+dia;
  document.getElementById('fechaCita').value=ano+"-"+mes+"-"+dia;
}
</script>
 <p id="titulo-pagina">Agregar desparasitación</p> 

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
      <label id="lblProducto"> Servicio </label>
      <select id="inputProducto" name="vacuna">
        <option value=0>Elegir servicio</option>
        <?php
        $consulta = "SELECT * FROM CatProductos WHERE iCodTipoProducto = 5";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchDescripcion'].'</option>';
                  }
        ?>
      </select>
      <label id="lblProducto"> Desparasitante </label>
      <select id="inputProducto" name="vacuna">
        <option value=0>Elegir desparasitante</option>
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
      <label for="inputfechacad" id="lblFechaCad">Caducidad</label>
      <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
      <div class="form-group">
      <label id="lblPesoD">Peso</label>
      <input type="text" id="inputPesoD" name="peso">
      <label id="lblCantidad">Cantidad</label>
      <input type="text" id="inputCantidad" name="peso">
      </div>
  </div>
      <div class="form-right">
        <div class="form-group">
        <label id="lblCitaP">Programar cita</label>
        <input type="checkbox" id="inputCitaP" name="dia">
      </div>
        <input type="text" name="" id="motivoCita" value="Desparasitación">
      </select>
        <div class="form-group">
        <label id="lblFechaCita"> Fecha </label>
        <input type="date" name="fecha" id="fechaCita">
        </div>
        <div class="form-group">
        <label id="lblHoraCita"> Hora </label>
        <input type="time" name="hora" id="inputHoraCita">
      </div>
        <button class="boton" type="submit">Agregar desparasitación</button>
      </div>
    </div>
</form>  
</div>  
</body>
</html>