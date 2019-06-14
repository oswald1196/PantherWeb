<?php

require 'conexion.php';

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

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/estilos.css" />


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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
  document.getElementById('fechaCita').value=ano+"-"+mes+"-"+dia;
  document.getElementById('inputFechaCad').value=ano+"-"+mes+"-"+dia;
}
</script>

<div class="container">
<form class="form_add_cita" action="insertar_vacuna.php" method="POST">
    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoP'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="contenedor-titulo">
      <p id="lblCita"> Paciente: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
  <div class="form-left">
      <label id="lblFecha"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fecha</label>
      <input type="date" class="input-append date" id="inputfecha" name="fecha" tabindex="1">
      <label id="lblLab" for="inputLab"> Laboratorio </label>
      <select id="inputLab" name="laboratorio" tabindex="2" onchange="ShowSelected();">
        <option value="0">Elegir laboratorio</option>

      <label id="lblLab" for="inputLab"><i class="fas fa-vials"></i>&nbsp;&nbsp;Laboratorio</label>
      <select id="inputLab" name="laboratorio" tabindex="2">
        <option value=0>Elegir laboratorio</option>
        <?php
        $consulta = "SELECT iCodMarca,vchMarca FROM CatMarcas WHERE iCodTipoProducto = 5 AND iCodEmpresa = '$codigoE'ORDER BY vchMarca ASC";
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
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtener_vacuna.php', { iCodMarca: codigoMarca, id: id }, function(data){
              $('#inputProducto').html(data);
                  }); 
          }

          function ShowSelectedTwo(){
          var codigoProducto = document.getElementById("inputProducto").value;
          var id = <?= json_encode($codigoE) ?>;
              $.post('obtener_lote.php', { iCodProducto: codigoProducto, id: id }, function(data){
              $('#inputLote').html(data);
                  });  
          }                                   
      </script>
      <label id="lblProducto"> Vacuna </label>
      <select id="inputProducto" name="vacuna" onchange="ShowSelectedTwo();"> </select>

      <label id="lblLote"> Lote </label>
      <select id="inputLote" name="lote"> </select>
      <label id="lblPrecio">Precio</label>
      <label id="lblProducto"><i class="fas fa-syringe"></i>&nbsp;&nbsp;Vacuna</label>
      <select id="inputProducto" name="vacuna">
        <option value=0>Elegir vacuna</option>
        <?php
        $consulta = "SELECT * FROM CatProductos WHERE iCodTipoProducto = 5";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchDescripcion'].'</option>';
                  }
        ?>
      </select>
      <label id="lblLote"><i class="fas fa-boxes"></i>&nbsp;&nbsp;Lote</label>
      <select id="inputLote" name="lote">
        <option value=0>Elegir Lote</option>
        <?php
        $consulta = "SELECT * FROM RelProductos WHERE iCodTipoProducto = 5";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchMotivo'].'</option>';
                  }
        ?>
      </select>
      <label id="lblPrecio"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Precio</label>
      <input type="text" id="inputPrecio" name="precio">
      <label for="inputfechacad" id="lblFechaCad"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Caducidad</label>
      <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
      <label id="lblPeso"><i class="fas fa-weight-hanging"></i>&nbsp;&nbsp;Peso</label>
      <input type="text" id="inputPeso" name="peso">
  </div>
      <div class="form-right">
        <div class="form-group">
          <label id="lblCitaP">Programar cita</label>
          <input type="checkbox" id="inputCitaP" name="cita" onchange="habilitar(this.checked);" checked>
        </div>
        <script>
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
        document.getElementById("fechaCita").disabled=true;
        document.getElementById("inputHoraCita").disabled=true;

      }
    }
  </script>
        <label id="lblCitaP">Próxima vacuna</label>
          <label id="lblCitaP"><i class="fas fa-calendar-day"></i>&nbsp;&nbsp;Programar cita</label>

          <!--Checkbox sin estilo->
          <input type="checkbox" id="inputCitaP" name="cita">
          <!-Checkbox sin estilo-->

        </div>

        <div class="">
        <div class="">
        <label class="checkbox-label">
            <input type="checkbox">
            <span class="checkbox-custom rectangular"></span>
        </label>
        </div>
        <div class="checkbox-container circular-container">
        <label class="checkbox-label">
            
        </div>
      <!-- <div class="clear"></div> -->
    </div>

        <label id="lblCitaP"><i class="fas fa-syringe"></i>&nbsp;&nbsp;Próxima vacuna</label>
        <select id="inputProxima" name="motivoProxima">
        <option value=0>VACUNA</option>
        <?php
        $consulta = "SELECT * FROM CatProductos WHERE iCodTipoProducto = 5 AND iCodMarca = 1000 AND iCodEmpresa = '$codigoE' ORDER BY vchDescripcion";
        $result = mysqli_query($conn,$consulta);
        while ($motivos = mysqli_fetch_array($result)) {
          echo '<option>'.$motivos['vchDescripcion'].'</option>';
                  }
        ?>
      </select>
        <label id="lblFechaCita"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fecha de la cita </label>
        <input type="date" name="fechaCita" id="fechaCita">
        <label id="lblFechaCita"><i class="far fa-clock"></i>&nbsp;&nbsp;Hora</label>
        <input type="time" name="horaCita" id="inputHoraCita">
        <button class="boton" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar vacuna</button>
      </div>
    </div>
</form>  
</div>  
</body>
</html>