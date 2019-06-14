<?php

require 'conexion.php';

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
  document.getElementById('inputFecha').value=ano+"-"+mes+"-"+dia;
}
</script>

<div class="contenedor-principal">
<form class="form_estetica" action="agregar_cita.php?id=<?php echo $codigoP?>" method="POST">
    <?php $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoP' AND iCodEmpresa = '$codigoE'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="contenedor-title">
    <p id="lblCita"> Estética de <?php echo $row['vchNombrePaciente']; ?> </p>
  </div>
  <div id="datos_citaE">
      <label for="inputEstilista" id="lblEstilista">Estilista</label>
      <select id="inputEstilista" name="estilista">
        <option value="0">SELECCIONE EL ESTILISTA</option>
        <?php
        $consulta = "SELECT vchNombre FROM CatEstilistas WHERE iCodEmpresa = '$codigoE'";
        $result = mysqli_query($conn,$consulta);
        while ($estilistas = mysqli_fetch_array($result)) {
          echo '<option>'.$estilistas['vchNombre'].'</option>';
                  }
        ?>
      </select>
      <label for="inputTipoServicio" id="lblTipo">Tipo servicio</label>
      <select id="inputTipoServicio" name="servicio" onchange="ShowSelected();">
        <?php
        $consulta = "SELECT * FROM CatServicios WHERE iCodEmpresa = 4";
        $result = mysqli_query($conn,$consulta);
        $row = mysqli_fetch_assoc($result);
        ?>
        <option value="0">ELIGE EL TIPO DE SERVICIO</option>
        <option value="<?php echo $row['iCodTipoServicio'] = 1 ?>">BAÑO </option>
        <option value="<?php echo $row['iCodTipoServicio'] = 2 ?>">CORTE </option>
        <option value="<?php echo $row['iCodTipoServicio'] = 3 ?>">CORTE & BAÑO</option>
        <option value="<?php echo $row['iCodTipoServicio'] = 4 ?>">OTROS</option>
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

      <label for="inputServicioE" id="lblTipo">Servicio</label>
      <select id="inputServicioE" name="servicio"> </select>
  </div>
     <div id="datos_horario">
      <label for="inputhoraini" id="lblFechaE">Fecha </label>
      <input type="date" class="input-append date" id="inputFechaE" name="fecha">
      <label for="inputhoraini" id="lblHoraInicio">Hora inicio </label>
      <input type="time" id="inputHoraInicio" name="horaInicio">
      <label for="inputHoraFin" id="lblHoraFinE">Hora Fin </label>
      <input type="time" id="inputHoraFinE" name="horaFin">
      </div>
  <div id="notasyobs">
      <label for="inputNotas" id="lblNotas">Notas y observaciones</label>
      <textarea id="inputNotas" name="motivo"> </textarea>
  </div>
  <div id="botonAgregar">
      <button class="botonAgregar" type="submit">Agregar estética</button>    
  </div>
</form>  
</div>  
</body>
</html>