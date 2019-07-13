<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Agenda</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/agendas.css" />

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
  document.getElementById('inputfecha1').value=ano+"-"+mes+"-"+dia;
}
</script>

 <p id="titulo-pagina">AGENDA</p> 

<div class="contenedor_principal">
<form class="form_add_cita" id="frmAgenda" action="insertar_cita.php" method="POST" onsubmit="return validarForm();">
    <?php 
    $sql = "SELECT * FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="container-titulo">
    <p id="lblCita"> Cita para <?php echo $row['vchNombrePaciente']; ?> </p>
        <input type="hidden" name="correo" id="correoEmpresa" value="<?php echo $row['vchCorreo'] ?>">
        <input type="hidden" name="empresa" id="codigoEmpresa" value="<?php echo $row['iCodEmpresa'] ?>">
        <input type="hidden" name="pais"  id="paisEmp" value="<?php echo $row['vchPais'] ?>">
        <input type="hidden" name="estado" id="estadoEmp" value="<?php echo $row['vchEstado'] ?>">
        <input type="hidden" name="ciudad" id="ciudadEmp" value="<?php echo $row['vchCiudad'] ?>">
        <input type="hidden" name="paciente" id="codPaciente" value="<?php echo $row['iCodPaciente'] ?>">
        <input type="hidden" name="propietario" id="codPropietario" value="<?php echo $row['iCodPropietario'] ?>">
        <input type="hidden" name="nombrePac" id="nombrePaciente" value="<?php echo $row['vchNombrePaciente'] ?>">
        <input type="hidden" name="raza" id="razaPaciente" value="<?php echo $row['vchRaza'] ?>">
        <input type="hidden" name="nombreProp" id="nombrePropietario" value="<?php echo $row['vchNombre'] ?>">
        <input type="hidden" name="telefono" id="telProp" value="<?php echo $row['vchTelefono'] ?>">

  </div>
  <div id="fechas_cita">
      <label for="inputfecha1" id="lblFechaA">Fecha</label>
      <input type="date" class="input-append date" id="inputfecha1" name="fechaAgenda">
      <label for="inputhoraini" id="lblHoraInicio">Hora inicio </label>
      <input type="time" id="inputhoraini" name="horaInicio" value="" >
      <label for="inputMotivo" id="lblTodoDia">Todo el día</label>
      <input type="checkbox" id="chkTodoDia" name="diaCita" onchange="validar(this.checked);">

      <script type="text/javascript">
      function validar(value)
        {
        if(value==true)
        {
        document.getElementById("inputhoraini").readOnly=true;
        document.getElementById("inputhoraini").value="00:00";


        }else if(value==false){
        document.getElementById("inputhoraini").readOnly=false;
        }
      }
      </script>

 </div>
  <div id="div_motivos">
      <label for="inputMotivos" id="lblMotivos">Motivos</label>
      <select id="inputMotivos" name="codigoMotivo">
        <option value="">SELECCIONE UN MOTIVO</option>
        <?php
        $consulta = "SELECT * FROM CatMotivos WHERE iCodEmpresa = '$codigoE'";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          ?>
          <option value ="<?php echo $motivos['iCodMotivo'];?>"> <?php echo $motivos['vchMotivo'] ?></option>
          <?php
                  }
        ?>
      </select>
    <div id="div_nuevo_motivo">
    <form id="form_add_motivo" action="insertar_motivo_nuevo.php">
    <label for="inputMotivo" id="lblNuevaCita">Escribe nueva cita</label>
    <input type="text" id="inputMotivo" placeholder="Nuevo motivo" name="nuevoMotivo">
    <!--<input type="hidden" name="correo" value="<?php //echo $motivos['vchCorreo'] ?>">
    <input type="hidden" name="empresa" value="<?php //echo $motivos['iCodEmpresa'] ?>">
    <input type="hidden" name="pais" value="<?php //echo $motivos['vchPais'] ?>">
    <input type="hidden" name="estado" value="<?php //echo $motivos['vchEstado'] ?>">
    <input type="hidden" name="ciudad" value="<?php //echo $motivos['vchCiudad'] ?>">horaInicio-->
  	<button type="submit" id="btnAddMotivo"><i class="fas fa-plus-square"></i></button>
    </form>
    </div>
  <div id="div_boton">
      <button class="botonAgregar" id="btnAgregarCita" onclick="return validarFormCita();" type="submit">Agregar cita</button>
    </div>
    <script type="text/javascript">
      function validarFormCita() {
      var motivos = document.getElementById("inputMotivos").value;
      var txtHoraCita = document.getElementById("inputhoraini").value;
      var datos = $('#frmAgenda').serialize();

      if(txtHoraCita == ""){
        Swal.fire({
          type:'error',
          title: 'ERROR',
          text:'Elige la hora'
        });       
        return false;
      }

      if(motivos == ""){
        Swal.fire({
          type:'error',
          title: 'ERROR',
          text:'Elige el motivo'
        });      
        return false;
      }

      $.ajax({
        type: "POST",
        url: "insertar_cita.php",
        data: datos,
        success:function(r){
          if (r==1){
            alert("Error");
          }
          else{
            Swal.fire({
          type:'success',
          title: 'Correcto',
          text:'Cita agregada correctamente'
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
</body>
</html>



