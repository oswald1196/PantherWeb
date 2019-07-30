<?php
	require ('conexion.php');

	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$fecha = $_POST['fechaVacuna'];
	$producto = $_POST['vacuna'];
	$laboratorio = $_POST['laboratorio'];
	$lote = $_POST['lote'];
	$costo = $_POST['precio'];
	$caducidad = $_POST['fechaC'];
	$peso = $_POST['peso'];
	$horaIni = $_POST['horaCita'];

	if($peso == ""){
		$peso = "0";
	}

	if (isset($_POST['motivoProxima']) == ""){
		$motivoP = "-";
	} 
	else {
		$motivoP = $_POST['motivoProxima'];
	}

	if (isset($_POST['fechaCita']) == ""){
		$fechaCita = "01-01-1900";
	} 
	else {
		$fechaCita = $_POST['fechaCita'];
	}

	$pacientes = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

    $pac = mysqli_query($conn,$pacientes);
    $newPac = mysqli_fetch_assoc($pac);

    $correo = $newPac['vchCorreo'];
    $pais = $newPac['vchPais'];
    $estado = $newPac['vchEstado'];
    $ciudad = $newPac['vchCiudad'];
    $iCodProp = $newPac['iCodPropietario'];

	$query = "SELECT vchDescripcion, dPrecioCosto, iCodTipoProducto FROM CatProductos WHERE iCodProducto = '$producto' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($resultado);

	$nombreVacuna = $row['vchDescripcion'];
	$precioCosto = $row['dPrecioCosto'];
	$iCodServicio = $row['iCodTipoProducto'];

	$nombreLote = "SELECT vchLote FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";

	$result = mysqli_query($conn,$nombreLote);
	$row = mysqli_fetch_assoc($result);

	$vchLote = $row['vchLote'];

	$sql = "INSERT INTO TranRegistroVacunas (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodVacuna, iCodPaciente, sFecha, sVacunaAplicada, sNumeroLote, sProximaVacuna, sFechaProgramada, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, bVacunasAnteriores, dPeso, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreVacuna', '$vchLote', '$motivoP', '$fechaCita', '$laboratorio', '$costo', '$precioCosto', '$iCodServicio', '0', '$producto', '$lote', '$caducidad', '0', 'PZA.', '0', '0', '0', '0', '$peso', '2', '0')";
	echo $sql;

	$insertCuentaVG = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$iCodServicio', '$codPaciente', '$fecha', '$nombreVacuna', '$precioCosto', '$costo', '0', '0', '0', '$iCodProp', '0', '0', '0','0','0','0', '$producto', '1', '0', '0', '0','0', '$fecha', '0', '0', '0', '0', '.', '$lote', '2')";

	echo $insertCuentaVG;

	$consultaVG = "SELECT CONCAT(vchNombrePaciente, '-', vchRaza, '-', vchNombre, '-', vchTelefono) AS vchServicio FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

	$resultado = mysqli_query($conn,$consultaVG);
    $fila = mysqli_fetch_assoc($resultado);

    $servicio = $fila['vchServicio'];

	$nuevaCitaVG = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$motivoP', '$horaIni', '1', '1', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$iCodProp', '0', '0')";

	echo $nuevaCitaVG;

	//$new = mysqli_query($conn,$sql);
?>