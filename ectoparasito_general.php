<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Ectoparásito</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/preventivos_grales.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/estilos.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	</head>

	<body>

<?php
  $codigoE = base64_decode($_GET['id']);
  //Codigo Paciente
  $fecha_actual = date("Y-m-d");

  include('header.php');
  include ('conexion.php');
?>

 <p id="titulo-pagina">Agregar ectoparásito </p> 

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
<form class="form_add_cita" id="frmEcto" action="" method="POST" onsubmit="return validarEcto();">
    <div>
    <label id="lblPacientesV">Paciente</label>
    <select id="selectPacienteV" name="paciente">
        <option value="">Elige paciente</option>
    <?php 
    $sql = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = '$codigoE' ORDER BY vchNombrePaciente";
    $query = mysqli_query($conn,$sql);
        while ($pacientes = mysqli_fetch_array($query)) {
          ?>
          <option value ="<?php echo $pacientes['iCodPaciente'];?>"> <?php echo $pacientes['vchNombrePaciente']." -- ".$pacientes['vchNombre']." ".$pacientes['vchPaterno']." ".$pacientes['vchMaterno'] ?></option>
          <?php
            }
        ?>
      </select>    </div>
  <div id="contenedor">
  <div class="form-leftV">
      <label id="lblFecha">Fecha</label>
      <input type="date" class="input-append date" id="inputfecha" name="fecha" tabindex="1">
      <input type="hidden" name="empresa" value="<?php echo $codigoE ?>">
      <label id="lblProducto"> Producto </label>
      <select id="inputProductoE" name="ecto" onchange="ShowSelected(); obtenerPrecioEcto();">
        <option value="">ELEGIR PRODUCTO</option>
        <?php
        $consulta = "SELECT iCodProducto, vchDescripcion FROM CatProductos WHERE iCodTipoProducto = 4 AND iCodEmpresa = '$codigoE' ORDER BY vchDescripcion ASC";
        $result = mysqli_query($conn,$consulta);
        while ($producto = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $producto['iCodProducto']; ?>"> <?php echo $producto['vchDescripcion']; ?></option>
          <?php
                  }
        ?>
      </select>

      <script type="text/javascript">
      function validarEcto() {
      var txtEcto = document.getElementById("inputProductoE").value;
      var txtLote = document.getElementById("inputLoteEcto").value;
      var fechaCad = document.getElementById("inputFechaCad").value;
      var fechaHoy = document.getElementById("fechaActual").value;
      var fechaDeCita = document.getElementById("fechaCita").value;
      var valorPaciente = document.getElementById("selectPacienteV").value;
      var datos = $('#frmEcto').serialize();

      if(valorPaciente == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'Elige paciente'
        });
        return false;
      }

      if(txtEcto == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'Elige producto'
        });
        return false;
      }

      if(txtLote == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'Elige lote'
        });
        return false;
      }

      if(fechaCad < fechaHoy){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'Producto caducado'
        });
        return false;
      }

      $.ajax({
        type: "POST",
        url: "insertar_ecto_general.php",
        data: datos,
        success:function(r){
          if (r==1){
            alert("Error");
          }
          else{
            Swal.fire({
          type:'success',
          title: 'Correcto',
          text:'Ectoparásito agregado correctamente'
          }) 
          }
        }
      });
      return false;

            return true;
        }
      </script>
      <script type="text/javascript">
          function ShowSelected(){
          var iCodProducto = document.getElementById("inputProductoE").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerLote_Ecto.php', { iCodProducto: iCodProducto, id: id }, function(data){
              $('#inputLoteEcto').html(data);
                  }); 
          }
        </script>

      <script type="text/javascript">
          function obtenerPrecioEcto(){
          var iCodProducto = document.getElementById("inputProductoE").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerPrecioEcto.php', { iCodProducto: iCodProducto, id: id }, function(data){
              $('#inputPrecio').html(data);
              document.getElementById("inputPrecio").value = data;
                  }); 
          }
        </script>

      <script type="text/javascript">
          function precioEcto(){
          var iCodProductoLote = document.getElementById("inputLoteEcto").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerPrecioEctoLote.php', { iCodProductoLote: iCodProductoLote, id: id }, function(data){
              $('#precio').html(data);
              document.getElementById("inputPrecio").value = data;
                  }); 
          }
      </script>

      <script type="text/javascript">
          function getCaducidad(){
          var iCodProductoLote = document.getElementById("inputLoteEcto").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerCaducidadEcto.php', { iCodProductoLote: iCodProductoLote, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCad").value = data;
                  }); 
          }
      </script>

      <label id="lblLote"> Lote </label>
      <select id="inputLoteEcto" name="lote" onchange="precioEcto(); getCaducidad();"> </select>
      <label id="lblPrecio">Precio</label>
      <input type="text" id="inputPrecio" name="dia">
      <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">
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
        document.getElementById("fechaCita").value="-";
        document.getElementById("inputHoraCita").disabled=true;
        document.getElementById("inputHoraCita").value="00:00";

      }
    }
  </script>
      <div class="form-right">
        <div class="form-group">
        <label id="lblCitaP">Programar ectoparásito</label>
        <input type="checkbox" id="inputCitaP" name="dia" onchange="habilitar(this.checked);" checked>
      </div>
        <input type="text" id="motivoCita" name="motivoCitaEcto" value="ECTOPARÁSITOS">
      <div class="form-group">
        <label id="lblFechaCita"> Fecha </label>
        <input type="date" id="fechaCita" name="fechaProx">
        </div>
        <div class="form-group">
        <label id="lblHoraCita"> Hora </label>
        <input type="time" name="horaProx" id="inputHoraCita">
      </div>
        <button class="boton" type="submit">Agregar ectoparásito</button>
      </div>
    </div>
</form>  
</div>  
</body>
</html>