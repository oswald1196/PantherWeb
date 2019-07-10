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
	$nota = $_POST['examen'];
	$dPresuntivo = $_POST['dp'];
	$dDiferencial = $_POST['dd'];
	$pruebas = $_POST['pruebas'];
	$definitivo = $_POST['definitivo'];
	$fechaInforme = $_POST['fechaConsulta'];
	$iCodMedico = $_POST['medico'];
	$fCardiaca = $_POST['frecCardiaca'];
	$temp = $_POST['temperatura'];
	$fRespiratoria = $_POST['frecResp'];
	$sMucosa = $_POST['mucosas'];
	$tllc = $_POST['llenado'];
	$peso = $_POST['peso'];
	$servicio = $_POST['servicio'];
	$receta = $_POST['receta'];
	$precio = $_POST['costo'];
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

	$query = "SELECT vchDescripcion, dPrecioCosto FROM CatServicios WHERE iCodEmpresa = '$cEmpresa' AND iCodServicio = '$servicio' AND iCodEmpresa = '$cEmpresa'";

	$result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);

    $nombreServicio = $row['vchDescripcion'];
    $comision = $row['dPrecioCosto'];

	$nuevaConsulta = "INSERT INTO TranInformeMedico (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodPaciente, iCodInformeMedico, vchNumInformeMedico, vchProblema, vchMotivo, dtFechaSintomatologia, siPadecimiento, siAtencion, vchNota, sDiagnosticoPresuntivo, sDiagnosticoDiferencial, sPruebasRequeridas, sResultado, siDiagnostico, dtFechaInformeMedico, iCodMedico, siFrecuenciaCardiaca, dTemperatura, siFrecuenciaRespiratoria, siCodMucosa, sMucosa, iTiempoLlenadoCapilar, dPeso, vchServicio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iInformeMedico, vchReceta, dPerimetroCefalico, dMeses, dAltura, sPresionArterial, dIVA, dSubtotal, dPorcentajeIVA, vchMedico, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '$codPaciente', '0', '.', '$problema', '$motivo', '$fechaSintomas', '$padecimiento', '$atencion', '$nota', '$dPresuntivo', '$dDiferencial', '$pruebas', '$definitivo', '0', '$fechaInforme', '$iCodMedico', '$fCardiaca', '$temp', '$fRespiratoria', '1', '$sMucosa', '$tllc', '$peso', '$nombreServicio', '$precio', '$comision', '$servicio', '0', '0', '$receta', '0', '0', '0', '$pa', '0', '0', '0', '$nombreMedico', '0', '0')";

 	//$new = mysqli_query($conn,$nuevaConsulta);	
?>	