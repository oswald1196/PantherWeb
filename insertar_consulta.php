<?php
	require ('conexion.php');
	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$problema = $_POST['medicacion'];
	$motivo = $_POST['motivo'];
	$fechaSintomas = $_POST['fechaS'];
	$padecimiento = $_POST['padecimiento'];
	$atencion = $_POST['atencionClinica'];
	$nota = $_POST['examen'];
	$dPresuntivo = $_POST['dp'];
	$dDiferencial = $_POST['dd'];
	$pruebas = $_POST['pruebas'];
	$resultado = $_POST['ddef'];
	$fechaInforme = $_POST['fechaConsulta'];
	$iCodMedico = $_POST['codigoM'];
	$fCardiaca = $_POST['frecCardiaca'];
	$temp = $_POST['temperatura'];
	$fRespiratoria = $_POST['frecResp'];
	$sMucosa = $_POST['mucosas'];
	$tllc = $_POST['llenado'];
	$peso = $_POST['peso'];
	$servicio = $_POST['servicio'];
	$receta = $_POST['receta'];
	$precio = $_POST['costoS'];
	$iCodServicio = $_POST['codigoServicio'];
	$comision = $_POST['precioCosto'];
	$pa = $_POST['presion'];

	//$query = "INSERT INTO TranInformeMedico (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodPaciente, iCodInformeMedico, vchNumInformeMedico, vchProblema, vchMotivo, dtFechaSintomatologia, siPadecimiento, siAtencion, vchNota, sDiagnosticoPresuntivo, sDiagnosticoDiferencial, sPruebasRequeridas, sResultado, siDiagnostico, dtFechaInformeMedico, iCodMedico, siFrecuenciaCardiaca, dTemperatura, siFrecuenciaRespiratoria, iCodMucosa, sMucosa, iTiempoLlenadoCapilar, dPeso, vchServicio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iInformeMedico, vchReceta, dPerimetroCefalico, dMeses, dAltura, sPresionArterial, dIVA, dSubtotal, dPorcentajeIVA, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '$codPaciente', '0', '0', '$problema', '$motivo', '$fechaSintomas', '$padecimiento', '$atencion', '$nota', '$dPresuntivo', '$dDiferencial', '$pruebas', '$resultado', '0', '$fechaInforme', '$iCodMedico', '$fCardiaca', '$temp', '$fRespiratoria', '1', '$sMucosa', '$tllc', '$peso', '$servicio', '$precio', '$comision', '$iCodServicio', '0', '0', '$receta', '0', '0', '0', '$pa', '0', '0', '0', '0', '0', '0')";   
	
	/*$query = "SELECT vchDescripcion, dPrecioMenudeo, dPrecioCosto FROM CatServicios WHERE iCodEmpresa = '$cEmpresa' AND iCodServicio = '$servicio'";

	$result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
	echo $row['vchDescripcion'].' '.$row['dPrecioMenudeo'].' '.$row['dPrecioCosto'];
	
	echo $query;*/
