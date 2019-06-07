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
  $codigoE = base64_decode($_GET['id']);
  //Codigo Paciente
  $codigoP = base64_decode($_GET['codigo']);	
  include('header.php');
  include ('conexion.php');
?>

 <p id="titulo-pagina">Agregar ectoparásito</p> 

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
  document.getElementById('inputFechaCad').value=ano+"-"+mes+"-"+dia;
}
</script>
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
      <label id="lblProducto"> Producto </label>
      <select id="inputProductoE" name="ecto" onchange="ShowSelected();">
        <option value="0">Elegir producto</option>
        <?php
        $consulta = "SELECT iCodProducto, vchDescripcion FROM CatProductos WHERE iCodTipoProducto = 4 AND iCodEmpresa = '$codigoE'";
        $result = mysqli_query($conn,$consulta);
        while ($producto = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $producto['iCodProducto']; ?>"> <?php echo $producto['vchDescripcion']; ?></option>
          <?php
                  }
        ?>
      </select>

      <script type="text/javascript">
          function ShowSelected(){
          var iCodProducto = document.getElementById("inputProductoE").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerLote_Ecto.php', { iCodProducto: iCodProducto, id: id }, function(data){
              $('#inputLoteEcto').html(data);
                  }); 
          }
        </script>

      <label id="lblLote"> Lote </label>
      <select id="inputLoteEcto" name="lote"> </select>
      <label id="lblPrecio">Precio</label>
      <input type="text" id="inputPrecio" name="dia">
      <label for="inputfechacad" id="lblFechaCad">Caducidad</label>
      <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
  </div>
  <script>
        function habilitar(value)
        {
        if(value==true)
        {
        document.getElementById("motivoCita").disabled=false;
        document.getElementById("fechaCita").disabled=false;
        document.getElementById("inputHoraCita").disabled=false;

        }else if(value==false){
        // deshabilitamos
        document.getElementById("motivoCita").disabled=true;
        document.getElementById("fechaCita").disabled=true;
        document.getElementById("inputHoraCita").disabled=true;

      }
    }
  </script>
      <div class="form-right">
        <div class="form-group">
        <label id="lblCitaP">Programar ectoparásito</label>
        <input type="checkbox" id="inputCitaP" name="dia" onchange="habilitar(this.checked);" checked>
      </div>
        <input type="text" id="motivoCita" name="lote" value="ECTOPARÁSITOS">
      <div class="form-group">
        <label id="lblFechaCita"> Fecha </label>
        <input type="date" name="fecha" id="fechaCita">
        </div>
        <div class="form-group">
        <label id="lblHoraCita"> Hora </label>
        <input type="time" name="hora" id="inputHoraCita">
      </div>
        <button class="boton" type="submit">Agregar ectoparásito</button>
      </div>
    </div>
</form>  
</div>  
</body>
</html>