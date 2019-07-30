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
		<link rel="stylesheet" href="assets/css/esteticas.css" />

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
  $codigoE = base64_decode($_GET['id']);
  $codigoP = base64_decode($_GET['codigo']);
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
<form class="form_estetica" id="frmEstetica" action="insertar_estetica.php" method="POST" onsubmit="return validarCitaEst();">
    <?php $sql = "SELECT * FROM TranAfiliado WHERE iCodPaciente = '$codigoP' AND iCodEmpresa = '$codigoE'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="contenedor-title">
    <p id="lblCita"> Estética de <?php echo $row['vchNombrePaciente']; ?> </p>
  </div>
  <div id="datos_citaE">
        <input type="hidden" name="correo" value="<?php echo $row['vchCorreo'] ?>">
        <input type="hidden" name="empresa" value="<?php echo $row['iCodEmpresa'] ?>">
        <input type="hidden" name="pais" value="<?php echo $row['vchPais'] ?>">
        <input type="hidden" name="estado" value="<?php echo $row['vchEstado'] ?>">
        <input type="hidden" name="paciente" value="<?php echo $row['iCodPaciente'] ?>">
        <input type="hidden" name="ciudad" value="<?php echo $row['vchCiudad'] ?>">
        <input type="hidden" name="propietario" value="<?php echo $row['iCodPropietario'] ?>">
        <input type="hidden" name="especie" value="<?php echo $row['iCodEspecie'] ?>">
        <input type="hidden" name="raza" value="<?php echo $row['vchRaza'] ?>">

      <select id="inputEstilista" name="estilista">
        <option value=""> ESTILISTA </option>
        <?php
        $consulta = "SELECT iCodEstilista, vchNombre FROM CatEstilistas WHERE iCodEmpresa = '$codigoE'";
        $result = mysqli_query($conn,$consulta);
        while ($estilistas = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $estilistas['iCodEstilista']; ?>"> <?php echo $estilistas['vchNombre']; ?></option>
          <?php
                  }
        ?>
      </select>

      <!--<script type="text/javascript">
      function validarCitaEst() {
      var valorEstilista = document.getElementById("inputEstilista").value;
      var valorServicio = document.getElementById("inputTipoServicio").value;
      var txtServicio = document.getElementById("inputServicioE").value;
      var txtHoraIni = document.getElementById("inputHoraInicio").value;
      var txtHoraFin = document.getElementById("inputHoraFinE").value;
      var datos = $('#frmEstetica').serialize();

      if(valorEstilista == ""){
        Swal.fire({
          type: 'error',
          title: 'ERROR',
          text: 'Elige estilista'
        });
        return false;
      }

      if(valorServicio == ""){
        Swal.fire({
          type: 'error',
          title: 'ERROR',
          text: 'Elige tipo de servicio'
        });
        return false;
      }

      if(txtServicio == ""){
        Swal.fire({
          type: 'error',
          title: 'ERROR',
          text: 'Elige servicio'
        });
        return false;
      }

      if(txtHoraIni == ""){
        Swal.fire({
          type: 'error',
          title: 'ERROR',
          text: 'Elige hora de inicio'
        });
        return false;
      }

      if(txtHoraFin == ""){
        Swal.fire({
          type: 'error',
          title: 'ERROR',
          text: 'Elige hora de fin'
        });
        return false;
      }

      $.ajax({
        type: "POST",
        url: "insertar_estetica.php",
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
      return false;

            return true;
        }
      </script>-->

      <select id="inputTipoServicio" name="codigoServicio" onchange="ShowSelected();">
        <option value=""> TIPO SERVICIO </option>
        <?php
        $consulta = "SELECT * FROM CatServicios WHERE iCodEmpresa = '$codigoE'";
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
          var codServicio = document.getElementById("inputTipoServicio").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtener_servicio.php', { iCodTipoServicio: codServicio, id: id }, function(data){
              $('#inputServicioE').html(data);
                  }); 
          }
        </script>

      <select id="inputServicioE" name="servicio" onchange="getPrecioServicio();"> </select>

      <script type="text/javascript">
          function getPrecioServicio(){
          var iCodServicio = document.getElementById("inputServicioE").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtenerPrecioEstetica.php', { iCodServicio: iCodServicio, id: id }, function(data){
              $("#inputPrecioS").html(data);
              document.getElementById("inputPrecioS").value = data;
                  }); 
          }
        </script>
  </div>
     <div id="datos_horario">
      <label for="inputPrecio" id="lblPrecioS">$</label>
      <input type="text" id="inputPrecioS" name="precioServicio">
      <label for="inputhoraini" id="lblFechaE">Fecha </label>
      <input type="date" class="input-append date" id="inputFechaE" name="fechaEst">
      <label for="inputhoraini" id="lblHoraInicio">Hora inicio </label>
      <input type="time" id="inputHoraInicio" name="horaInicio">
      <label for="inputHoraFin" id="lblHoraFinE">Hora Fin </label>
      <input type="time" id="inputHoraFinE" name="horaFin">
      </div>
  <div id="notasyobs">
      <label for="inputNotas" id="lblNotas">Notas y observaciones</label>
      <textarea id="inputNotas" name="notas"> </textarea>
  </div>
  <div id="botonAgregar">
      <button class="botonAgregar" type="submit">Agregar estética</button>    
  </div>
</form>  
</div>  
</body>
</html>