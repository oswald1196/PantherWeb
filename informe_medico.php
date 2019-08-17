<?php

require 'conexion.php';
session_start();

if ($_SESSION["autenticado"] != "SI") {
  header("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Informes médicos</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/informe_medico.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />

	</head>

	<body>

<?php
	$codigoE = base64_decode($_GET['id']);
	$codigoPaciente = base64_decode($_GET['codigo']);

	include('header.php');
?>

<div class="caja_principal">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="titulo_header">
    	
      <p id="lblCita"> Informes médicos de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>

	<button class="botonAddInformeM"> <a href="consultas.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> Agregar <img id="simbolo_addI" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 
	
	<?php

    $query = "SELECT DISTINCT TI.iCodTranInformeMedico, TI.iCodPaciente, TI.iCodInformeMedico, TI.iCodMedico, TI.vchNumInformeMedico, TI.vchProblema,  TI.dtFechaInformeMedico, TI.siAtencion, TI.vchMotivo As sMotivoConsulta, TI.dtFechaSintomatologia, TI.vchNota, TI.iInformeMedico, CONCAT (CM.vchNombre, ' ', CM.vchPaterno, ' ', CM.vchMaterno) As vchMedico, TI.siFrecuenciaCardiaca, TI.dTemperatura, TI.siFrecuenciaRespiratoria, TI.siCodMucosa, TI.sMucosa, TI.iTiempoLlenadoCapilar, TI.dPeso, TI.siPadecimiento, TI.sDiagnosticoPresuntivo, TI.sDiagnosticoDiferencial, TI.sPruebasRequeridas, TI.sResultado, TI.siDiagnostico, TI.vchProblema, TI.iCodServicio, TI.vchServicio, TI.dPrecioMenudeo, TI.dPrecioCosto, TI.iCodCuentaCliente, TI.vchReceta, TI.dMeses, TI.dAltura, TI.sPresionArterial, TI.dPerimetroCefalico, TI.dNoTransaccionCloud, TI.dtFechaInformeMedico FROM TranInformeMedico TI INNER JOIN CatMedico CM ON CM.iCodMedico = TI.iCodMedico WHERE TI.iCodPaciente = '$codigoPaciente' AND CM.iCodEmpresa = '$codigoE' ORDER BY dtFechaInformeMedico DESC";

   	$resultado = mysqli_query($conn,$query);
    while($fila = mysqli_fetch_assoc($resultado)){
      $codigoInf = $fila['iCodTranInformeMedico'];
                ?>
  <span id="titulo_informe"> Consulta del <?php echo $fila ['dtFechaInformeMedico']?> </span>
	<table id="tabla_informe">

   		<tr id="signos">
   			<td id="column_date">  </td>
   			<td id="column_temp"> Temp. <?php echo $fila ['dTemperatura']?> </td>
   			<td id="column_fc"> F.C. <?php echo $fila ['siFrecuenciaCardiaca']?> </td>
   			<td id="column_fr"> F.R. <?php echo $fila ['siFrecuenciaRespiratoria']?> </td>
   			<td id="column_pa"> P.A. <?php echo $fila ['sPresionArterial']?> </td>
   			<td id="column_tllc"> TLLC. <?php echo $fila ['iTiempoLlenadoCapilar']?> </td>
   			<td id="column_peso"> Peso. <?php echo $fila ['dPeso']. ' kg'?> </td>
   			<td id="column_edit">  <a href="modificar_consulta.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>&ci=<?php echo base64_encode($codigoInf) ?>"> <img id="pencil" src="https://img.icons8.com/ultraviolet/30/000000/pencil-tip.png"> </td>
   			<td id="column_delete"> <a href="eliminar_informe.php?idE=<?php echo $fila['iCodTranInformeMedico'] ?>" onclick="return alert_eliminarInforme();"> <img id="trash" src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
   		</tr>
   		<tr>
   			<td id="column_date"> </td>
   			<td id="column_medico" colspan="8"> <img id="img_medico" src="https://img.icons8.com/ultraviolet/30/000000/doctor-male.png"> <?php echo $fila ['vchMedico']?> </td>
   		</tr>
   		<tr id="motivo_receta">
    		<th id="cabecera_motivo" colspan="2">Motivo consulta</th>
    		<th id="cabecera_receta" colspan="7">Receta</th>
  		</tr>
   		<tr id="motivo_receta_mostrar">
   			<td id="column_motivo" colspan="2"> <?php echo $fila ['sMotivoConsulta']?> </td>
   			<td id="column_receta" colspan="7"> <?php echo $fila ['vchReceta']?> </td>
   		</tr>
   		<tr id="examen_med">
    		<th id="cabecera_examen" colspan="2">Examen físico</th>
    		<th id="cabecera_medicacion" colspan="7">Medicación</th>
  		</tr>
   		<tr id="examen_med_mostrar">	
   			<td id="column_ef" colspan="2"> <?php echo $fila ['vchNota']?> </td>
   			<td id="column_med" colspan="7"> <?php echo $fila ['vchProblema']?> </td>
   		</tr>
 
   </table>
   <hr>
   <?php 
	}
?>

<script type="text/javascript">
        function alert_eliminarInforme(){
            var respuesta = confirm("Estás seguro de eliminar el informe médico?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
          
        </script>
</div>
</body>
</html>
