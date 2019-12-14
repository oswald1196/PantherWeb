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
  $codigo = base64_decode($_GET['id']);
  $cMedico = base64_decode($_GET['cm']);
  
  //Codigo Paciente
  $fecha_actual = date("Y-m-d");

  include('header.php');
  include ('conexion.php');
  ?>

  <p id="titulo-paginaE">Agregar ectoparásito </p> 

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
<div class="container_ecto">
  <form class="form_add_cita" id="frmEcto" action="insertar_ecto_general.php" method="POST" onsubmit="return validarEcto();">
    <div id="div_paciente">
      <label id="lblPacientesE">Paciente</label>
      <select id="selectPacienteE" name="paciente">
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
      <div class="form-leftE">
        <label id="lblFecha">Fecha</label>
        <input type="date" class="input-append date" id="inputFechaE" name="fecha" tabindex="1">
        <input type="hidden" name="empresa" value="<?php echo $codigo ?>">
        <label id="lblProducto"> Producto </label>
        <select id="inputProductoE" name="ecto" onchange="ShowSelected(); obtenerPrecioEcto(); stockEcto(); stockMinimoEcto(); getTipo();">
          <option value="">ELEGIR PRODUCTO</option>
          <?php
          $consulta = "SELECT iCodProducto, vchDescripcion FROM CatProductos WHERE iCodTipoProducto = 4 AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion ASC";
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
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerLote.php', { iCodProducto: iCodProducto, id: id }, function(data){
              $('#inputLoteEcto').html(data);
            }); 
          }

          function obtenerPrecioEcto(){
            var iCodProducto = document.getElementById("inputProductoE").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecio.php', { iCodProducto: iCodProducto, id: id }, function(data){
              $('#inputPrecio').html(data);
              document.getElementById("inputPrecio").value = data;
            }); 
          }

          function precioEcto(){
            var iCodProductoLote = document.getElementById("inputLoteEcto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecioLote.php', { iCodProductoLote: iCodProductoLote, id: id }, function(data){
              $('#precio').html(data);
              document.getElementById("inputPrecio").value = data;
            }); 
          }

          function stockEcto(){
            var iCodProducto = document.getElementById("inputProductoE").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStock.php', { iCodProducto: iCodProducto, id: id }, function(data){
              $('#stock').html(data);
              document.getElementById("inputStockEcto").value = data;

              if(data == 0){
                Swal.fire({
                  type:'warning',
                  title:'ERROR',
                  text:'¡EL ECTOPARÁSITO SELECCIONADO NO TIENE LOTES, FAVOR DE SELECCIONAR OTRO!'
                });
                document.getElementById("inputLoteEcto").disabled=true;
              }
              else {
                document.getElementById("inputLoteEcto").disabled=false;

              }
            });   
          }

          function stockMinimoEcto(){
            var codigoProducto = document.getElementById("inputProductoE").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStockMinimo.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#stockMin').html(data);
              document.getElementById("inputStockMinEcto").value = data;
              var stock = document.getElementById("inputStockEcto").value;
              if(data != 0 && data == stock){
                Swal.fire({
                  type:'warning',
                  title:'PRECAUCION',
                  text:'¡EL NÚMERO DE ARTÍCULOS QUE ESTÁ VENDIENDO LO DEJARÁ POR DEBAJO DEL STOCK MÍNIMO!'
                });
              }
            });
          }

          function getCaducidad(){
            var iCodProductoLote = document.getElementById("inputLoteEcto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerCaducidad.php', { iCodProductoLote: iCodProductoLote, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCad").value = data;
            }); 
          }

          function getTipo(){
            var codigoProducto = document.getElementById("inputProductoE").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerTipoProducto.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#tipo').html(data);
              document.getElementById("tipoProducto").value = data;
            });
          }
        </script>

        <label id="lblLote"> Lote </label>
        <select id="inputLoteEcto" name="lote" onchange="precioEcto(); getCaducidad();"> </select>
        <label id="lblPrecio">Precio</label>
        <input type="text" id="inputPrecioE" name="dia">
        <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">
        <input type="hidden" id="inputStockEcto">
        <input type="hidden" id="inputStockMinEcto">
        <input type="hidden" id="tipoProducto">
        <input type="hidden" name="cantidad" value="1">

        <label for="inputfechacad" id="lblFechaCadE">Caducidad</label>
        <input type="date" id="inputFechaCadE" name="fechaC">
        <label id="lblEctoAnt">Ectoparásitos anteriores</label>
        <input type="checkbox" id="ectoAnt" name="anterior" >
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
  <div class="form-rightE">
    <div class="form-group">
      <label id="lblCitaP">Programar ectoparásito</label>
      <input type="checkbox" id="inputCitaP" name="citaP" onchange="habilitar(this.checked);" checked>
    </div>
    <input type="text" id="motivoCitaE" name="motivoCitaEcto" value="ECTOPARÁSITOS">
    <label id="lblFechaCita"> Fecha </label>
    <input type="date" id="fechaCitaE" name="fechaProx">
    <label id="lblHoraCita"> Hora </label>
    <input type="time" id="inputHoraCitaE" name="horaProx">
    <select id="inputProximaE" name="medico">
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
    <button class="boton" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar ectoparásito</button>
  </div>
</div>

<script type="text/javascript">
  function validarEcto() {
    var txtEcto = document.getElementById("inputProductoE").value;
    var txtLote = document.getElementById("inputLoteEcto").value;
    var fechaCad = document.getElementById("inputFechaCad").value;
    var fechaHoy = document.getElementById("fechaActual").value;
    var fechaDeCita = document.getElementById("fechaCita").value;
    var valorPaciente = document.getElementById("selectPacienteV").value;
    var valorCitaP = document.getElementById("inputCitaP").checked;
    var valorMotivo = document.getElementById("motivoCita").value;
    var valorFechaP = document.getElementById("fechaCita").value;
    var valorHoraP = document.getElementById("inputHoraCita").value;
    var txtTipo = document.getElementById("tipoProducto").value;
    var datos = $('#frmEcto').serialize();

    if(valorPaciente == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ELIGE PACIENTE'
      });
      return false;
    }

    if(txtEcto == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ELIGE PRODUCTO'
      });
      return false;
    }

    if(txtTipo == "Caja(s)"){
      Swal.fire({
        type:'warning',
        title:'ERROR',
        text:'¡ESTE PRODUCTO NO SE PUEDE APLICAR, YA QUE ES PARA VENTA POR CAJA Y NO POR PIEZA!'
      });
    }

    if(txtLote == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'ELIGE LOTE'
      });
      return false;
    }

    if(fechaCad < fechaHoy){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'PRODUCTO CADUCADO'
      });
      return false;
    }

    if(valorCitaP == "1" && valorMotivo == ""){
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

    /*$.ajax({
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
            title: 'CORRECTO',
            text:'ECTOPARÁSITO AGREGADO CORRECTAMENTE'
          }) 
        }
      }
    });
    return false;*/

    return true;
  }
</script>
</form>  
</div> 
<div id="div_atrasE">
  <button class="botonAtrasEctoG" onclick="goBack();"> Atrás </button>
</div>

<script>
function goBack() {
  window.history.back();
}
</script> 
</body>
</html>