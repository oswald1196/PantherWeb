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
  <link rel="stylesheet" href="assets/css/preventivos_grales.css" />

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
  $codigo = base64_decode($_GET['id']);
  $cMedico = base64_decode($_GET['cm']);
  
  //Codigo Paciente

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
  document.getElementById('fechaCita').value=ano+"-"+mes+"-"+dia;
  document.getElementById('inputFechaCad').value=ano+"-"+mes+"-"+dia;
}
</script>

<?php 
$fecha_actual = date("Y-m-d");
?>


<div class="container">
  <form class="form_add_cita" id="frmVacuna" action="insertar_vacunas_generales.php" method="POST" onsubmit="return validarVacuna();">

    <div id="div_paciente">
      <label id="lblPacientesV">Paciente</label>
      <select id="selectPacienteV" name="paciente">
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
        <input type="hidden" name="empresa" value="<?php echo $codigo ?>">
        

        <label id="lblFecha">Fecha</label>
        <input type="date" class="input-append date" id="inputfecha" name="fechaVacuna" tabindex="1">
        <label id="lblLab" for="inputLab">  Laboratorio </label>
        <select id="inputLab" name="laboratorio" onchange="ShowSelected();">
          <!--:v-->
          <option value="">Elegir Laboratorio</option>
          <!--:v-->
          <?php
          $consulta = "SELECT iCodMarca,vchMarca FROM CatMarcas WHERE iCodTipoProducto = 5 AND iCodEmpresa = '$codigo' ORDER BY vchMarca ASC";
          $result = mysqli_query($conn,$consulta);
          while ($marcas = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $marcas['iCodMarca']; ?>"> <?php echo $marcas['vchMarca']; ?></option>
            <?php
          }
          ?>
        </select>
        <script type="text/javascript">
          function ShowSelected(){
            var codigoMarca = document.getElementById("inputLab").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtener_vacuna.php', { iCodMarca: codigoMarca, id: id }, function(data){
              $('#inputProducto').html(data);
            });
          }

          function ShowSelectedTwo(){

            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerLote.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputLoteVac').html(data);
            });  
          }                                   
        </script>

        <script type="text/javascript">
          function precioVacuna(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecio.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputPrecioVac').html(data);
              document.getElementById("inputPrecioVac").value = data;

            });
          }

          function precioVacunaLote(){
            var codigoProducto = document.getElementById("inputLoteVac").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerPrecioLote.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputPrecioVac").value = data;

            });
          }

          function caducidadVacuna(){
            var codigoProducto = document.getElementById("inputLoteVac").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerCaducidad.php', { iCodProductoLote: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("inputFechaCad").value = data;

            });
          }

          function stockVacuna(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStock.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#PrecioLote').html(data);
              document.getElementById("inputStockVac").value = data;

              if(data == 0){
                Swal.fire({
                  type:'warning',
                  title:'ERROR',
                  text:'¡LA VACUNA SELECCIONADA NO TIENE LOTES, FAVOR DE SELECCIONAR OTRA VACUNA!'
                });
                document.getElementById("inputLoteVac").disabled=true;
              }
              else {
                document.getElementById("inputLoteVac").disabled=false;

              }

            });
          }

          function stockMinimoV(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerStockMinimo.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#stockMin').html(data);
              document.getElementById("inputStockMinVac").value = data;
              var stock = document.getElementById("inputStockVac").value;
              if(data != 0 && data == stock){
                Swal.fire({
                  type:'warning',
                  title:'PRECAUCION',
                  text:'¡EL NÚMERO DE ARTÍCULOS QUE ESTÁ VENDIENDO LO DEJARÁ POR DEBAJO DEL STOCK MÍNIMO!'
                });
              }
            });
          }

          function getTipo(){
            var codigoProducto = document.getElementById("inputProducto").value;
            var id = <?= json_encode($codigo) ?>;
            $.post('obtenerTipoProducto.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#cad').html(data);
              document.getElementById("tipoProducto").value = data;
            });
          }
        </script>

        <label id="lblProducto">  Vacuna </label>
        <select id="inputProducto" name="vacuna" onchange="ShowSelectedTwo(); precioVacuna(); stockVacuna(); stockMinimoV();"> </select>

        <label id="lblLote"> Lote </label>
        <select id="inputLoteVac" name="lote" onchange="precioVacunaLote(); caducidadVacuna();"> </select>      
        <label id="lblPrecio">Precio</label>
        <input type="text" id="inputPrecioVac" name="precio" onkeypress="return event.charCode >= 46 && event.charCode <= 57">

        <input type="hidden" name="" id="fechaActual" value="<?php echo $fecha_actual?>">
        <input type="hidden" id="inputStockVac">
        <input type="hidden" id="inputStockMinVac">
        <input type="hidden" id="tipoProducto">
        <input type="hidden" name="cantidad" value="1">

        <label for="inputfechacad" id="lblFechaCad">Caducidad</label>
        <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
        <p id="msg"></p>
        <label id="lblPeso">Peso</label>
        <input type="text" id="inputPeso" name="peso" onkeypress="return event.charCode >= 46 && event.charCode <= 57">
        <label id="lblVacAnter">Vacunas anteriores</label>
        <input type="checkbox" id="inputAnter" name="chkAnteriores">
      </div>
      <!--Panel derecho -->
      <div class="form-rightV">
        <div class="form-group">
          <label id="lblCitaP">Programar cita</label>
          <input type="checkbox" id="inputCitaP" name="citaP" onchange="habilitar(this.checked);" checked>
        </div>
        <script text/javascript>
          function habilitar(value)
          {
            if(value==true)
            {
              document.getElementById("inputProxima").disabled=false;
              document.getElementById("fechaCita").disabled=false;
              document.getElementById("inputHoraCita").disabled=false;

            }else if(value==false){
        // deshabilitamos
        document.getElementById("inputProxima").disabled=true;
        document.getElementById("inputProxima").value="-";
        document.getElementById("fechaCita").disabled=true;
        document.getElementById("fechaCita").value="-";

        document.getElementById("inputHoraCita").disabled=true;
        document.getElementById("inputHoraCita").value="00:00";


      }
    }
  </script>

  <label id="lblCitaP">Próxima vacuna</label>    
  <select id="inputProxima" name="motivoProxima">
   <option value="">VACUNA</option>

   <?php
   $consulta = "SELECT * FROM CatProductos WHERE iCodTipoProducto = 5 AND iCodMarca = 1000 AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion";
   $result = mysqli_query($conn,$consulta);
   while ($motivos = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $motivos['vchDescripcion'] ?>"> <?php echo $motivos['vchDescripcion'] ?> </option>
    <?php
  }
  ?>
</select>
<label id="lblFechaCita">Fecha de la cita </label>
<input type="date" name="fechaCita" id="fechaCita">
<label id="lblFechaCita"> Hora</label>
<input type="time" name="horaCita" id="inputHoraCita">
<select id="inputProxima" name="medico">
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
<button class="boton" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar vacuna</button>
</div>

      <script type="text/javascript">
      function validarVacuna() {
      var txtLab = document.getElementById("inputLab").value;
      var txtVacuna = document.getElementById("inputProducto").value;
      var txtLote = document.getElementById("inputLoteVac").value;
      var fechaCad = document.getElementById("inputFechaCad").value;
      var fechaHoy = document.getElementById("fechaActual").value;
      var valorPaciente = document.getElementById("selectPacienteV").value;
      var valorChkCita = document.getElementById("inputCitaP").checked;
      var valorMotivo = document.getElementById("inputProxima").value;
      var valorFecha = document.getElementById("fechaCita").value;
      var valorHora = document.getElementById("inputHoraCita").value;
      var txtTipo = document.getElementById("tipoProducto").value;
      
      var datos = $('#frmVacuna').serialize();

      if(valorPaciente == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ELIGE PACIENTE'
        });
        return false;
      }

      if(txtLab == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ELIGE LABORATORIO'
        });
          return false;
      }

      if(txtVacuna == ""){
         Swal.fire({
          type:'warning',
          title:'ERROR',
          text:' ELIGE VACUNA'
        });
          return false;
        }

        if(tipoProd == "Caja(s)"){
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
          text:' ELIGE LOTE'
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

        if(valorChkCita == "1" && valorMotivo == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ELIGE MOTIVO DE CITA'
        });
        return false;
      }

      if(valorChkCita == "1" && valorFecha < fechaHoy){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'LA FECHA NO PUEDE SER ANTERIOR AL DÍA DE HOY'
        });
        return false;
      }

      if(valorChkCita == "1" && valorHora == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'ELIGE UN HORARIO'
        });
        return false;
      }

        $.ajax({
        type: "POST",
        url: "insertar_vacunas_generales.php",
        data: datos,
        success:function(r){
          if (r==1){
            alert("Error");
          }
          else{
            Swal.fire({
          type:'success',
          title: 'CORRECTO',
          text:'VACUNA AGREGADA CORRECTAMENTE'
          }) 
          }
        }
      });
      return false;


            return true;
        }
      </script>

    </div>
  </form>  
</div>  
<div id="div_atrasV">
<button class="botonAtrasVG" onclick="goBack();"> Atrás </button>
</div>

<script>
  function goBack() {
    window.history.back();
  }
</script>
</body>
</html>