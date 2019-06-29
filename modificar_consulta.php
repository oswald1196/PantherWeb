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
  $codigoInf = base64_decode($_GET['ci']);
  include('header.php');
  include ('conexion.php');
?>
<!--<script type="text/javascript">
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
</script>-->
 <p id="titulo_consulta">Modificar informe médico</p> 

<div class="contenedor_imedico">
<form class="form-consulta" action="insertar_consulta.php" method="POST">
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
    <?php 
    $query = "SELECT DISTINCT TI.iCodTranInformeMedico, TI.iCodPaciente, TI.iCodInformeMedico, TI.iCodMedico, TI.vchNumInformeMedico, TI.vchProblema,  TI.dtFechaInformeMedico, TI.siAtencion, TI.vchMotivo As sMotivoConsulta, TI.dtFechaSintomatologia, TI.vchNota, TI.iInformeMedico, CONCAT (CM.vchNombre, ' ', CM.vchPaterno, ' ', CM.vchMaterno) As vchMedico, TI.siFrecuenciaCardiaca, TI.dTemperatura, TI.siFrecuenciaRespiratoria, TI.siCodMucosa, TI.sMucosa, TI.iTiempoLlenadoCapilar, TI.dPeso, TI.siPadecimiento, TI.sDiagnosticoPresuntivo, TI.sDiagnosticoDiferencial, TI.sPruebasRequeridas, TI.sResultado, TI.siDiagnostico, TI.vchProblema, TI.iCodServicio, TI.vchServicio, TI.dPrecioMenudeo, TI.dPrecioCosto, TI.iCodCuentaCliente, TI.vchReceta, TI.dMeses, TI.dAltura, TI.sPresionArterial, TI.dPerimetroCefalico, TI.dNoTransaccionCloud, TI.dtFechaInformeMedico FROM TranInformeMedico TI INNER JOIN CatMedico CM ON CM.iCodMedico = TI.iCodMedico WHERE TI.iCodPaciente = '$codigoP' AND CM.iCodEmpresa = '$codigoE' AND iCodTranInformeMedico = '$codigoInf'";
        $resultado = mysqli_query($conn,$query);
        while($fila = mysqli_fetch_assoc($resultado)){
          $chkatencion = $fila['siAtencion'];
          $chkpad = $fila['siPadecimiento'];

      echo $chkatencion;
      echo $chkpad; 

    ?>
    <div id="div-estado">
      <p id="lblEstado">Signos y estado</p>
      <div class="form-group">
        <input type="hidden" name="correo" value="<?php echo $row['vchCorreo'] ?>">
        <input type="hidden" name="empresa" value="<?php echo $row['iCodEmpresa'] ?>">
        <input type="hidden" name="pais" value="<?php echo $row['vchPais'] ?>">
        <input type="hidden" name="estado" value="<?php echo $row['vchEstado'] ?>">
        <input type="hidden" name="ciudad" value="<?php echo $row['vchCiudad'] ?>">
        <input type="hidden" name="paciente" value="<?php echo $row['iCodPaciente'] ?>">

      <input type="text" id="inputFC" name="frecCardiaca" placeholder="Frecuencia cardiaca" value="<?php echo $fila['siFrecuenciaCardiaca']?>">
      <input type="text" id="inputFR" name="frecResp" placeholder="Frecuencia respiratoria" value="<?php echo $fila['siFrecuenciaRespiratoria']?>">
      </div>
      <div class="form-group">
      <input type="text" id="inputPresion" name="presion" placeholder="Presión arterial" value="<?php echo $fila['sPresionArterial']?>">
      <input type="text" id="inputLlenado" name="llenado" placeholder="Tiempo llenado capilar" value="<?php echo $fila['iTiempoLlenadoCapilar']?>">
      </div>
      <input type="text" id="inputTemp" name="temperatura" placeholder="Temperatura" value="<?php echo $fila['dTemperatura']?>">
      <select id="selectMucosas" name="mucosas">
        <option value="<?php echo $fila['sMucosa']?>"><?php echo $fila['sMucosa']?></option>
        <option value="APN (Aparentemente Normal)">APN (Aparentemente Normal)</option>
        <option value="Ictérica">Ictérica</option>
        <option value="Hemorrágicas profusas">Hemorrágicas profusas</option>
        <option value="Hemorrágicas petequiales">Hemorrágicas petequiales</option>
        <option value="Congestionadas">Congestionadas</option>
        <option value="Otras">Otras</option>
        <option value="Cianóticas">Cianóticas</option>
      </select>
      <input type="text" id="inputPesoC" name="peso" placeholder="Peso" value="<?php echo $fila['dPeso']?>">
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
      <textarea type="text" id="diagnosticoP" name="dp" placeholder="Diagnóstico presuntivo"><?php echo $fila['sDiagnosticoPresuntivo']?></textarea>
      <textarea type="text" id="diagnosticoD" name="dd"  placeholder="Diagnóstico diferencial"><?php echo $fila['sDiagnosticoDiferencial']?></textarea>
      <textarea type="text" id="inputPruebas" name="pruebas" placeholder="Pruebas laboratorio y gabinete (Resultados)"><?php echo $fila['sPruebasRequeridas']?></textarea>  
      <textarea type="text" id="diagnosticoDef" name="ddef" placeholder="Diagnóstico definitivo"><?php echo $fila['sResultado']?></textarea>
      <textarea type="text" id="inputMed" name="medicacion" placeholder="Medicación"><?php echo $fila['vchProblema']?></textarea>
      
    </div>
    </div>
    <div class="detalle">
      <p id="lblDetalle">Detalle</p>
      <select id="selectMedico" name="medico" disabled>
                 <option value="<?php $fila['iCodMedico']?>"><?php echo $fila['vchMedico'] ?></option>
         
      </select>
      <input type="hidden" name="codigoM" value="<?php echo $fila['iCodMedico'] ?>">
        <label for="inputFechaSintomas" id="lblIniSintomas"> Inicio síntomas </label>
        <input type="date" class="input-append date" id="inputFechaSintomas" name="fechaS" value="<?php echo $chkatencion?>">
      <div class="form-group">  
        
      <label for="inputfecha" id="lblAtencion" onclick="myFunction();"> Atención en clínica </label>
      <input type="checkbox" id="inputAtencion" name="atencionClinica" value="<?php echo $fila['siAtencion']?>">
      
     </div>
      <div class="form-group">        
      <label for="inputPad" id="lblPad"> Padecimiento de primera vez </label>
      <input type="checkbox" id="inputPad" name="padecimiento" value="<?php echo $fila['siPadecimiento']?>">
    </div>
    
    <script type="text/javascript">
        function myFunction() {
          var atencion = document.getElementById("inputAtencion").value;
          alert(atencion);
        if (atencion == 0){
            document.getElementById("inputAtencion") = "checked";
        } else {
            document.getElementById("inputAtencion") = "";
          }
        }
      </script>
      <select id="selectServicio" name="servicio" onchange="cambioOpciones();">
        <!--<option value="0" selected="hidden">SERVICIO</option> 

        <?php
        //$consulta = "SELECT iCodServicio, dPrecioMenudeo, vchDescripcion, dPrecioCosto FROM CatServicios WHERE iCodTipoServicio = 2 AND iCodEmpresa = '$codigoE' ORDER BY vchDescripcion";
        //$result = mysqli_query($conn,$consulta);
        //while ($servicio = mysqli_fetch_array($result)) {
          ?>-->

          <option value="<?php $servicio['iCodServicio']?> <?php echo $servicio['dPrecioMenudeo']?> "> <?php echo $fila['vchServicio']; ?></option>
          
          <!--<?php
              //}
          ?>-->
      </select>

      <!--<script type="text/javascript">
        function cambioOpciones() {
            document.getElementById('inputCostoServicio').value = document.getElementById('selectServicio').value;
          }
    </script>-->


      <label id="lblCostoS"> Costo </label>
      <input type="text" id="inputCostoServicio" name="costoS" value="<?php echo $fila['dPrecioMenudeo']?>">

    </div>  
    
    <div class="informeMedico">
      <label for="inputFechaConsulta" id="lblFechaC"> Fecha </label>
      <input type="date" class="input-append date" id="inputFechaConsulta" name="fechaConsulta" value="<?php echo $fila['dtFechaInformeMedico']?>">
      <p id="lblMotivo"> Motivo Consulta </p>
      <textarea id="txtMotivo" name="motivo"><?php echo $fila['sMotivoConsulta']?></textarea>
      <p id="lblExamen"> Examen físico </p>
      <textarea id="txtExamen" name="examen"><?php echo $fila['vchNota']?></textarea>
      <p id="lblReceta"> Receta </p>
      <textarea id="txtReceta" name="receta"><?php echo $fila['vchReceta']?></textarea>
       <?php
                  }
        ?>
      <button class="botonAConsulta" type="submit"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Agregar informe</button>

    </div>
      </div>
</form>  
</div>  
</body>
</html>