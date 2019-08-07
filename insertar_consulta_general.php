<?php
	require ('conexion.php');

	
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$problema = $_POST['medicacion'];
	$motivo = $_POST['motivo'];
	$fechaSintomas = $_POST['fechaS'];
	$fecha = $_POST['fecha'];
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

	$pacientes = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

    $pac = mysqli_query($conn,$pacientes);
    $newPac = mysqli_fetch_assoc($pac);

    $correo = $newPac['vchCorreo'];
    $pais = $newPac['vchPais'];
    $estado = $newPac['vchEstado'];
    $ciudad = $newPac['vchCiudad'];
    $iCodProp = $newPac['iCodPropietario'];

	$consulta = "SELECT vchNombre, vchPaterno, vchMaterno FROM CatMedico WHERE iCodMedico = '$iCodMedico' AND iCodEmpresa = '$cEmpresa'";
	
	$resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $nombreMedico = $fila['vchNombre']." ".$fila['vchPaterno']." ".$fila['vchMaterno'];

	$query = "SELECT iCodTipoServicio, vchDescripcion, dPrecioCosto FROM CatServicios WHERE iCodEmpresa = '$cEmpresa' AND iCodServicio = '$servicio' AND iCodEmpresa = '$cEmpresa'";

	$result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);

    $nombreServicio = $row['vchDescripcion'];
    $comision = $row['dPrecioCosto'];
    $tipoS = $row['iCodTipoServicio'];

	$nuevaConsulta = "INSERT INTO TranInformeMedico (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodPaciente, iCodInformeMedico, vchNumInformeMedico, vchProblema, vchMotivo, dtFechaSintomatologia, siPadecimiento, siAtencion, vchNota, sDiagnosticoPresuntivo, sDiagnosticoDiferencial, sPruebasRequeridas, sResultado, siDiagnostico, dtFechaInformeMedico, iCodMedico, siFrecuenciaCardiaca, dTemperatura, siFrecuenciaRespiratoria, siCodMucosa, sMucosa, iTiempoLlenadoCapilar, dPeso, vchServicio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iInformeMedico, vchReceta, dPerimetroCefalico, dMeses, dAltura, sPresionArterial, dIVA, dSubtotal, dPorcentajeIVA, vchMedico, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '$codPaciente', '0', '.', '$problema', '$motivo', '$fechaSintomas', '$padecimiento', '$atencion', '$nota', '$dPresuntivo', '$dDiferencial', '$pruebas', '$definitivo', '0', '$fechaInforme', '$iCodMedico', '$fCardiaca', '$temp', '$fRespiratoria', '1', '$sMucosa', '$tllc', '$peso', '$nombreServicio', '$precio', '$comision', '$servicio', '0', '0', '$receta', '0', '0', '0', '$pa', '0', '0', '0', '$nombreMedico', '0', '0')";

	echo $nuevaConsulta;
 	//$new = mysqli_query($conn,$nuevaConsulta);


 	$insertCuentaCG = "INSERT INTO TranCuentasClientes(vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$tipoS', '$codPaciente', '$fecha', '$nombreServicio', '$comision', '$precio', '0', '0', '$iCodProp', '0', '0', '0', '0', '0', '0', '0', '1', '0', '', '0', '0', '0', '$fecha', '', '0', '0', '.', '0', '2')";

 	echo $insertCuentaCG;	

?>	