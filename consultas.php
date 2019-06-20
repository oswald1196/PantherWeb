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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
 <p id="titulo_consulta">Agregar informe médico</p> 

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
    <!--Funcion para ocultar boton-->

    <script type="text/javascript">
      $(document).ready(function(){
       $("#boton_estado").click(function(){
        $("#div-estado").toggle(1000);
          });
     });
    </script>
    <div id="boton_estado">
      <a>  <img id="imagen_libro" src="https://img.icons8.com/ultraviolet/64/000000/health-book.png"> Estado </a> 
    </div>
    <div id="div-estado">
      <p id="lblEstado">Signos y estado</p>
      <div class="form-group">
      <input type="text" id="inputFC" name="frecCardiaca" placeholder="Frecuencia cardiaca">
      <input type="text" id="inputFR" name="frecResp" placeholder="Frecuencia respiratoria">
      </div>
      <div class="form-group">
      <input type="text" id="inputPresion" name="presion" placeholder="Presión arterial">
      <input type="text" id="inputLlenado" name="llenado" placeholder="Tiempo llenado capilar">
      </div>
      <input type="text" id="inputTemp" name="temperatura" placeholder="Temperatura">
      <select id="selectMucosas" name="mucosas">
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
      <textarea type="text" id="diagnosticoDef" name="ddef" placeholder="Diagnóstico definitivo"></textarea>
      <textarea type="text" id="inputMed" name="medicacion" placeholder="Medicación"></textarea>
      
    </div>
    </div>
    <div class="detalle">
      <p id="lblDetalle">Detalle</p>
      <select id="selectMedico" name="medico">
        <?php
        //Consulta para obtener medicos
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
      <input type="checkbox" id="inputAtencion" name="atencionClinica" checked>
    </div>
      <div class="form-group">        
      <label for="inputPad" id="lblPad"> Padecimiento de primera vez </label>
      <input type="checkbox" id="inputPad" name="padecimiento" checked>
    </div>
      <label id="lblServicio"> Servicio </label>
      <select id="selectServicio" name="servicio" onchange="cambioOpciones();">
        <?php
        //Consulta para obtener servicios
        $consulta = "SELECT iCodServicio,dPrecioMenudeo,vchDescripcion FROM CatServicios WHERE iCodTipoServicio = 2 AND iCodEmpresa = 4 ORDER BY vchDescripcion";
        $result = mysqli_query($conn,$consulta);
        while ($servicio = mysqli_fetch_array($result)) {
          ?>
          <option value="<?php echo $servicio['dPrecioMenudeo'];?>"> <?php echo $servicio['vchDescripcion'] ?></option>
          <?php
                  }
        ?>
      </select>
      <script type="text/javascript">
        function cambioOpciones()

        {
            document.getElementById('inputCostoServicio').value = document.getElementById('selectServicio').value;
        }

    </script>
      <label id="lblCostoS"> Costo </label>
      <input type="text" id="inputCostoServicio" name="costoS">
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
    
  
      </div>
</form>  
</div>  
</body>
</html>