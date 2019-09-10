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
  <link rel="stylesheet" href="assets/css/preventivos_grales.css" />

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
  document.getElementById('inputFechaD').value=ano+"-"+mes+"-"+dia;
  document.getElementById('fechaCitaD').value=ano+"-"+mes+"-"+dia;
  document.getElementById('inputFechaCadD').value=ano+"-"+mes+"-"+dia;
}
</script>
<p id="titulo-pagina">Agregar desparasitación</p> 

<div class="container">
  <form class="form_add_cita" id="frmDesp" action="" method="POST" onsubmit=" return validadDesp();">
    <div>
      <label id="lblPacientesD">Paciente</label>
      <select id="selectPacienteD" name="paciente">
        <option value="">Elige paciente</option>
        <?php 
        $sql = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = '$codigo' ORDER BY vchNombrePaciente";
        $query = mysqli_query($conn,$sql);
        while ($pacientes = mysqli_fetch_array($query)) {
          ?>
          <option value ="<?php echo $pacientes['iCodPaciente'];?>"> <?php echo $pacientes['vchNombrePaciente']." -- ".$pacientes['vchNombre']." ".$pacientes['vchPaterno']." ".$pacientes['vchMaterno'] ?></option>
          <?php
        }
        ?>
      </select>    
    </div>
    <div id="contenedor">
      <div class="form-leftV">
        <label id="lblFechaD">Fecha</label>
        <input type="date" class="input-append date" id="inputFechaD" name="fecha" tabindex="1">
        <input type="hidden" name="empresa" value="<?php echo $codigo ?>">

        <label id="lblProductoDes"> Servicio </label>
        <select id="inputProductoDesp" name="codigoServicio">
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
        <label id="lblProductoDespa"> Desparasitante </label>
        <select id="inputProductoDespa" name="codigoDesp" onchange="ShowSelected(); precioDesp(); stockDesparasitante(); stockMinimoD(); getTipo();">
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
            var codigoProducto = document.getElementById("inputProductoDespa").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerLote.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputLoteD').html(data);
            }); 
          }
        </script>

        <script type="text/javascript">
          function precioDesp(){
            var codigoProducto = document.getElementById("inputProductoDespa").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecio.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputPrecioVac').html(data);
              document.getElementById("inputPrecioD").value = data;

            });
          }

          function precioDespLote(){
            var codigoProducto = document.getElementById("inputLoteD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecioLote.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputPrecioD").value = data;

            });
          }

          function caducidadDesp(){
            var codigoProducto = document.getElementById("inputLoteD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerCaducidad.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCadD").value = data;

            });
          }

          function stockDesparasitante(){
            var codigoProducto = document.getElementById("inputProductoDespa").value;
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
                document.getElementById("inputLoteD").disabled=true;
              }
              else {
                document.getElementById("inputLoteD").disabled=false;

              }
            });
          }

          function stockMinimoD(){
            var codigoProducto = document.getElementById("inputProductoDespa").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStockMinimo.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#stockMin').html(data);
              document.getElementById("inputStockMinD").value = data;
              var stock = document.getElementById("inputStockDesp").value;
              if(data != 0 && data == stock){
                Swal.fire({
                  type:'warning',
                  title:'PRECAUCION',
                  text:'¡EL NÚMERO DE ARTÍCULOS QUE ESTÁ VENDIENDO LO DEJARÁ POR DEBAJO DEL STOCK MÍNIMO!'
                });
              }
            });
          }

          function stockXLote(){
            var codigoProducto = document.getElementById("inputLoteD").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStockXLote.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputStockLote").value = data;

            });
          }

          function getTipo(){
            var codigoProducto = document.getElementById("inputProductoDespa").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerTipoProducto.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("tipoProducto").value = data;
            });
          }
        </script>

        <label id="lblLoteD"> Lote </label>
        <select id="inputLoteD" name="codLote" onchange="precioDespLote(); caducidadDesp(); stockXLote();"> </select>

        <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">
        <input type="hidden" id="inputStockDesp">
        <input type="hidden" id="inputStockMinD">
        <input type="hidden" id="inputStockLote">
        <input type="hidden" id="tipoProducto">

        <label id="lblPrecioD">Precio</label>
        <input type="text" id="inputPrecioD" name="precio" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label for="inputfechacad" id="lblFechaCadD">Caducidad</label>
        <input type="date" class="input-append date" id="inputFechaCadD" name="fechaC">
        <label id="lblPesoD">Peso</label>
        <input type="text" id="inputPesoD" name="peso" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label id="lblCantidadD">Cantidad</label>
        <input type="text" id="inputCantidadD" name="cantidad" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label id="lblDespAnt">Desparasitaciones anteriores</label>
        <input type="checkbox" id="despAnt" name="anterior" >

      </div>
      <script>
        function habilitar(value)
        {
          if(value==true)
          {
            document.getElementById("motivoCita").disabled=false;
            document.getElementById("fechaCitaD").disabled=false;
            document.getElementById("inputHoraCitaD").disabled=false;

          }else if(value==false){
        // deshabilitamos
        document.getElementById("motivoCita").disabled=true;
        document.getElementById("motivoCita").value="-";

        document.getElementById("fechaCitaD").disabled=true;
        document.getElementById("fechaCitaD").value="-";
        
        document.getElementById("inputHoraCitaD").disabled=true;
        document.getElementById("inputHoraCitaD").value="00:00";
      }
    }
  </script>

  <script type="text/javascript">
    function validadDesp() {
      var txtServicio = document.getElementById("inputProductoDesp").value;
      var txtDesp = document.getElementById("inputProductoDespa").value;
      var txtLote = document.getElementById("inputLoteD").value;
      var fechaCad = document.getElementById("inputFechaCadD").value;
      var fechaHoy = document.getElementById("fechaActual").value;
      var valorPaciente = document.getElementById("selectPacienteD").value;
      var valorCitaP = document.getElementById("inputCitaP").checked;
      var valorMotivoP = document.getElementById("motivoCita").value;
      var valorFechaP = document.getElementById("fechaCitaD").value;
      var valorHoraP = document.getElementById("inputHoraCitaD").value;
      var txtCantidad = document.getElementById("inputCantidadD").value;
      var stockActual = document.getElementById("inputStockLote").value;
      var txtTipo = document.getElementById("tipoProducto").value;
      alert(txtTipo);
      var datos = $('#frmDesp').serialize();
      
      if(txtCantidad == ""){
        document.getElementById("inputCantidadD").value = 1;
        cantidadTotal = document.getElementById("inputCantidadD").value;
      }

      if(valorPaciente == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ERROR: ELIGE PACIENTE'
        });
        return false;
      }

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

      if(txtCantidad > stockActual){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'LA CANTIDAD SOBREPASA EL STOCK ACTUAL'
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

      if(valorCitaP == "1" && valorMotivoP == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ELIGE MOTIVO DE CITA'
        });
        return false;
      }

      if(valorCitaP == "1" && valorFechaP < fechaHoy){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'LA FECHA NO PUEDE SER ANTERIOR AL DÍA DE HOY'
        });
        return false;
      }

      if(valorCitaP == "1" && valorHoraP == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ELIGE UN HORARIO'
        });
        return false;
      }

      $.ajax({
        type: "POST",
        url: "insertar_desparasitacion_gral.php",
        data: datos,
        success:function(r){
          if (r==1){
            alert("Error");
          }
          else{
            Swal.fire({
              type:'success',
              title: 'Correcto',
              text:'DESPARASITACIÓN AGREGADA CORRECTAMENTE'
            }) 
          }
        }
      });
      return false;

      return true;
    }
  </script>
  <div class="form-right">
    <div class="form-group">
      <label id="lblCitaPD"> <i class="fas fa-calendar-day"></i>&nbsp;&nbsp; Programar cita</label>
      <input type="checkbox" id="inputCitaP" onchange="habilitar(this.checked);" name="pCita" checked>
    </div>
    <input type="text" name="motivoCita" id="motivoCita" value="DESPARASITACIÓN">
  </select>
  <label id="lblFechaCitaD"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp; Fecha </label>
  <input type="date" name="fechaCita" id="fechaCitaD">
  <label id="lblHoraCitaD"> <i class="far fa-clock"></i>&nbsp;&nbsp; Hora </label>
  <input type="time" name="hora" id="inputHoraCitaD">
  <button class="boton" name="submit" type="submit">Agregar desparasitación</button>
</div>
</div>
</form>  
</div> 
<button class="botonAtrasDG" onclick="goBack();"> Atrás </button>

<script>
  function goBack() {
    window.history.back();
  }
</script> 
</body>
</html>