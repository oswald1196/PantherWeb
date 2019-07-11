<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Desparasitación</title>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	</head>

	<body>

<?php
$codigoE = base64_decode($_GET['id']);

$fecha_actual = date("Y-m-d");

  //Codigo Paciente
  $codigoP = base64_decode($_GET['codigo']);	
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
  document.getElementById('inputFechaCad').value=ano+"-"+mes+"-"+dia;
}
</script>
 <p id="titulo-pagina">Agregar desparasitación</p> 

<div class="container">
<form class="form_add_cita" action="" method="POST" onsubmit=" return validadDesp();">
    <?php 
    $sql = "SELECT * FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="contenedor-titulo">
      <p id="lblCita"> Paciente: <?php echo $row['vchNombrePaciente']; ?> </p>
        <input type="hidden" name="correo" value="<?php echo $row['vchCorreo'] ?>">
        <input type="hidden" name="empresa" value="<?php echo $row['iCodEmpresa'] ?>">
        <input type="hidden" name="pais" value="<?php echo $row['vchPais'] ?>">
        <input type="hidden" name="estado" value="<?php echo $row['vchEstado'] ?>">
        <input type="hidden" name="ciudad" value="<?php echo $row['vchCiudad'] ?>">
        <input type="hidden" name="paciente" value="<?php echo $row['iCodPaciente'] ?>">
    </div>
  <div id="contenedor">
  <div class="form-left">
      <label id="lblFecha">Fecha</label>
      <input type="date" class="input-append date" id="inputfecha" name="fecha" tabindex="1">
      <label id="lblProducto"> Servicio </label>
      <select id="inputProducto" name="codigoServicio">
        <option value="">Elegir servicio</option>
        <?php
        $consulta = "SELECT * FROM CatServicios WHERE iCodTipoServicio = 3 ORDER BY iCodServicio";
        $result = mysqli_query($conn,$consulta);
        while ($servicio = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $servicio['iCodServicio']?>"><?php echo $servicio['vchDescripcion']?></option>';
          <?php
                  }
        ?>
      </select>
      <label id="lblProducto"> Desparasitante </label>
      <select id="inputProductoD" name="codigoDesp" onchange="ShowSelected(); precioDesp();">
        <option value="">Elegir desparasitante</option>
        <?php
        $consulta = "SELECT iCodProducto, vchDescripcion FROM CatProductos WHERE iCodTipoProducto = 3 AND iCodEmpresa = '$codigoE' ORDER BY vchDescripcion ASC";
        $result = mysqli_query($conn,$consulta);
        while ($producto = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $producto['iCodProducto'];?>"> <?php echo $producto['vchDescripcion']; ?></option>
          <?php
                  }
        ?>
      </select>

      <script type="text/javascript">
          function ShowSelected(){
          var codigoProducto = document.getElementById("inputProductoD").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerLote_Desp.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputLote').html(data);
                  }); 
          }
        </script>

        <script type="text/javascript">
          function precioDesp(){
          var codigoProducto = document.getElementById("inputProductoD").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerPrecioDesp.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputPrecioVac').html(data);
              document.getElementById("inputPrecio").value = data;

                  });
          }

          function precioDespLote(){
          var codigoProducto = document.getElementById("inputLote").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerPrecioLoteDesp.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputPrecio").value = data;

                  });
          }

          function caducidadDesp(){
          var codigoProducto = document.getElementById("inputLote").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerCaducidadDesp.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCad").value = data;

                  });
          }
       </script>

      <label id="lblLote"> Lote </label>
      <select id="inputLote" name="codLote" onchange="precioDespLote(); caducidadDesp();"> </select>

      <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">

      <label id="lblPrecio">Precio</label>
      <input type="text" id="inputPrecio" name="precio">
      <label for="inputfechacad" id="lblFechaCad">Caducidad</label>
      <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
      <label id="lblPesoD">Peso</label>
      <input type="text" id="inputPesoD" name="peso">
      <label id="lblCantidad">Cantidad</label>
      <input type="text" id="inputCantidadD" name="cantidad">
      </div>
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
        document.getElementById("motivoCita").value="-";

        document.getElementById("fechaCita").disabled=true;
        document.getElementById("fechaCita").value="-";
        
        document.getElementById("inputHoraCita").disabled=true;
        document.getElementById("inputHoraCita").value="00:00";
      }
    }
  </script>

  <script type="text/javascript">
      function validadDesp() {
      var txtServicio = document.getElementById("inputProducto").value;
      var txtDesp = document.getElementById("inputProductoD").value;
      var txtLote = document.getElementById("inputLote").value;
      var fechaCad = document.getElementById("inputFechaCad").value;
      var fechaHoy = document.getElementById("fechaActual").value;

      
      if(txtServicio == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ERROR: Elige servicio'
      });
        return false;
      }

      if(txtDesp == ""){
        Swal.fire({
        type:'error',
          title:'ERROR',
          text:'ERROR: Elige producto'
      });
        return false;
      }

      if(txtLote == ""){
        Swal.fire({
        type:'error',
          title:'ERROR',
          text:'ERROR: Elige lote'
      });
        return false;
      }

      if(fechaCad < fechaHoy){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ERROR: Producto caducado'
      });

        return false;
      }
          return true;
        }
      </script>
      <div class="form-right">
        <div class="form-group">
        <label id="lblCitaP">Programar cita</label>
        <input type="checkbox" id="inputCitaP" onchange="habilitar(this.checked);" name="dia" checked>
      </div>
        <input type="text" name="motivoCita" id="motivoCita" value="DESPARASITACIÓN">
      </select>
        <div class="form-group">
        <label id="lblFechaCita"> Fecha </label>
        <input type="date" name="fechaCita" id="fechaCita">
        </div>
        <div class="form-group">
        <label id="lblHoraCita"> Hora </label>
        <input type="time" name="hora" id="inputHoraCita">
      </div>
        <button class="boton" name="submit" type="submit">Agregar desparasitación</button>
      </div>
    </div>
</form>  
</div>  
</body>
</html>