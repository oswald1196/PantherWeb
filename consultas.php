<?php

require 'conexion.php';

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

	</head>

	<body>

<?php
$codigoE = base64_decode($_GET['id']);
  //Codigo Paciente
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
 <p id="titulo-pagina">Agregar informe médico</p> 

<div class="contenedor_imedico">
<form class="form-consulta" action="" method="POST">
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
    <div class="detalle">
      <p id="lblDetalle">Detalle</p>
      <select id="inputProducto" name="medico">
        <?php
        $consulta = "SELECT * FROM CatMedico WHERE iCodEmpresa = '$codigoE' ORDER BY vchNombre ASC";
        $result = mysqli_query($conn,$consulta);
        while ($medico = mysqli_fetch_array($result)) {
          echo '<option>'.$medico['vchNombre'].' '.$medico['vchPaterno'].' '.$medico['vchMaterno'].'</option>';
                  }
        ?>
      </select>
        <label for="inputFechaSintomas" id="lblIniSintomas"> Inicio síntomas </label>
        <input type="date" class="input-append date" id="inputFechaSintomas" name="fecha">
      <div class="form-group">        
      <label for="inputfecha" id="lblAtencion"> Atención en clínica </label>
      <input type="checkbox" id="inputAtencion" name="atencionClinica">
    </div>
      <div class="form-group">        
      <label for="inputPad" id="lblPad"> Padecimiento de primera vez </label>
      <input type="checkbox" id="inputPad" name="padecimiento">
    </div>
      <label id="lblServicio"> Servicio </label>
      <select id="selectServicio" name="servicio" onchange="cambioOpciones();">
        <?php
        $consulta = "SELECT iCodServicio,dPrecioMenudeo,vchDescripcion FROM CatServicios WHERE iCodTipoServicio = 2 AND iCodEmpresa = 4 ORDER BY iCodServicio";
        $result = mysqli_query($conn,$consulta);
        while ($servicio = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $servicio['dPrecioMenudeo'];?>"> <?php echo $servicio['vchDescripcion'] ?></option>
          <?php
                  }
        ?>
      </select>

      <script type="text/javascript">

        // funcion que se ejecuta cada vez que se selecciona una opción

        function cambioOpciones()

        {
            document.getElementById('inputCostoS').value=document.getElementById('selectServicio').value;
        }

    </script>
      <label id="lblCostoS"> Costo </label>
      <input id="inputCostoS" name="costoS" value="">
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
    </div>
    <div class="div-estado">
      <p id="lblEstado">Estado</p>
      <p id="lblEstado">Signos y estado</p>
      <input type="text" id="inputFC" name="frecCardiaca" placeholder="Frecuencia cardiaca">
      <input type="text" id="inputFR" name="frecResp" placeholder="Frecuencia respiratoria">
      <input type="text" id="inputPresion" name="presion" placeholder="Presión arterial">
      <input type="text" id="inputLlenado" name="llenado" placeholder="Tiempo llenado capilar">
      <input type="text" id="inputTemp" name="temperatura" placeholder="Temperatura">
      <select id="selectServicio" name="mucosas">
        <option value="apn">APN (Aparentemente Normal)</option>
        <option value="icterica">Ictérica</option>
        <option value="hp">Hemorrágicas profusas</option>
        <option value="hpet">Hemorrágicas petequiales</option>
        <option value="congest">Congestionadas</option>
        <option value="otras">Otras</option>
        <option value="cianoticas">Cianóticas</option>
      </select>
      <input type="text" id="inputPesoC" name="peso" placeholder="Peso">
    </div>
    <div class="div-diagnostico">
      <label id="lbldp"> Diagnóstico presuntivo </label>
      <textarea id="diagnosticoP" name="dp"> </textarea>  
      <label id="lbldd"> Diagnóstico diferencial </label>
      <textarea id="diagnosticoD" name="dd"> </textarea>  
      <label id="lblPruebas"> Pruebas laboratorio y gabinete (Resultados) </label>
      <textarea id="diagnosticoP" name="pruebas"> </textarea>  
      <label id="lblddef"> Diagnóstico definitivo </label>
      <textarea id="diagnosticoDef" name="ddef"> </textarea>  

      <label for="inputfechacad" id="lblFechaCad">Caducidad</label>
      <input type="date" class="input-append date" id="inputFechaCad" name="fechaC">
      <button class="boton" type="submit">Agregar informe</button>
      
    </div>
  
      </div>
</form>  
</div>  
</body>
</html>