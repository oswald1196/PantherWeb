<?php

require 'conexion.php';
session_start();

if ($_SESSION["autenticado"] != "SI") {
  header("Location: index.html");
}

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
  $codigo = base64_decode($_GET['id']);
  $cMedico = base64_decode($_GET['cm']);

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
  document.getElementById('inputfechaD').value=ano+"-"+mes+"-"+dia;
  document.getElementById('fechaCita').value=ano+"-"+mes+"-"+dia;
  document.getElementById('inputFechaCadDes').value=ano+"-"+mes+"-"+dia;
}
</script>
<p id="titulo-pagina">Agregar desparasitación</p> 

<div class="container">
  <form class="form_add_cita" id="frmDesp" action="insertar_desparasitacion.php" method="POST" onsubmit=" return validarDesp();">
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
      <input type="hidden" name="propietario" value="<?php echo $row['iCodPropietario'] ?>">

    </div>
    <div id="contenedor">
      <div class="form-left">
        <label id="lblFechaDes">Fecha</label>
        <input type="date" class="input-append date" id="inputfechaD" name="fecha" tabindex="1">
        <label id="lblProductoDes"> Servicio </label>
        <select id="inputProductoDes" name="codigoServicio">
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
        <label id="lblProductoDesp"> Desparasitante </label>
        <select id="inputProductoD" name="codigoDesp" onchange="ShowSelected(); precioDesp(); stockDesparasitante(); stockMinimoDesp(); getTipo();">
          <option value="">Elegir desparasitante</option>
          <?php
          $consulta = "SELECT iCodProducto, vchDescripcion FROM CatProductos WHERE iCodTipoProducto = 3 AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion ASC";
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
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerLote.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputLoteDes').html(data);
            }); 
          }
        </script>

        <script type="text/javascript">
          function precioDesp(){
            var codigoProducto = document.getElementById("inputProductoD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecio.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputPrecioVac').html(data);
              document.getElementById("inputPrecioDes").value = data;

            });
          }

          function stockDesparasitante(){
            var codigoProducto = document.getElementById("inputProductoD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStock.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#stockD').html(data);
              document.getElementById("inputStockDesp").value = data;
              if(data == 0){
                Swal.fire({
                  type:'warning',
                  title:'ERROR',
                  text:'¡EL DESPARASITANTE SELECCIONADO NO TIENE LOTES, FAVOR DE SELECCIONAR OTRO!'
                });
                document.getElementById("inputLoteDes").disabled=true;
              }
              else {
                document.getElementById("inputLoteDes").disabled=false;

              }
            });
          }

          function stockMinimoDesp(){
            var codigoProducto = document.getElementById("inputProductoD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStockMinimo.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#stockMin').html(data);
              document.getElementById("inputStockMinDesp").value = data;
              var stock = document.getElementById("inputStockDesp").value;
              if(data != 0 && data == stock){
                Swal.fire({
                  type:'warning',
                  title:'PRECAUCIÓN',
                  text:'¡EL NÚMERO DE ARTÍCULOS QUE ESTÁ VENDIENDO LO DEJARÁ POR DEBAJO DEL STOCK MÍNIMO!'
                });
              }
            });
          }

          function precioDespLote(){
            var codigoProducto = document.getElementById("inputLoteDes").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecioLote.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputPrecioDes").value = data;

            });
          }

          function caducidadDesp(){
            var codigoProducto = document.getElementById("inputLoteDes").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerCaducidad.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCadDes").value = data;

            });
          }

          function stockXLote(){
            var codigoProducto = document.getElementById("inputLoteDes").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStockXLote.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputStockLote").value = data;

            });
          }

          function getTipo(){
            var codigoProducto = document.getElementById("inputProductoD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerTipoProducto.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("tipoProducto").value = data;
            });
          }
        </script>

        <label id="lblLoteDesp"> Lote </label>
        <select id="inputLoteDes" name="codLote" onchange="precioDespLote(); caducidadDesp(); stockXLote();"> </select>

        <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">
        <input type="hidden" id="inputStockDesp">
        <input type="hidden" id="inputStockMinDesp">
        <input type="hidden" id="inputStockLote">
        <input type="hidden" id="tipoProducto">

        <label id="lblPrecioDes">Precio</label>
        <input type="text" id="inputPrecioDes" name="precio" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label for="inputfechacad" id="lblFechaCadDes">Caducidad</label>
        <input type="date" class="input-append date" id="inputFechaCadDes" name="fechaC">
        <label id="lblPesoDes">Peso</label>
        <input type="text" id="inputPesoD" name="peso" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label id="lblCantidad">Cantidad</label>
        <input type="text" id="inputCantidadD" name="cantidad" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label id="lblDespAnt">Desparasitaciones anteriores</label>
        <input type="checkbox" id="despAnt" name="anterior" >
      </div>
    </div>
    <script>
      function habilitar(value)
      {
        if(value==true)
        {
          document.getElementById("motivoCitaDes").disabled=false;
          document.getElementById("fechaCita").disabled=false;
          document.getElementById("inputHoraCita").disabled=false;
          document.getElementById("inputMedico").disabled=false;

        }else if(value==false){
        // deshabilitamos
        document.getElementById("motivoCitaDes").disabled=true;
        document.getElementById("motivoCitaDes").value="-";

        document.getElementById("fechaCita").disabled=true;
        document.getElementById("fechaCita").value="-";
        
        document.getElementById("inputHoraCita").disabled=true;
        document.getElementById("inputHoraCita").value="00:00";

        document.getElementById("inputMedico").disabled=true;
        document.getElementById("inputMedico").value="0";
      }
    }
  </script>
  <div class="form-right">
    <div class="form-group">
      <label id="lblCitaP">Programar cita</label>
      <input type="checkbox" id="inputCitaP" onchange="habilitar(this.checked);" name="citaP" checked>
    </div>
    <input type="text" name="motivoCita" id="motivoCitaDes" value="DESPARASITACIÓN">
  </select>
  <div class="form-group">
    <label id="lblFechaCita"> Fecha </label>
    <input type="date" name="fechaCita" id="fechaCita">
  </div>
  <div class="form-group">
    <label id="lblHoraCita"> Hora </label>
    <input type="time" name="hora" value="00:00" id="inputHoraCita">
  </div>
  <select id="inputMedico" name="medico">
    <option value="0">** MÉDICO INDISTINTO **</option>
    <?php
    $sql = "SELECT * FROM CatMedico WHERE iCodEmpresa = '$codigo'";
    $resultado = mysqli_query($conn,$sql);
    while ($medico = mysqli_fetch_array($resultado)) {
      ?>
      <option value="<?php echo $medico['iCodMedico'] ?>"> <?php echo $medico['vchNombre']." ".$medico['vchPaterno'] ?> </option>
      <?php
    }
    ?>
  </select>
  <button class="boton" name="submit" type="submit">Agregar desparasitación</button>
</div>
</div>

<script type="text/javascript">
  function validarDesp() {
    var txtServicio = document.getElementById("inputProductoDes").value;
    var txtDesp = document.getElementById("inputProductoD").value;
    var txtLote = document.getElementById("inputLoteDes").value;
    var fechaCad = document.getElementById("inputFechaCadDes").value;
    var fechaHoy = document.getElementById("fechaActual").value;
    var valorCitaP = document.getElementById("inputCitaP").checked;
    var horaProx = document.getElementById("inputHoraCita").value;
    var fechaProx = document.getElementById("fechaCita").value;
    var motivoProx = document.getElementById("motivoCitaDes").value.trim();
    var cantidad = document.getElementById("inputCantidadD").value;
    var stockActual = document.getElementById("inputStockLote").value;
    var txtTipo = document.getElementById("tipoProducto").value;
    var datos = $('#frmDesp').serialize();

    if(txtServicio == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ERROR: ELIGE SERVICIO'
      });
      return false;
    }

    if(txtDesp == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ERROR: ELIGE PRODUCTO'
      });
      return false;
    }

    if(txtTipo == "Caja(s)"){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'¡ESTE PRODUCTO NO SE PUEDE APLICAR, YA QUE ES PARA VENTA POR CAJA Y NO POR PIEZA!'
      });
      return false;
    }

    if(txtLote == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ERROR: ELIGE LOTE'
      });
      return false;
    }

    if(fechaCad < fechaHoy){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ERROR: PRODUCTO CADUCADO'
      });
      return false;
    }

    if(cantidad == ""){
      document.getElementById("inputCantidadD").value = 1;
      cantidadTotal = document.getElementById("inputCantidadD").value;
    }

    if(cantidad > stockActual){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'LA CANTIDAD SOBREPASA EL STOCK ACTUAL'
      });
      return false;
    } 

    if(valorCitaP == "1" && motivoProx == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ELIGE MOTIVO DE CITA'
      });
      return false;
    }

    if(valorCitaP == "1" && fechaProx < fechaHoy){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'LA FECHA NO PUEDE SER ANTERIOR AL DÍA DE HOY'
      });
      return false;
    }

    if(valorCitaP == "1" && horaProx == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ELIGE UN HORARIO'
      });
      return false;
    }

    $.ajax({
      type: "POST",
      url: "insertar_desparasitacion.php",
      data: datos,
      success:function(r){
        if (r==1){
          alert("Error");
        }
        else{
          Swal.fire({
            type:'success',
            title: 'CORRECTO',
            text:'DESPARASITACIÓN AGREGADA CORRECTAMENTE'
          }) 
        }
      }
    });
    return false;

    return true;
  }
</script>

</form>  
</div>  
<button class="botonAtrasV" onclick="goBack();"> Atrás </button>

<script>
  function goBack() {
    window.history.go(-1);
  }
</script>
</body>
</html>