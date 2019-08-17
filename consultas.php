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
  <title>Panther :: Consulta</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/css/consultas.css" />

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
  document.getElementById('inputFechaSintomas').value=ano+"-"+mes+"-"+dia;
  document.getElementById('inputFechaConsulta').value=ano+"-"+mes+"-"+dia;
}
</script>
<p id="titulo_consulta">Agregar informe médico</p> 

<div class="contenedor_imedico">
  <form class="form-consulta" id="frmConsulta" name="formulario" action="" method="POST" onsubmit="return valida();">
    <?php 
    $sql = "SELECT * FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="titulo_page">
      <p id="lblNombrePaciente"> <?php echo $row['vchNombrePaciente']; ?> </p>
      <p id="lblRazaP"> <?php echo $row['vchRaza'] ?></p>
      <p id="lblColorP"> <?php echo $row['vchColor'] ?></p>
      <p id="lblNombreProp"> <?php echo $row['vchNombre'].' '.$row['vchPaterno'] ?></p>
      <p id="lblFechaNMascota"> <?php echo $row['dtFecNacimiento'] ?></p>
      <p id="lblObs"> <?php echo $row['vchObservaciones'] ?></p>

    </div>
    <div id="contenedor_divs">
      <!--Funcion para ocultar boton-->

      <script type="text/javascript">
        $(document).ready(function(){
         $("#boton_estado").click(function(){
          $("#div-estado").toggle(1000);
        });
       });
     </script>
     
     <?php 
     $fecha_actual = date("Y-m-d");
     ?>

     <input type="hidden" name="fecha" id="fechaActual" value="<?php echo $fecha_actual?>">

     <div id="boton_estado">
      <a>  <img id="imagen_libro" src="https://img.icons8.com/ultraviolet/64/000000/health-book.png"> Estado </a> 
    </div>
    <div id="div-estado">
      <p id="lblEstado">Signos y estado</p>
      <div class="form-group">
        <input type="hidden" name="correo" value="<?php echo $row['vchCorreo'] ?>">
        <input type="hidden" name="empresa" value="<?php echo $row['iCodEmpresa'] ?>">
        <input type="hidden" name="pais" value="<?php echo $row['vchPais'] ?>">
        <input type="hidden" name="estado" value="<?php echo $row['vchEstado'] ?>">
        <input type="hidden" name="ciudad" value="<?php echo $row['vchCiudad'] ?>">
        <input type="hidden" name="paciente" value="<?php echo $row['iCodPaciente'] ?>">
        <input type="hidden" name="propietario" value="<?php echo $row['iCodPropietario'] ?>">

        <input type="text" id="inputFC" name="frecCardiaca" placeholder="Frecuencia cardiaca">
        <input type="text" id="inputFR" name="frecResp" placeholder="Frecuencia respiratoria">
      </div>
      <div class="form-group">
        <input type="text" id="inputPresion" name="presion" placeholder="Presión arterial">
        <input type="text" id="inputLlenado" name="llenado" placeholder="Tiempo llenado capilar">
      </div>
      <input type="text" id="inputTemp" name="temperatura" placeholder="Temperatura">
      <select id="selectMucosas" name="mucosas">
        <option value="APN (Aparentemente Normal)">APN (Aparentemente Normal)</option>
        <option value="Ictérica">Ictérica</option>
        <option value="Hemorrágicas profusas">Hemorrágicas profusas</option>
        <option value="Hemorrágicas petequiales">Hemorrágicas petequiales</option>
        <option value="Congestionadas">Congestionadas</option>
        <option value="Otras">Otras</option>
        <option value="Cianóticas">Cianóticas</option>
      </select>
      <input type="text" id="inputPesoC" name="peso" placeholder="Peso">
    </div>
    <!--Funcion para ocultar boton-->
    <script type="text/javascript">
      $(document).ready(function(){
       $("#boton_diagnostico").click(function(){
        $("#div-diagnostico").toggle(1000);
      });
     });
   </script>

   <div id="boton_diagnostico">
    <a> <img id="imagen" src="https://img.icons8.com/ultraviolet/64/000000/treatment-plan.png"> Diagnóstico </a>
  </div>
  <div id="div-diagnostico">
    <textarea type="text" id="diagnosticoP" name="dp" placeholder="Diagnóstico presuntivo"></textarea>
    <textarea type="text" id="diagnosticoD" name="dd"  placeholder="Diagnóstico diferencial"></textarea>
    <textarea type="text" id="inputPruebas" name="pruebas" placeholder="Pruebas laboratorio y gabinete (Resultados)"></textarea>  
    <textarea type="text" id="diagnosticoDef" name="definitivo" placeholder="Diagnóstico definitivo"></textarea>
    <textarea type="text" id="inputMed" name="medicacion" placeholder="Medicación"></textarea>
    
  </div>
</div>
<div class="detalle">
  <p id="lblDetalle">Detalle</p>
  <select id="sltMedico" name="medico">
    <option value="" required>MÉDICO</option>
    <?php
        //Consulta para obtener medicos
    $consulta = "SELECT iCodMedico, vchNombre, vchPaterno, vchMaterno FROM CatMedico WHERE iCodEmpresa = '$codigoE' ORDER BY vchNombre ASC";

    $result = mysqli_query($conn,$consulta);
    while ($medico = mysqli_fetch_array($result)) {
      ?>
      <option value="<?php echo $medico['iCodMedico']?>"><?php echo $medico['vchNombre'].' '.$medico['vchPaterno'].' '.$medico['vchMaterno']; ?></option>
      <?php
    }
    ?>
  </select>

  <label for="inputFechaSintomas" id="lblIniSintomas"> Inicio síntomas </label>
  <input type="date" class="input-append date" id="inputFechaSintomas" name="fechaS">
  <input type="hidden" name="" id="inputFechaHoy" value="<?php echo $fecha_actual?>">

  <div class="form-group">        
    <label for="inputfecha" id="lblAtencion"> Atención en clínica </label>
    <input type="checkbox" id="inputAtencion" name="atencionClinica" value="0" checked>
  </div>
  <div class="form-group">        
    <label for="inputPad" id="lblPad"> </label>
    <input type="checkbox" id="inputPad" name="padecimiento" value="0" checked>
  </div>
  
  <select id="selectServicio" name="servicio" onchange="obtenerPrecio();">
    <option value="">SERVICIO</option> 

    <?php
    $consulta = "SELECT iCodServicio, dPrecioMenudeo, vchDescripcion, dPrecioCosto FROM CatServicios WHERE iCodTipoServicio = 2 AND iCodEmpresa = '$codigoE' ORDER BY vchDescripcion";
    $result = mysqli_query($conn,$consulta);
    while ($servicio = mysqli_fetch_array($result)) {
      ?>

      <option value="<?php echo $servicio['iCodServicio']?>"> <?php echo $servicio['vchDescripcion']; ?></option>
      
      <?php
    }
    ?>
  </select>

  <script type="text/javascript">
    function obtenerPrecio() {
      var iCodServicio = document.getElementById("selectServicio").value;
      var id = <?= json_encode($codigoE) ?>;

      $.post('obtenerPrecioConsulta.php', { iCodServicio: iCodServicio, id: id }, function(data){
        $("#inputCostoS").html(data);
        document.getElementById("inputCostoS").value = data;
      });
    }
  </script>

  <label id="lblCostoS"> Costo </label>
  <input type="text" id="inputCostoS" name="costo" value="">

</div>  

<div class="informeMedico">
  <label for="inputFechaConsulta" id="lblFechaC"> Fecha </label>
  <input type="date" class="input-append date" id="inputFechaConsulta" name="fechaConsulta">
  <p id="lblMotivo"> Motivo Consulta </p>
  <textarea id="txtMotivo" name="motivo"> </textarea>
  <p id="lblExamen"> Examen físico </p>
  <textarea id="txtExamen" name="examen"> </textarea>
  <p id="lblReceta"> Receta </p>
  <textarea id="txtReceta" name="receta"> </textarea>
  <button class="botonAConsulta" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar informe</button>

</div>
    
    <script type="text/javascript">
      function valida() {
      var inputExamen = document.getElementById("txtExamen").value.trim();
      var inputMotivo = document.getElementById("txtMotivo").value.trim();
      var inputReceta = document.getElementById("txtReceta").value.trim();
      var txtSelectServicio = document.getElementById("selectServicio").value;
      var medicoC = document.getElementById("sltMedico").value;
      var txtSintomas = document.getElementById("inputFechaSintomas").value;
      var txtFechaHoy = document.getElementById("inputFechaHoy").value;
      var datos = $('#frmConsulta').serialize();

      if (medicoC == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'Falta médico'
        });
            return false;
        }

        if(txtSintomas > txtFechaHoy){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'La fecha de inicio de síntomas no puede ser mayor al día de hoy'
        });
        return false;
        }

      if (txtSelectServicio == ""){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'Falta servicio'
        });
            return false;
        }
        
      if(inputMotivo.length <= 1){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'El campo Motivo no debe ir vacío'
      });
        return false;
      }

      if(inputExamen.length <= 1){
         Swal.fire({
          type:'error',
          title:'ERROR',
          text:'El campo Examen Físico no debe ir vacío'
        });
        return false;
      }

      if(inputReceta.length <= 1){
        Swal.fire({
          type:'error',
          title:'ERROR',
          text:'El campo Receta no debe ir vacío'
        });
        return false;
        }

        $.ajax({
        type: "POST",
        url: "insertar_consulta.php",
        data: datos,
        success:function(r){
          if (r==1){
            alert("Error");
          }
          else{
            Swal.fire({
          type:'success',
          title: 'Correcto',
          text:'Consulta agregada correctamente'
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
<button class="botonAtrasConsul" onclick="goBack();"> Atrás </button>

<script>
  function goBack() {
    window.history.go(-1);
  }
</script>  
</body>
</html>