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
	$fecha = $_POST['fecha'];
	$nota = $_POST['examen'];
	$ci = $_POST['codigoInforme'];
	$dPresuntivo = $_POST['dp'];
	$dDiferencial = $_POST['dd'];
	$pruebas = $_POST['pruebas'];
	$definitivo = $_POST['ddef'];
	$fechaInforme = $_POST['fechaConsulta'];
	$iCodMedico = $_POST['medico'];
	$fCardiaca = $_POST['frecCardiaca'];
	$temp = $_POST['temperatura'];
	$fRespiratoria = $_POST['frecResp'];
	$sMucosa = $_POST['mucosas'];
	$tllc = $_POST['llenado'];
	$peso = $_POST['peso'];
	$receta = $_POST['receta'];
	//$comision = $_POST['precioCosto'];
	$pa = $_POST['presion'];

	if (isset($_POST['padecimiento']) == "on"){
		$padecimiento = "0";
	} else {
		$padecimiento = "1";
	} 

	if (isset($_POST['atencionClinica']) == "on"){
		$atencion = "0";
	} else {
		$atencion = "1";
	} 

	if($definitivo == ""){
		$definitivo = "-";	
	}

	if($problema == ""){
		$problema = "-";
	}

	if($dPresuntivo == ""){
		$dPresuntivo = "-";
	}

	if($dDiferencial == ""){
		$dDiferencial = "-";
	}

	if($pruebas == ""){
		$pruebas = "-";
	}

	if($fCardiaca == ""){
		$fCardiaca = "-";
	}

	if($fRespiratoria == ""){
		$fRespiratoria = "-";
	}

	if($pa == ""){
		$pa = "-";
	}

	if($tllc == ""){
		$tllc = "0";
	}

	if($temp == ""){
		$temp = "0";
	}

	if($peso == "") {
		$peso = "0";
	}

	$consulta = "SELECT vchNombre, vchPaterno, vchMaterno FROM CatMedico WHERE iCodMedico = '$iCodMedico' AND iCodEmpresa = '$cEmpresa'";
	
	$resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $nombreMedico = $fila['vchNombre']." ".$fila['vchPaterno']." ".$fila['vchMaterno'];

	$nuevaConsulta = "UPDATE TranInformeMedico SET vchProblema = '$problema', vchMotivo = '$motivo', dtFechaSintomatologia = '$fechaSintomas', siPadecimiento = '$padecimiento', siAtencion ='$atencion', vchNota = '$nota', sDiagnosticoPresuntivo = '$dPresuntivo', sDiagnosticoDiferencial = '$dDiferencial', sPruebasRequeridas = '$pruebas', sResultado = '$definitivo', dtFechaInformeMedico = '$fechaInforme', iCodMedico = '$iCodMedico', siFrecuenciaCardiaca = '$fCardiaca', dTemperatura = '$temp', siFrecuenciaRespiratoria = '$fRespiratoria', sMucosa = '$sMucosa', iTiempoLlenadoCapilar = '$tllc', dPeso = '$peso',  vchReceta = '$receta', sPresionArterial = '$pa', vchMedico =  '$nombreMedico' WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente' AND iCodTranInformeMedico = '$ci'";

 	$editConsulta = mysqli_query($conn,$nuevaConsulta);	
 	//echo $nuevaConsulta;
 	//$cuentaConsulta = "UPDATE TranCuentasClientes SET iCodTipoServicio = '$tipoS', vchServicio = '$nombreServicio', dPrecioCosto = '$comision', dPrecioMenudeo = '$precio' WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

 	//$cuentaConsulta = mysqli_query($conn,$insertCuentaC);	

?>	