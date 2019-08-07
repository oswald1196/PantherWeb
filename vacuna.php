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
  <title>Panther :: Vacuna</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/css/preventivos.css" />

  <link rel="stylesheet" href="assets/css/ace-fonts.css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
//Codigo Empresa
  $codigoE = base64_decode($_GET['id']);
  //Codigo Paciente
  $codigoP = base64_decode($_GET['codigo']);

  include('header.php');
  include ('conexion.php');
  ?>

  <p id="titulo-pagina">Agregar vacuna</p> 

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
  document.getElementById('fechaCitaV').value=ano+"-"+mes+"-"+dia;
  document.getElementById('inputFechaCad').value=ano+"-"+mes+"-"+dia;
}
</script>

<?php 
$fecha_actual = date("Y-m-d");
?>


<div class="container">
  <form class="form_add_cita" id="frmVacuna" action="insertar_vacuna.php" method="POST" onsubmit="return validarVacuna();">
    <?php 
    $sql = "SELECT * FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="contenedor-titulo">
      <p id="lblCita"> Paciente: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
    <div id="contenedor">
      <div class="form-left">
        <input type="hidden" name="correo" value="<?php echo $row['vchCorreo'] ?>">
        <input type="hidden" name="empresa" value="<?php echo $row['iCodEmpresa'] ?>">
        <input type="hidden" name="pais" value="<?php echo $row['vchPais'] ?>">
        <input type="hidden" name="estado" value="<?php echo $row['vchEstado'] ?>">
        <input type="hidden" name="ciudad" value="<?php echo $row['vchCiudad'] ?>">
        <input type="hidden" name="iCodProp" value="<?php echo $row['iCodPropietario'] ?>">
        <input type="hidden" name="paciente" value="<?php echo $row['iCodPaciente'] ?>">

        <label id="lblFecha"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fecha</label>
        <input type="date" class="input-append date" id="inputfecha" name="fechaVacuna" tabindex="1">
        <label id="lblLab" for="inputLab"> <i class="fas fa-vials"></i>&nbsp;&nbsp; Laboratorio </label>
        <select id="inputLab" name="laboratorio" onchange="ShowSelected();">
          <!--:v-->
          <option value="">Elegir Laboratorio</option>
          <!--:v-->
          <?php
          $consulta = "SELECT iCodMarca,vchMarca FROM CatMarcas WHERE iCodTipoProducto = 5 AND iCodEmpresa = '$codigoE' ORDER BY vchMarca ASC";
          $result = mysqli_query($conn,$consulta);
          while ($marcas = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $marcas['iCodMarca']; ?>"> <?php echo $marcas['vchMarca']; ?></option>
            <?php
          }
          ?>
        </select>
        <!--------------------- Obtener datos de los select --------------------->
        <script type="text/javascript">
          function ShowSelected(){
            var codigoMarca = document.getElementById("inputLab").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtener_vacuna.php', { iCodMarca: codigoMarca, id: id }, function(data){
              $('#inputProducto').html(data);
            });
          }

          function ShowSelectedTwo(){

            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtenerLote.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputLoteVac').html(data);
            });  
          }                                   
        </script>

        <script type="text/javascript">
          function precioVacuna(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtenerPrecio.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputPrecioVac').html(data);
              document.getElementById("inputPrecioVac").value = data;

            });
          }

          function precioVacunaLote(){
            var codigoProducto = document.getElementById("inputLoteVac").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtenerPrecioLote.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputPrecioVac").value = data;

            });
          }

          function stockVacuna(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtenerStock.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputStockVac").value = data;
              if(data == 0){
                Swal.fire({
                  type:'warning',
                  title:'ERROR',
                  text:'¡La vacuna seleccionada no tiene lotes, favor de seleccionar otra vacuna!'
                });
                document.getElementById("inputLoteVac").disabled=true;
              }
              else {
                document.getElementById("inputLoteVac").disabled=false;

              }

            });
          }

          function stockMinimoVacuna(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtenerStockMinimo.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#stockM').html(data);
              document.getElementById("inputStockMinVac").value = data;
              var stock = document.getElementById("inputStockVac").value;
            if(data != 0 && stock == data){
              Swal.fire({
                type:'warning',
                title:'PRECAUCIÓN',
                text:'¡El número de artículos que está vendiendo lo dejará por debajo del stock mínimo!'
              });
            }
            });
          }

          function caducidadVacuna(){
            var codigoProducto = document.getElementById("inputLoteVac").value;
            var id = <?= json_encode($codigoE) ?>;
            $.post('obtenerCaducidad.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCad").value = data;
            });

          }
        </script>

        <label id="lblProducto"> <i class="fas fa-syringe"></i>&nbsp;&nbsp; Vacuna </label>
        <select id="inputProducto" name="vacuna" onchange="ShowSelectedTwo(); precioVacuna(); stockVacuna(); stockMinimoVacuna();"> </select>

        <label id="lblLote"> <i class="fas fa-boxes"></i>&nbsp;&nbsp; Lote </label>
        <select id="inputLoteVac" name="lote" onchange="precioVacunaLote(); caducidadVacuna();"> </select>      
        <label id="lblPrecio"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Precio</label>
        <input type="number" id="inputPrecioVac" name="precio" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <input type="hidden" id="inputStockVac">
        <input type="hidden" id="inputStockMinVac">

        <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">


        <label for="inputfechacad" id="lblFechaCad"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Caducidad</label>
        <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
        <p id="msg"></p>
        <label id="lblPeso"><i class="fas fa-weight-hanging"></i>&nbsp;&nbsp;Peso</label>
        <input type="text" id="inputPeso" name="peso" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label id="lblVacAnt">Vacunas anteriores</label>
        <input type="checkbox" id="inputAnt" name="chkAnteriores">
      </div>
      <!--Panel derecho -->
      <div class="form-right">
        <div class="form-group">
          <label id="lblCitaP"><i class="fas fa-calendar-day"></i>&nbsp;&nbsp;Programar cita</label>
          <input type="checkbox" id="inputCitaP" name="chkCita" onchange="habilitar(this.checked);" checked>
        </div>
        <script text/javascript>
          function habilitar(value)
          {
            if(value==true)
            {
              document.getElementById("inputProxima").disabled=false;
              document.getElementById("fechaCitaV").disabled=false;
              document.getElementById("inputHoraCitaV").disabled=false;

            }else if(value==false){
        // deshabilitamos
        document.getElementById("inputProxima").disabled=true;
        document.getElementById("inputProxima").value="-";
        document.getElementById("fechaCitaV").disabled=true;
        document.getElementById("fechaCitaV").value="-";

        document.getElementById("inputHoraCitaV").disabled=true;
        document.getElementById("inputHoraCitaV").value="00:00";


      }
    }
  </script>

  <label id="lblCitaP"><i class="fas fa-syringe"></i>&nbsp;&nbsp;Próxima vacuna</label>
  <select id="inputProxima" name="motivoProxima">
    <option value="">VACUNA</option>
    <?php
    $consulta = "SELECT * FROM CatProductos WHERE iCodTipoProducto = 5 AND iCodMarca = 1000 AND iCodEmpresa = '$codigoE' ORDER BY vchDescripcion";
    $result = mysqli_query($conn,$consulta);
    while ($motivos = mysqli_fetch_array($result)) {
      ?>
      <option value="<?php echo $motivos['vchDescripcion'] ?>"> <?php echo $motivos['vchDescripcion'] ?> </option>
      <?php
    }
    ?>
  </select>
  <label id="lblFechaCita"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fecha de la cita </label>
  <input type="date" name="fechaCita" id="fechaCitaV">
  <label id="lblFechaCita"><i class="far fa-clock"></i>&nbsp;&nbsp;Hora</label>
  <input type="time" name="horaCita" id="inputHoraCitaV">
  <button class="boton" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar vacuna</button>
</div>

<script type="text/javascript">
  function validarVacuna() {
    var txtLab = document.getElementById("inputLab").value;
    var txtVacuna = document.getElementById("inputProducto").value;
    var txtLote = document.getElementById("inputLoteVac").value;
    var fechaCad = document.getElementById("inputFechaCad").value;
    var fechaHoy = document.getElementById("fechaActual").value;
    var chkProx = document.getElementById("inputCitaP").checked;
    var inputAnt = document.getElementById("inputAnt").checked;
    var fechaProxima = document.getElementById("fechaCitaV").value;
    var motivoP = document.getElementById("inputProxima").value;
    var horaPC = document.getElementById("inputHoraCitaV").value;
    var stock = document.getElementById("inputStockVac").value;
    var stockMin = document.getElementById("inputStockMinVac").value;

    var datos = $('#frmVacuna').serialize();

    if(txtLab == ""){
      Swal.fire({
        type:'error',
        title:'ERROR',
        text:'Elige laboratorio'
      });
      return false;
    }

    if(txtVacuna == ""){
     Swal.fire({
      type:'warning',
      title:'ERROR',
      text:' Elige vacuna'
    });
     return false;
   }

   if(txtLote == ""){
     Swal.fire({
      type:'error',
      title:'ERROR',
      text:' Elige lote'
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

  if(chkProx == "1" && motivoP == ""){
    Swal.fire({
      type:'error',
      title:'ERROR',
      text:'Elige motivo de cita'
    });
    return false;
  }

  if(chkProx == "1" && fechaProxima < fechaHoy){
    Swal.fire({
      type:'error',
      title:'ERROR',
      text:'La fecha no puede ser anterior al día de hoy'
    });
    return false;
  }

  if(chkProx == "1" && horaPC == ""){
    Swal.fire({
      type:'error',
      title:'ERROR',
      text:'Elige un horario'
    });
    return false;
  }

        /*$.ajax({
        type: "POST",
        url: "insertar_vacuna.php",
        data: datos,
        success:function(r){
          if (r==1){
            alert("Error");
          }
          else{
            Swal.fire({
          type:'success',
          title: 'Correcto',
          text:'Vacuna agregada correctamente'
          }) 
            window.location.href = 'vacunas_carnet.php'
          }
        }
      });
      return false;*/


      return true;
    }
  </script>

</div>
</form>  
</div>  
</body>
</html>