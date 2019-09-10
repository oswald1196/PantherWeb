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
  <title>Panther :: Estética</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/css/esteticas_generales.css" />

  <link rel="stylesheet" href="assets/css/ace-fonts.css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/ace.min.css" />
  <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
  <link rel="stylesheet" href="assets/css/estilos.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="dist/sweetalert2.min.css">    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>

<body>

  <?php
  $codigo = base64_decode($_GET['id']);
  $cMedico = base64_decode($_GET['cm']);
  include('header.php');
  include ('conexion.php');
  ?>

  <p id="titulo-pagina">AGENDA ESTÉTICA</p> 

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
  document.getElementById('inputFechaE').value=ano+"-"+mes+"-"+dia;
}
</script>

<div class="contenedor-principal">
  <form class="form_estetica" id="frmEstetica" action="insertar_esteticas_generales.php" method="POST" onsubmit="return validarCitaEst(); return getCitasExistentes();">
    <div id="datos_citaG">

      <select id="inputPacienteEstetica" name="paciente">
        <option value=""> PACIENTE </option>
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
      <input type="hidden" name="empresa" value="<?php echo $codigo ?>">

      <select id="inputEstilistaG" name="estilista">
        <option value=""> ESTILISTA </option>
        <?php
        $consulta = "SELECT iCodEstilista, vchNombre FROM CatEstilistas WHERE iCodEmpresa = '$codigo'";
        $result = mysqli_query($conn,$consulta);
        while ($estilistas = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $estilistas['iCodEstilista']; ?>"> <?php echo $estilistas['vchNombre']; ?></option>
          <?php
        }
        ?>
      </select>

      <select id="inputTipoServicioG" name="codigoServicio" onchange="ShowSelected();">
        <option value=""> TIPO SERVICIO </option>
        <?php
        $consulta = "SELECT * FROM CatServicios WHERE iCodEmpresa = '$codigo'";
        $result = mysqli_query($conn,$consulta);
        $row = mysqli_fetch_assoc($result);
        ?>
        <option value="<?php echo $row['iCodLaboratorio'] = 1 ?>">BAÑO </option>
        <option value="<?php echo $row['iCodLaboratorio'] = 2 ?>">CORTE </option>
        <option value="<?php echo $row['iCodLaboratorio'] = 3 ?>">CORTE & BAÑO</option>
        <option value="<?php echo $row['iCodLaboratorio'] = 4 ?>">OTROS</option>
      </select>

      <script type="text/javascript">
        function ShowSelected(){
          var codServicio = document.getElementById("inputTipoServicioG").value;
          var id = <?= json_encode($codigo) ?>;
          $.post('obtener_servicio.php', { iCodTipoServicio: codServicio, id: id }, function(data){
            $('#inputServicioG').html(data);
          }); 
        }
      </script>


      <script type="text/javascript">
        function getPrecioServicio(){
          var iCodServicio = document.getElementById("inputServicioG").value;
          var id = <?= json_encode($codigo) ?>;
          $.post('obtenerPrecioEstetica.php', { iCodServicio: iCodServicio, id: id }, function(data){
            $("#inputPrecioS").html(data);
            document.getElementById("inputPrecioS").value = data;
          }); 
        }

        function getMatrizIni(){
          var horaInicial = document.getElementById("inputHoraInicio").value;
          $.post('obtenerMatrizInicial.php', { horaInicio: horaInicial }, function(data){
            $('#inputMatrizIni').html(data);
              document.getElementById("inputMatrizIni").value = data;

          });
        }

        function getMatrizFin(){
          var horaFinal = document.getElementById("inputHoraFinE").value;
          $.post('obtenerMatrizFinal.php', { horaFin: horaFinal }, function(data){
            $('#inputMatrizIni').html(data);
              document.getElementById("inputMatrizFin").value = data;

          });
        }

        function getCitasExistentes(){

          var iCodEstilista = document.getElementById("inputEstilistaG").value;
          var horaIni = document.getElementById("inputHoraInicio").value;
          var horaFin = document.getElementById("inputHoraFinE").value;
          var fecha = document.getElementById("inputFechaE").value;
          var matrizIni = document.getElementById("inputMatrizIni").value;
          var id = <?= json_encode($codigo) ?>;
          $.post('obtenerCitasExistentes.php', { codigoEstilista: iCodEstilista, Fecha: fecha, MatrizI: matrizIni, id: id }, function(data){
            $('#inputExisteCita').html(data);
            document.getElementById("inputExisteCita").value = data;
          });
        }
      </script>
    </div>
    
    <div id="datos_otrosG">
      <select id="inputServicioG" name="servicio" onchange="getPrecioServicio();"> </select>
      <label for="inputPrecioS" id="lblPrecioS">$</label>
      <input type="text" id="inputPrecioS" name="precioServicio">
      <label for="inputhoraini" id="lblFechaE">Fecha </label>
      <input type="date" class="input-append date" id="inputFechaE" name="fechaEst">
    </div>
    <div id="datos_horarioG">
      <label for="inputhoraini" id="lblHoraInicio">Hora inicio </label>
      <input type="time" id="inputHoraInicio" name="horaInicio" onchange="getMatrizIni();" onblur="getCitasExistentes();">
      <label for="inputHoraFin" id="lblHoraFinE">Hora Fin </label>
      <input type="hidden" id="inputMatrizIni">
      <input type="time" id="inputHoraFinE" name="horaFin" onchange="getMatrizFin();">
      <input type="hidden" id="inputMatrizFin">

    </div>
    <div id="notasyobs">
      <label for="inputNotas" id="lblNotas">Notas y observaciones</label>
      <textarea id="inputNotas" name="notas"> </textarea>
      <input type="text" id="inputExisteCita">

    </div>
    <div id="botonAgregarEG">
      <button class="botonAgregarG" onclick="getCitasExistentes();" type="submit">Agregar estética</button>    
    </div>
  </form>  
</div>  
<script type="text/javascript">
  function validarCitaEst() {
    var valorEstilista = document.getElementById("inputEstilistaG").value;
    var valorServicio = document.getElementById("inputTipoServicioG").value;
    var txtServicio = document.getElementById("inputServicioG").value;
    var txtHoraIni = document.getElementById("inputHoraInicio").value;
    var txtHoraFin = document.getElementById("inputHoraFinE").value;
    var txtValorPaciente = document.getElementById("inputPacienteEstetica").value;
    var txtCita = document.getElementById("inputExisteCita").value;
    var datos = $('#frmEstetica').serialize();

    if(txtCita == 1){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'YA EXISTE UNA CITA PROGRAMADA CON LA MISMA FECHA/HORA, FAVOR DE VERIFICAR'
      });
      return false;
    }

    if(txtValorPaciente == ""){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'ELIGE PACIENTE'
      });
      return false;
    }

    if(valorEstilista == ""){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'ELIGE ESTILISTA'
      });
      return false;
    }

    if(valorServicio == ""){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'ELIGE TIPO DE SERVICIO'
      });
      return false;
    }

    if(txtServicio == ""){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'ELIGE SERVICIO'
      });
      return false;
    }

    if(txtHoraIni == ""){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'ELIGE HORA DE INICIO'
      });
      return false;
    }

    if(txtHoraFin == ""){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'ELIGE HORA DE FIN'
      });
      return false;
    }

    if(txtHoraFin < txtHoraIni){
      Swal.fire({
        type: 'error',
        title: 'ERROR',
        text: 'LA HORA DE INICIO NO PUEDE SER MAYOR A LA HORA DE FIN'
      });
      return false;
    }


    /*$.ajax({
      type: "POST",
      url: "insertar_esteticas_generales.php",
      data: datos,
      success:function(r){
        if (r==1){
          alert("Error");
        }
        else{
          Swal.fire({
            type:'success',
            title: 'Correcto',
            text:'Cita de estética agregada correctamente'
          }) 
        }
      }
    });
    return false;*/

    return true;
  }
</script>
<button class="botonAtrasEstG" onclick="goBack();"> Atrás </button>

<script>
  function goBack() {
    window.history.back();
  }
</script>
</body>
</html>